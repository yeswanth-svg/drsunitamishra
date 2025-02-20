<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact_page_settings(){
        return view('backend.pages.contact-page.contact-page-settings');
    }
    public function update_contact_page(Request $request){
        $this->validate($request,[
            'contact_page_map_section_location' => 'required|string',
            'contact_page_map_section_zoom' => 'required|string',
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'home_page_contact_us_section_' . $lang->slug . '_title' => 'nullable|string',
                'home_page_contact_us_section_' . $lang->slug . '_contact' => 'nullable|string',
                'home_page_contact_us_section_' . $lang->slug . '_email' => 'nullable|string',
                'home_page_contact_us_section_' . $lang->slug . '_address' => 'nullable|string',
            ]);
            $fields = [
                'home_page_contact_us_section_' . $lang->slug . '_title',
                'home_page_contact_us_section_' . $lang->slug . '_contact',
                'home_page_contact_us_section_' . $lang->slug . '_email',
                'home_page_contact_us_section_' . $lang->slug . '_address'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        update_static_option('contact_page_map_section_location',$request->contact_page_map_section_location);
        update_static_option('contact_page_map_section_zoom',$request->contact_page_map_section_zoom);

        return redirect()->back()->with(['msg' => __('Settings Updated..'),'type' => 'success']);
    }
    public function section_manage(){
        return view('backend.pages.contact-page.section-manage');
    }
    public function update_section_manage(Request $request){
        $this->validate($request,[
            'contact_page_map_section_status' => 'nullable|string',
            'contact_page_contact_section_status' => 'nullable|string',
        ]);
        $fields = ['map','contact'];
        foreach($fields as $field){
            $filed_name = 'contact_page_'.$field.'_section_status';
            update_static_option($filed_name,$request->$filed_name);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
}
