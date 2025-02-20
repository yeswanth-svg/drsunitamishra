<?php

namespace App\Http\Controllers;

use App\InfobarRightIcons;
use App\Language;
use App\SocialIcons;
use Illuminate\Http\Request;

class InfoBarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_social_icons = SocialIcons::all();
        $all_right_section_items = InfobarRightIcons::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.infobar-settings')->with([
            'all_social_icons' => $all_social_icons,
            'all_right_section_items' => $all_right_section_items,
            'all_languages' => $all_language,
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'url' => 'required|string',
        ]);
        SocialIcons::create($request->all());
        return redirect()->back()->with([
            'msg' => __('New Item Added...'),
            'type' => 'success'
        ]);
    }
    public function update(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'url' => 'required|string',
        ]);
        SocialIcons::find($request->id)->update([
            'icon' => $request->icon,
            'url' => $request->url,
        ]);
        return redirect()->back()->with([
            'msg' => __('Item Updated...'),
            'type' => 'success'
        ]);
    }
    public function delete(Request $request,$id){
        SocialIcons::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Item Deleted...'),
            'type' => 'danger'
        ]);
    }
    public function bulk_action(Request $request){
        $all = SocialIcons::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function update_infobar_right_section(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request, [
                'home_page_infobar_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_page_infobar_section_'.$lang->slug.'_url'=> 'nullable|string',
                'home_page_infobar_section_'.$lang->slug.'_details'=> 'nullable|string',
            ]);
            $fields = [
                'home_page_infobar_section_'.$lang->slug.'_title',
                'home_page_infobar_section_'.$lang->slug.'_url',
                'home_page_infobar_section_'.$lang->slug.'_details'
            ];
            foreach ($fields as $field){
                if($request->has($field)){
                        update_static_option($field,$request->$field);
                }
            }
        }
        return redirect()->back()->with([
            'msg' => __('Right Section Updated...'),
            'type' => 'success'
        ]);
    }
    public function store_right_icons(Request $request){
        $this->validate($request,[
            'icon' => 'required|string',
            'title' => 'required|string',
            'details' => 'required|string',
            'lang' => 'required|string'
        ]);
        InfobarRightIcons::create($request->all());
        return redirect()->back()->with([
            'msg' => __('New Item Added...'),
            'type' => 'success'
        ]);
    }
    public function update_right_icons(Request $request){
        $this->validate($request,[
            'icon' => 'required|string',
            'title' => 'required|string',
            'details' => 'required|string',
            'lang' => 'required|string'
        ]);
        InfobarRightIcons::find($request->id)->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'details' => $request->details,
            'lang' => $request->lang
        ]);
        return redirect()->back()->with([
            'msg' => __('Item Updated...'),
            'type' => 'success'
        ]);
    }
    public function delete_right_icons(Request $request,$id){
        InfobarRightIcons::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Item Deleted...'),
            'type' => 'danger'
        ]);
    }
    public function bulk_action_right_icons(Request $request){
        $all = InfobarRightIcons::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

}
