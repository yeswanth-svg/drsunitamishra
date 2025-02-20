<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use App\ProgressBar;
use App\Services;
use Illuminate\Http\Request;

class AboutUsPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function about_section()
    {
        $all_language = Language::all();
        return view('backend.pages.about-page.about-section')->with(['all_languages' => $all_language]);
    }
    public function update_about_section(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'about_page_full_width_service_section_support_icon' => 'nullable|string',
            'about_page_full_width_service_section_bg_img_right' => 'nullable|string',
        ]);
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'about_page_full_width_service_section_' . $lang->slug . '_title' => 'nullable|string',
                'about_page_full_width_service_section_' . $lang->slug . '_description' => 'nullable|string',
                'about_page_full_width_service_section_' . $lang->slug . '_features' => 'nullable|string',
                'about_page_full_width_service_section_' . $lang->slug . '_support_title' => 'nullable|string',
                'about_page_full_width_service_section_' . $lang->slug . '_support_details' => 'nullable|string',
            ]);
            $fields = [
                'about_page_full_width_service_section_' . $lang->slug . '_title',
                'about_page_full_width_service_section_' . $lang->slug . '_description',
                'about_page_full_width_service_section_' . $lang->slug . '_features',
                'about_page_full_width_service_section_' . $lang->slug . '_support_title',
                'about_page_full_width_service_section_' . $lang->slug . '_support_details',
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'about_page_full_width_service_section_support_icon',
            'about_page_full_width_service_section_bg_img_right',
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
    public function progressbar_section()
    {
        $all_progressbar = ProgressBar::all()->groupBy('lang');
        return view('backend.pages.about-page.progressbar-section')->with([
            'all_progressbar' => $all_progressbar
        ]);
    }
    public function update_progressbar_section(Request $request)
    {
        $all_language = Language::all();
        $this->validate($request, [
            'about_page_progressbar_section_bg' => 'nullable|string',
        ]);
        foreach ($all_language as $lang) {
            $this->validate($request, [
                'about_page_progressbar_section_' . $lang->slug . '_title' => 'nullable|string',
            ]);
            $fields = [
                'about_page_progressbar_section_' . $lang->slug . '_title',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }
        update_static_option('about_page_progressbar_section_bg', $request->about_page_progressbar_section_bg);
        return redirect()->back()->with(['msg' => __('Settings Updated Successfully...'), 'type' => 'success']);
    }
    public function section_manage()
    {
        return view('backend.pages.about-page.section-manage');
    }
    public function update_section_manage(Request $request)
    {
        $fields = ['full_width_service','progress_bar','why_choose_us','team_member','counterup'];
        foreach($fields as $field){
            $filed_name = 'about_page_'.$field.'_section_status';
            update_static_option($filed_name,$request->$filed_name);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function whychoose_section()
    {
        $all_services  = Services::with('lang')->where('status','publish')->get();
        return view('backend.pages.about-page.why-choose-us-section')->with(['all_services'=>$all_services]);
    }
    public function update_whychoose_section(Request $request)
    {
        $this->validate($request, [
            'about_page_whychoose_item' => 'nullable|string',
        ]);
        update_static_option('about_page_whychoose_item', $request->about_page_whychoose_item);
        update_static_option('about_page_why_choose_us_selected_service_ids',serialize($request->about_page_why_choose_us_selected_service_ids));
        return redirect()->back()->with([
            'msg' =>  __('Settings Updated Successfully...'),
            'type' => 'success'
        ]);
    }
}
