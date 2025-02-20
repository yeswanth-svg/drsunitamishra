<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use App\Services;
use App\StaticOption;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function brand_logos_area()
    {
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        return view('backend.pages.home-page-manage.brand-logos-settings')->with([
            'all_languages' => $all_languages,
            'home_page_variant' => $home_page_variant
        ]);
    }
    public function update_brand_logos_area(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'brand_' . $lang->slug . '_title' => 'nullable|string',

            ]);
            $fields = [
                'brand_' . $lang->slug . '_title'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with(['msg' => __('Brands Title Updated...'), 'type' => 'success']);
    }
    public function testimonial_area()
    {
        return view('backend.pages.home-page-manage.testimonial-settings');
    }
    public function update_testimonial_area(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_testimonial_section_' . $lang->slug . '_title' => 'nullable|string'
            ]);
            $fields = [
                'home_page_testimonial_section_' . $lang->slug . '_title'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function faq_area()
    {
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        return view('backend.pages.home-page-manage.faq-settings')->with([
            'all_languages' => $all_languages,
            'home_page_variant' => $home_page_variant
        ]);
    }
    public function update_faq_area(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_faq_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_faq_section_' . $lang->slug . '_description' => 'nullable|string',
            ]);
            $fields = [
                'home_page_faq_section_' . $lang->slug . '_title',
                'home_page_faq_section_' . $lang->slug . '_description'
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function keyfeatures_area()
    {
        $home_page_variant = get_static_option('home_page_variant');
        return view('backend.pages.home-page-manage.key-features-settings')->with([
            'home_page_variant' => $home_page_variant
        ]);
    }
    public function update_keyfeatures_area(Request $request)
    {
        $home_page_variant = get_static_option('home_page_variant');
        $this->validate($request, [
            'home_page_keyfeatures_section_' . $home_page_variant . '_bg_img' => 'nullable|string',
            'home_page_' . $home_page_variant . '_key_feature_item' => 'nullable|string',
            'home_page_' . $home_page_variant . '_key_feature_number' => 'nullable|string',
        ]);
        foreach (get_all_language() as $lang) {
            $this->validate($request, [
                'home_page_keyfeatures_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_text' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_description' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_quote_title' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_quote_subtitle' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url' => 'nullable|string',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url' => 'nullable|string',
            ]);
            $fields = [
                'home_page_keyfeatures_section_' . $lang->slug . '_title',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_text',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url',
                'home_page_keyfeatures_section_' . $lang->slug . '_description',
                'home_page_keyfeatures_section_' . $lang->slug . '_quote_title',
                'home_page_keyfeatures_section_' . $lang->slug . '_quote_subtitle',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url',
                'home_page_keyfeatures_section_' . $lang->slug . '_btn_url'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'home_page_keyfeatures_section_' . $home_page_variant . '_bg_img',
            'home_page_' . $home_page_variant . '_key_feature_item',
            'home_page_' . $home_page_variant . '_key_feature_number',
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function why_choose_us_area(){
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        $all_services  = Services::with('lang')->where('status','publish')->get();
        return view('backend.pages.home-page-manage.why-choose-us-settings')->with([
            'all_languages' => $all_languages,
            'home_page_variant' => $home_page_variant,
            'all_services' => $all_services,
        ]);
    }
    public function update_why_choose_us_area(Request $request){
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        foreach ($all_languages as $lang){
            $this->validate($request, [
                'home_page_why_choose_us_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_page_why_choose_us_section_'.$lang->slug.'_description'=> 'nullable|string',
            ]);
            $fields = [
                'home_page_why_choose_us_section_'.$lang->slug.'_title',
                'home_page_why_choose_us_section_'.$lang->slug.'_description'
            ];
            foreach ($fields as $field){
                    update_static_option($field,$request->$field);
            }
        }
        $fields = [
            'home_page_why_choose_us_item',
            'home_page_'.$home_page_variant.'_why_choose_us_bg',
            'why_choose_us_home_'.$home_page_variant.'_variant',
        ];
        foreach ($fields as $field){
            if ($request->has($field)){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('why_choose_us_selected_services',serialize($request->why_choose_us_selected_services));
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function price_plan_area()
    {
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        return view('backend.pages.home-page-manage.price-plan-settings')->with([
            'all_languages' => $all_languages,
            'home_page_variant' => $home_page_variant
        ]);
    }
    public function update_price_plan_area(Request $request)
    {
        $this->validate($request, [
            'home_page_price_plan_section_display_item' => 'nullable|numeric',
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_price_plan_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_price_plan_section_' . $lang->slug . '_description' => 'nullable|string',
            ]);
            $fields  = [
                'home_page_price_plan_section_' . $lang->slug . '_title',
                'home_page_price_plan_section_' . $lang->slug . '_description'
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }
        update_static_option('home_page_price_plan_section_display_item', $request->home_page_price_plan_section_display_item);
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function join_app_area()
    {
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        return view('backend.pages.home-page-manage.join-app-settings')->with([
            'all_languages' => $all_languages,
            'home_page_variant' => $home_page_variant
        ]);
    }
    public function update_join_app_area(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_join_app_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_join_app_section_' . $lang->slug . '_description' => 'nullable|string',
                'home_page_join_app_section_button_text_' . $lang->slug . '_left' => 'nullable|string',
                'home_page_join_app_section_button_text_' . $lang->slug . '_right' => 'nullable|string',
                'home_page_join_app_section_button_url_' . $lang->slug . '_left' => 'nullable|string',
                'home_page_join_app_section_button_url_' . $lang->slug . '_right' => 'nullable|string',
                'home_page_join_app_download_image_' . $lang->slug . '_left' => 'nullable|string',
                'home_page_join_app_download_image_' . $lang->slug . '_right' => 'nullable|string',
            ]);
            $fields  = [
                'home_page_join_app_section_' . $lang->slug . '_title',
                'home_page_join_app_section_' . $lang->slug . '_description',
                'home_page_join_app_section_button_text_' . $lang->slug . '_left',
                'home_page_join_app_section_button_text_' . $lang->slug . '_right',
                'home_page_join_app_section_button_url_' . $lang->slug . '_left',
                'home_page_join_app_section_button_url_' . $lang->slug . '_right',
                'home_page_join_app_download_image_' . $lang->slug . '_left',
                'home_page_join_app_download_image_' . $lang->slug . '_right'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields  = [
            'home_page_join_app_top_image',
            'home_page_join_app_bottom_image',
            'home_page_join_app_left_button_icon',
            'home_page_join_app_right_button_icon',

        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function full_width_service_area()
    {
        $all_languages = Language::all();
        return view('backend.pages.home-page-manage.full-width-service-settings')->with([
            'all_languages' => $all_languages
        ]);
    }
    public function update_full_width_service_area(Request $request)
    {
        $all_languages = Language::all();
        $home_page_variant = get_static_option('home_page_variant');
        $this->validate($request, [
            'home_page_full_width_service_section_support_icon' => 'nullable|string',
            'home_page_full_width_service_section_'.$home_page_variant.'_bg_img' => 'nullable|string',
            'home_page_full_width_service_section_'.$home_page_variant.'_bg_img_right' => 'nullable|string'
        ]);
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_full_width_service_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_full_width_service_section_' . $lang->slug . '_description' => 'nullable|string',
                'home_page_full_width_service_section_' . $lang->slug . '_features' => 'nullable|string',
                'home_page_full_width_service_section_' . $lang->slug . '_support_title' => 'nullable|string',
                'home_page_full_width_service_section_' . $lang->slug . '_support_details' => 'nullable|string',
                'home_page_full_width_service_section_' . $lang->slug . '_support_description' => 'nullable|string'
            ]);
            $fields = [
                'home_page_full_width_service_section_' . $lang->slug . '_title',
                'home_page_full_width_service_section_' . $lang->slug . '_description',
                'home_page_full_width_service_section_' . $lang->slug . '_features',
                'home_page_full_width_service_section_' . $lang->slug . '_support_title',
                'home_page_full_width_service_section_' . $lang->slug . '_support_details',
                'home_page_full_width_service_section_' . $lang->slug . '_support_description'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'home_page_full_width_service_section_support_icon',
            'home_page_full_width_service_section_'.$home_page_variant.'_bg_img',
            'home_page_full_width_service_section_'.$home_page_variant.'_bg_img_right'
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function call_to_action_area()
    {
        $all_languages = Language::all();
        return view('backend.pages.home-page-manage.call-to-action-settings')->with([
            'all_languages' => $all_languages,
        ]);
    }
    public function update_call_to_action_area(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'home_page_call_to_action_section_icon'=> 'nullable|string',
            'home_page_call_to_action_section_bg'=> 'nullable|string'
            
        ]);
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_call_to_action_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_call_to_action_section_' . $lang->slug . '_support_title' => 'nullable|string',
                'home_page_call_to_action_section_' . $lang->slug . '_support_details' => 'nullable|string',
                
            ]);
            $fields = [
                'home_page_call_to_action_section_' . $lang->slug . '_title',
                'home_page_call_to_action_section_' . $lang->slug . '_support_title',
                'home_page_call_to_action_section_' . $lang->slug . '_support_details'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'home_page_call_to_action_section_icon',
            'home_page_call_to_action_section_bg'
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function section_manage()
    {
        return view('backend.pages.section-manage');
    }
    public function update_section_manage(Request $request){
        $home_variant = get_static_option('home_page_variant');
        if($home_variant == '01')
            $fields = ['topbar','infobar','navbar','header_slider','keyfeature','why_choose_us','full_width_service','counterup','testimonial','quote','price_plan','latest_team_member','latest_blog'];
        elseif($home_variant == '02')
            $fields = ['topbar','infobar','navbar','header_slider','keyfeature','why_choose_us','full_width_service','testimonial','latest_team_member','price_plan','latest_blog','call_to_action'];
        elseif($home_variant == '03')
            $fields = ['topbar','navbar','header_slider','keyfeature','why_choose_us','counterup','testimonial','call_us','price_plan','latest_team_member','latest_blog'];
        elseif($home_variant == '04')
            $fields = ['topbar','infobar','navbar','header_slider','keyfeature','full_width_service','why_choose_us','counterup','price_plan','testimonial','latest_team_member','latest_blog'];
        foreach($fields as $field){
                $filed_name = 'home_page_'.$field.'_section_status';
                update_static_option($filed_name,$request->$filed_name);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function latest_blog_area()
    {
        $all_languages = Language::all();
        return view('backend.pages.home-page-manage.latest-blog-settings')->with([
            'all_languages' => $all_languages
        ]);
    }
    public function update_latest_blog_area(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_latest_blog_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_latest_blog_section_' . $lang->slug . '_subtitle' => 'nullable|string',
            ]);
            $fields = [
                'home_page_latest_blog_section_' . $lang->slug . '_title',
                'home_page_latest_blog_section_' . $lang->slug . '_subtitle'
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }
        update_static_option('home_page_latest_blog_section_display_item', $request->home_page_latest_blog_section_display_item);
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function counterup_settings()
    {
        return view('backend.pages.home-page-manage.counterup-settings');
    }
    public function update_counterup_settings(Request $request)
    {
        $this->validate($request, [
            'counterup_bg_img' => 'required|string',
        ]);
        update_static_option('counterup_bg_img', $request->counterup_bg_img);
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function team_member_section()
    {
        return view('backend.pages.home-page-manage.team-member-settings');
    }
    public function update_team_member_section(Request $request)
    {
        $all_language = Language::all();
        $this->validate($request, [
            'home_page_team_section_item' => 'nullable|string',
            'home_page_team_section_bg' => 'nullable|string'
        ]);
        foreach ($all_language as $lang) {
            $this->validate($request, [
                'home_page_team_section_' . $lang->slug . '_title' => 'nullable|string',
            ]);
            $fields = [
                'home_page_team_section_' . $lang->slug . '_title',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }
        
        update_static_option('home_page_team_section_item', $request->home_page_team_section_item);
        update_static_option('home_page_team_section_bg', $request->home_page_team_section_bg);

        return redirect()->back()->with([
            'msg' =>  __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function quote_area()
    {
        return view('backend.pages.home-page-manage.quote-settings');
    }
    public function update_quote_area(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'home_page_quote_bg_texture' => 'nullable|string',
        ]);
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_quote_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_quote_section_' . $lang->slug . '_details' => 'nullable|string',
                'home_page_quote_section_' . $lang->slug . '_btn_text' => 'nullable|string'
            ]);
            $fields = [
                'home_page_quote_section_' . $lang->slug . '_title',
                'home_page_quote_section_' . $lang->slug . '_details',
                'home_page_quote_section_' . $lang->slug . '_btn_text'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'home_page_quote_bg_texture'
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
    public function call_us_banner_area()
    {
        return view('backend.pages.home-page-manage.call-us-now-settings');
    }
    public function update_call_us_banner_area(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'home_page_quote_support_image' => 'nullable|string',
            'home_page_quote_bg_image' => 'nullable|string',
        ]);
        $fields = [
            'home_page_quote_support_image',
            'home_page_quote_bg_image'
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
}
