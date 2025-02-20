<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Appointment;
use App\Language;
use App\Blog;
use App\KeyFeatures;
use App\PricePlan;
use App\Order;
use App\ProductOrder;
use App\Services;
use App\Testimonial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class AdminDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    public function adminIndex(){

        $all_blogs = Blog::count();
        $total_admin = Admin::count() -1;
        $total_testimonial = Testimonial::count();
        $total_price_plan = PricePlan::count();
        $total_user = User::count();
        $total_key_features = KeyFeatures::count();
        $total_product_order = ProductOrder::all()->count();
        $total_appointment = Appointment::count();
        $total_services = Services::count();
        $product_recent_order = ProductOrder::orderBy('id','desc')->take(5)->get();
        $package_recent_order = Order::orderBy('id','desc')->take(5)->get();
        return view('backend.admin-home')->with([
            'blog_count' => $all_blogs,
            'total_admin' => $total_admin,
            'total_testimonial' => $total_testimonial,
            'total_price_plan' => $total_price_plan,
            'total_user' => $total_user,
            'total_key_features' => $total_key_features,
            'product_recent_order' => $product_recent_order,
            'package_recent_order' => $package_recent_order,
            'total_product_order' => $total_product_order,
            'total_appointment' => $total_appointment,
            'total_services' => $total_services
        ]);
    }
    public function site_identity(){
        return view('backend.general-settings.site-identity');
    }

    public function update_site_identity(Request $request){
        $this->validate($request,[
            'site_logo' => 'nullable|string',
            'site_favicon' => 'nullable|string',
            'site_breadcrumb_bg' => 'nullable|string',
            'site_white_logo' => 'nullable|string',
        ]);
        $fields = [
            'site_logo',
            'site_favicon',
            'site_breadcrumb_bg',
            'site_white_logo',
        ];
        foreach ($fields as $field){
            if ($request->has($field)){
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated'),
            'type' => 'success'
        ]);
    }
    public function admin_settings(){
        return view('auth.admin.settings');
    }
    public function admin_profile_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'image' => 'nullable|string'
        ]);

        Admin::find(Auth::user()->id)->update(['name'=>$request->name,'email' => $request->email ,'image' => $request->image ]);
        return redirect()->back()->with(['msg' => __('Profile Update Success' ), 'type' => 'success']);
    }
    public function admin_password_chagne(Request $request){
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);

        if (Hash::check($request->old_password ,$user->password)){

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg'=> __('Password Changed Successfully'),'type'=> 'success']);
        }

        return redirect()->back()->with(['msg'=> __('Somethings Going Wrong! Please Try Again or Check Your Old Password'),'type'=> 'danger']);
    }
    public function adminLogout(){
        Auth::logout();
        return redirect()->route('admin.login')->with(['msg'=>__('You Logged Out !!'),'type'=> 'danger']);
    }

    public function admin_profile(){
        return view('auth.admin.edit-profile');
    }
    public function admin_password(){
        return view('auth.admin.change-password');
    }

    public function blog_page(){
        $all_languages = Language::all();
        return view('backend.pages.blog')->with([
        'all_languages'=>$all_languages
        ]);
    }

    public function blog_page_update(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'blog_page_item' => 'required'
        ]);
        $save_data = [
            'blog_page_item'
        ];
        foreach ($save_data as $data){
                update_static_option($data,$request->$data);
        }
        return redirect()->back()->with(['msg'=>__('Settings Update'),'type'=> 'success']);
    }
    public function basic_settings(){
        return view('backend.general-settings.basic');
    }
    public function update_basic_settings(Request $request){
        $this->validate($request,[
            'site_title' => 'required|string',
            'site_tag_line' => 'required|string',
            'site_footer_copyright' => 'required|string',
            'site_color' => 'required|string',
            'site_main_color_two' => 'required|string',
        ]);
        $save_data = [
            'site_title',
            'site_tag_line',
            'site_footer_copyright',
            'site_color',
            'site_main_color_two',
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}

            if($request->has($item)){
                update_static_option($item,$request->$item);
            }
        }
        return redirect()->back()->with(['msg'=> __('Settings Update'),'type'=> 'success']);
    }

    public function seo_settings(){
        return view('backend.general-settings.seo');
    }
    public function update_seo_settings(Request $request){
        $this->validate($request,[
            'site_meta_tags' => 'required|string',
            'site_meta_description' => 'required|string'
        ]);

        $save_data = [
            'site_meta_tags',
            'site_meta_description'
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }

        return redirect()->back()->with(['msg'=>__('SEO Settings Update'),'type'=> 'success']);
    }

    public function scripts_settings(){
        return view('backend.general-settings.thid-party');
    }

    public function update_scripts_settings(Request $request){

        $this->validate($request,[
            'site_disqus_key' => 'nullable|string',
            'tawk_api_key' => 'nullable|string',
            'site_google_analytics' => 'nullable|string',
        ]);

        $save_data = [
            'site_disqus_key',
            'site_google_analytics',
            'tawk_api_key'
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }

        return redirect()->back()->with(['msg'=> __('Third Party Scripts Settings Updated..'),'type'=> 'success']);
    }
    public function email_template_settings(){
        return view('backend.general-settings.email-template');
    }

    public function update_email_template_settings(Request $request){

        $this->validate($request,[
            'site_global_email' => 'required|string',
            'site_global_email_template' => 'required|string',
        ]);

        $save_data = [
            'site_global_email',
            'site_global_email_template'
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }

        return redirect()->back()->with(['msg'=> __('Email Settings Updated..'),'type'=> 'success']);
    }

    public function home_variant(){
        return view('backend.pages.home-variant');
    }

    public function update_home_variant(Request $request){
        $this->validate($request,[
           'home_page_variant' => 'required|string'
        ]);
        update_static_option('home_page_variant',$request->home_page_variant);
        return redirect()->back()->with(['msg'=> __('Home Variant Settings Updated..') ,'type'=> 'success']);
    }

    public function navbar_settings(){
        $all_languages = Language::all();
        return view('backend.pages.navbar-settings')->with(['all_languages' => $all_languages]);;
    }
    public function update_navbar_settings(Request $request){
        $all_languages = Language::all();
        $home_variant = get_static_option('home_page_variant');
        $this->validate($request,[
            'navbar_button' => 'nullable|string',
            'navbar_button_icon' => 'nullable|string',
            'navbar_title_icon' => 'nullable|string',
            'shopping_cart_icon' => 'nullable|string',
        ]);
        foreach ($all_languages as $lang){
            $this->validate($request, [
                'navbar_button_text_' . $lang->slug=> 'nullable|string',
                'navbar_button_url_' . $lang->slug=> 'nullable|string',
                'navbar_button_title_' . $lang->slug=> 'nullable|string',
                'navbar_button_details_' . $lang->slug=> 'nullable|string',
            ]);
            $fields = [
                'navbar_button_text_' . $lang->slug,
                'navbar_button_url_' . $lang->slug,
                'navbar_button_title_' . $lang->slug,
                'navbar_button_details_' . $lang->slug,
            ];
            foreach ($fields as $field){
                if ($request->has($field)){
                    update_static_option($field,$request->$field);
                }
            }
        }
        update_static_option('navbar_button',$request->navbar_button);
        $fields = [
            'navbar_button_icon',
            'navbar_title_icon',
            'shopping_cart_icon',
        ];
        foreach ($fields as $field){
            if ($request->has($field)){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg'=>'Settings Updated Successfully...','type'=> 'success']);
    }

    public function typography_settings(){
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        return view('backend.general-settings.typograhpy')->with(['google_fonts' => json_decode($all_google_fonts)]);
    }
    public function update_typography_settings(Request $request){
        $this->validate($request,[
            'body_font_family' => 'required|string|max:191',
            'body_font_variant' => 'required',
            'heading_font' => 'nullable|string',
            'heading_font_family' => 'nullable|string|max:191',
            'heading_font_variant' => 'nullable',
        ]);

        $save_data = [
            'body_font_family',
            'heading_font_family',
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }
        update_static_option('heading_font',$request->heading_font);
        update_static_option('body_font_variant',serialize($request->body_font_variant));
        update_static_option('heading_font_variant',serialize($request->heading_font_variant));

        return redirect()->back()->with(['msg'=> __('Typography Settings Updated..') ,'type'=> 'success']);
    }
    
    public function cache_settings(){
          return view('backend.general-settings.cache-settings');
    }
    
    public function update_cache_settings(Request $request){
        
         $this->validate($request,[
            'cache_type' => 'required|string'
        ]);
        
        Artisan::call($request->cache_type.':clear');
        
        return redirect()->back()->with(['msg'=> __('Cache Cleaned...') ,'type'=> 'success']);
    }

    public function dark_mode_toggle(Request $request){
        if($request->mode == 'off'){
            update_static_option('site_admin_dark_mode','on');
        }
        if($request->mode == 'on'){
            update_static_option('site_admin_dark_mode','off');
        }
        
        return response()->json(['status'=>'done']);    
    }
}
