<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Buyer;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\DB;
use App\Helpers\constDefaults;
use App\Helpers\constGuards;
use Illuminate\Support\Facades\File;
use SawaStacks\Utils\Library\Kropify;

class BuyerController extends Controller
{
    public function login(Request $request){
        $data = [
            'pageTitle'=>'Buyer Login'
        ];
        return view('back.pages.buyer.auth.login',$data);
    } //End Method

    public function register(Request $request){
        $data = [
            'pageTitle'=>'Create Buyer Account'
        ];
        return view('back.pages.buyer.auth.register',$data);
    } //End Method

    public function home(Request $request){
        $data = [
            'pageTitle'=>'Home'
        ];
        return view('back.pages.buyer.home',$data);
    } //End Method

    public function createBuyer(Request $request){
        //Validate buyer Registration Form
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:buyers',
            'password'=>'min:5|required_with:confirm_password|same:confirm_password',
            'confirm_password'=>'min:5'
        ]);

        $buyer = new Buyer();
        $buyer->name = $request->name;
        $buyer->email = $request->email;
        $buyer->password = Hash::make($request->password);
        $saved = $buyer->save();

        if( $saved ){
           //Generate token
           $token = base64_encode(Str::random(64));

           VerificationToken::create([
              'user_type'=>'buyer',
              'email'=>$request->email,
              'token'=>$token
           ]);

           $actionLink = route('buyer.verify',['token'=>$token]);
           $data['action_link'] = $actionLink;
           $data['buyer_name'] = $request->name;
           $data['buyer_email'] = $request->email;

           //Send Activation link to this buyer email
           $mail_body = view('email-templates.buyer-verify-template',$data)->render();

           $mailConfig = array(
              'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
              'mail_from_name'=>env('EMAIL_FROM_NAME'),
              'mail_recipient_email'=>$request->email,
              'mail_recipient_name'=>$request->name,
              'mail_subject'=>'Verify buyer Account',
              'mail_body'=>$mail_body
           );

           if( sendEmail($mailConfig) ){
              return redirect()->route('buyer.register-success');
           }else{
             return redirect()->route('buyer.register')->with('fail','Something went wrong while sending verification link.');
           }
        }else{
            return redirect()->route('buyer.register')->with('fail','Something went wrong.');
        }
    } //End Method

    public function verifyAccount(Request $requet, $token){
        $verifyToken = VerificationToken::where('token',$token)->first();

        if( !is_null($verifyToken) ){
            $buyer = Buyer::where('email',$verifyToken->email)->first();

            if( !$buyer->verified ){
                $buyer->verified = 1;
                $buyer->email_verified_at = Carbon::now();
                $buyer->save();

                return redirect()->route('buyer.login')->with('success','Good!, Your e-mail is verified. Login with your credentials and complete setup your buyer account.');
            }else{
                return redirect()->route('buyer.login')->with('info','Your e-mail is already verified. You can now login.');
            }
        }else{
            return redirect()->route('buyer.register')->with('fail','Invalid Token.');
        }
    } //End Method

    public function registerSuccess(Request $request){
        return view('back.pages.buyer.register-success');
    } //End Method

    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if( $fieldType == 'email' ){
            $request->validate([
                'login_id'=>'required|email|exists:buyers,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'Email or Username is required.',
                'login_id.email'=>'Invalid email address.',
                'login_id.exists'=>'Email is not exists in system.',
                'password.required'=>'Password is required'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:buyers,username',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'Email or Username is required.',
                'login_id.exists'=>'Username is not exists in system.',
                'password.required'=>'Password is required'
            ]);
        }
        
        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );

        if( Auth::guard('buyer')->attempt($creds) ){
            // return redirect()->route('buyer.home');
            if( !auth('buyer')->user()->verified ){
                auth('buyer')->logout();
                return redirect()->route('buyer.login')->with('fail','Your account is not verified. Check in your email and click on the link we had sent in order to verify your email for buyer account.');
            }else{
                return redirect()->route('buyer.home');
            }
            }else{
                return redirect()->route('buyer.login')->withInput()->with('fail','Incorrect password.');
        }
    } //End Method

    public function logoutHandler(Request $request){
        Auth::guard('buyer')->logout();
        return redirect()->route('buyer.login')->with('fail','You are logged out!');
    } //End Method

    public function forgotPassword(Request $request){
        $data = [
         'pageTitle' => 'Forgot Password'
        ];
        return view('back.pages.buyer.auth.forgot',$data);
     } //End Method
 
     public function sendPasswordResetLink(Request $request){
         //Validate the form
         $request->validate([
             'email'=>'required|email|exists:buyers,email'
         ],[
             'email.required'=>'The :attribute is required',
             'email.email'=>'Invalid email address',
             'email.exists'=>'The :attribute is not exists in our system'
         ]);
 
         //Get buyer details
         $buyer = buyer::where('email',$request->email)->first();
 
         //Generate token
         $token = base64_encode(Str::random(64));
 
         //Check if there is an existing reset password token for this buyer
         $oldToken = DB::table('password_reset_tokens')
                       ->where(['email'=>$buyer->email,'guard'=>constGuards::BUYER])
                       ->first();
 
         if( $oldToken ){
             //UPDATE EXISTING TOKEN
             DB::table('password_reset_tokens')
               ->where(['email'=>$buyer->email,'guard'=>constGuards::BUYER])
               ->update([
                 'token'=>$token,
                 'created_at'=>Carbon::now()
               ]);
         }else{
            //INSERT NEW RESET PASSWORD TOKEN
            DB::table('password_reset_tokens')
              ->insert([
                 'email'=>$buyer->email,
                 'guard'=>constGuards::BUYER,
                 'token'=>$token,
                 'created_at'=>Carbon::now()
              ]);
         }
 
         $actionLink = route('buyer.reset-password',['token'=>$token,'email'=>urlencode($buyer->email)]);
 
         $data['actionLink'] = $actionLink;
         $data['buyer'] = $buyer;
         $mail_body = view('email-templates.buyer-forgot-email-template',$data)->render();
 
         $mailConfig = array(
             'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
             'mail_from_name'=>env('EMAIL_FROM_NAME'),
             'mail_recipient_email'=>$buyer->email,
             'mail_recipient_name'=>$buyer->name,
             'mail_subject'=>'Reset Password',
             'mail_body'=>$mail_body
         );
 
         if( sendEmail($mailConfig) ){
             return redirect()->route('buyer.forgot-password')->with('success','We have e-mailed your password reset link.');
         }else{
             return redirect()->route('buyer.forgot-password')->with('fail','Something went wrong.');
         }
 
     } //End Method
 
     public function showResetForm(Request $request, $token = null){
         //Check if token exists
         $get_token = DB::table('password_reset_tokens')
                        ->where(['token'=>$token,'guard'=>constGuards::buyer])
                        ->first();
 
         if( $get_token ){
            //Check if this token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s',$get_token->created_at)->diffInMinutes(Carbon::now());
 
            if( $diffMins > constDefaults::tokenExpiredMinutes ){
              //When token is older that 15 minutes
              return redirect()->route('buyer.forgot-password',['token'=>$token])->with('fail','Token expired!. Request another reset password link.');
            }else{
             return view('back.pages.buyer.auth.reset')->with(['token'=>$token]);
            }
         }else{
             return redirect()->route('buyer.forgot-password',['token'=>$token])->with('fail','Invalid token!, request another reset password link.');
         }
 
     } //End Method
 
     public function resetPasswordHandler(Request $request){
       //Validate the form
       $request->validate([
          'new_password'=>'required|min:5|max:45|required_with:confirm_new_password|same:confirm_new_password',
          'confirm_new_password'=>'required'
       ]);
 
       $token = DB::table('password_reset_tokens')
                  ->where(['token'=>$request->token,'guard'=>constGuards::buyer])
                  ->first();
 
       //Get buyer details
       $buyer = buyer::where('email',$token->email)->first();
 
       //Update buyer password
       Buyer::where('email',$buyer->email)->update([
          'password'=>Hash::make($request->new_password)
       ]);
 
       //Delete token record
       DB::table('password_reset_tokens')->where([
          'email'=>$buyer->email,
          'token'=>$request->token,
          'guard'=>constGuards::BUYER
       ])->delete();
 
       //Send email to notify buyer for new password
       $data['buyer'] = $buyer;
       $data['new_password'] = $request->new_password;
 
       $mail_body = view('email-templates.buyer-reset-email-template',$data);
 
       $mailConfig = array(
         'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
         'mail_from_name'=>env('EMAIL_FROM_NAME'),
         'mail_recipient_email'=>$buyer->email,
         'mail_recipient_name'=>$buyer->name,
         'mail_subject'=>'Password Changed',
         'mail_body'=>$mail_body
       );
 
       sendEmail($mailConfig);
       return redirect()->route('buyer.login')->with('success','Done!, Your password has been changed. Use new password to login into system.');
 
     } //End Method
 
     public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'Profile'
        ];
        return view('back.pages.buyer.profile', $data);
    }

    public function changeProfilePicture(Request $request){
        $buyer = buyer::findOrFail(auth('buyer')->id());
        $path = 'images/users/buyers/';
        $file = $request->file('buyerProfilePictureFile');
        $old_picture = $buyer->getAttributes()['picture'];
        $filename = 'BUYER_IMG_'.$buyer->id.'.jpg';

        $upload = Kropify::getFile($file,$filename)->maxWoH(325)->save($path);
        $infos = $upload->getInfo();

        if( $upload ){
            if( $old_picture != null && File::exists(public_path($path.$old_picture)) ){
                File::delete(public_path($path.$old_picture));
            }
            $buyer->update(['picture'=>$infos->getName]);

            return response()->json(['status'=>1,'msg'=>'Your profile picture has been successfully updated.']);
        }else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
        }
    }
}
