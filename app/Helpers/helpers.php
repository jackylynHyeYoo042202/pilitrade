<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;
use App\Models\Category;
use App\Models\SubCategory;

if( !function_exists('sendEmail') ){
    function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');            
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');    
        $mail->Password = env('MAIL_PASSWORD');    
        $mail->SMTPSecure = env('MAIL_ENCRYPTION'); 
        $mail->Port = env('MAIL_PORT');    
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];
        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }
}

/** GET GENERAL SETTINGS */
if( !function_exists('get_settings') ){
    function get_settings(){
        $results = null;
        $settings = new GeneralSetting();
        $settings_data = $settings->first();

        if( $settings_data ){
            $results = $settings_data;
        }else{
            $settings->insert([
                'site_name'=>'PiliTradeMarketplace',
                'site_email'=>'info@pilitrademarketplace.test'
            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }
        return $results;
    }
}


/** GET SOCIAL NETWORKS */
if( !function_exists('get_social_network') ){
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetwork();
        $social_network_data = $social_network->first();

        if( $social_network_data ){
            $results = $social_network_data;
        }else{
            $social_network->insert([
                'facebook_url'=>null,
                'twitter_url'=>null,
                'instagram_url'=>null,
                'youtube_url'=>null,
                'github_url'=>null,
                'linkedin_url'=>null
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}

// //FRONTEND::
// /** GET FRONT END CATEGORIES */
// if( !function_exists('get_categories') ){
//     function get_categories(){
//         $categories = Category::with('subcategories')->orderBy('ordering','asc')->get();
//         return !empty($categories) ? $categories : [];
//     }
// }

/** GET FRONT END CATEGORIES */
if( !function_exists('get_categories') ){
    function get_categories(){
        // Fetch categories with their subcategories
        $categories = Category::with('subcategories')->orderBy('ordering', 'asc')->get();
        
        // If you want to include products, you can also do it here
        foreach ($categories as $category) {
            // Eager load products for each category
            $category->load('products');

            // Eager load products for each subcategory
            foreach ($category->subcategories as $subcategory) {
                $subcategory->load('products');
            }
        }

        return $categories;
    }
}
