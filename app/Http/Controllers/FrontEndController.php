<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homePage(Request $request) {
        $categories = Category::all();
    
        $data = [
            'pageTitle' => 'PiliTrade | Online Marketplace',
        ];
    
        return view('front.pages.home', $data);
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for products based on the query
        $products = Product::with('category')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('category_name', 'LIKE', "%{$query}%");
            })
            ->paginate(12); // Adjust the number of items per page

        return view('front.pages.search-results', compact('products', 'query'));
    }


    public function showProductDetail($id)
    {
        $product = Product::with('category', 'subcategory')->findOrFail($id);
        
        return view('front.pages.product-detail', compact('product'));
    }

    public function shopPage(Request $request) {
        $data = [
            'pageTitle' => 'Shop | PiliTrade Marketplace'
        ];
        return view('front.pages.shop', $data);
    }

    public function shopDetailPage(Request $request) {
        $data = [
            'pageTitle' => 'Shop Detail | PiliTrade Marketplace'
        ];
        return view('front.pages.shopdetail', $data);
    }

    public function cartPage(Request $request) {
        $data = [
            'pageTitle' => 'Cart | PiliTrade Marketplace'
        ];
        return view('front.pages.cart', $data);
    }

    public function checkoutPage(Request $request) {
        $data = [
            'pageTitle' => 'Checkout | PiliTrade Marketplace'
        ];
        return view('front.pages.checkout', $data);
    }

    public function registerPage(Request $request) {
        $data = [
            'pageTitle' => 'Register | PiliTrade Marketplace'
        ];
        return view('back.pages.auth.register', $data);
    }

    public function createSellerPage(Request $request) {
        $data = [
            'pageTitle' => 'Create Seller | PiliTrade Marketplace'
        ];
        return view('back.pages.auth.create', $data);
    }

    public function verifyAccountPage(Request $request) {
        $data = [
            'pageTitle' => 'Verify Account | PiliTrade Marketplace'
        ];
        return view('back.pages.auth.verifyAccount', $data);
    }

    public function registersuccessPage(Request $request) {
        $data = [
            'pageTitle' => 'Register-Success | PiliTrade Marketplace'
        ];
        return view('back.pages.auth.register-success', $data);
    }

    public function contactPage(Request $request) {
        $data = [
            'pageTitle' => 'Contact Us | PiliTrade Marketplace'
        ];
        return view('front.pages.contact', $data);
    }

    public function privacy(Request $request) {
        $data = [
            'pageTitle' => 'Privacy Policy | PiliTrade Marketplace'
        ];
        return view('front.pages.privacy');
    }

    public function terms(Request $request) {
        $data = [
            'pageTitle' => 'Terms of Use | PiliTrade Marketplace'
        ];
        return view('front.pages.terms');
    }


}    