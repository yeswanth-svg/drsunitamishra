<?php

namespace App\Http\Controllers;

use App\HeaderSlider;
use Illuminate\Http\Request;

class HeaderSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_header_slider = HeaderSlider::all()->groupBy('lang');
        return view('backend.pages.home-page-manage.header')->with(['all_header_slider' => $all_header_slider]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=> 'nullable|string|max:191',
            'subtitle'=> 'nullable|string|max:191',
            'title_ext'=> 'nullable|string|max:191',
            'subtitle_ext'=> 'nullable|string|max:191',
            'details'=> 'nullable|string',
            'btn_text'=> 'nullable|string|max:191',
            'btn_url'=> 'nullable|string|max:191',
            'btn_status'=> 'nullable|string',
            'support_title'=> 'nullable|string|max:191',
            'support_details'=> 'nullable|string',
            'image'=> 'required|string',
            'lang'=> 'nullable|string',
            'icon'=> 'nullable|string',
        ]);
        HeaderSlider::create($request->all());
        return redirect()->back()->with(['msg' => __('Item Added...'),'type' => 'success']);
    }

    public function update(Request $request){
        $home_page_variant = get_static_option('home_page_variant');
        $this->validate($request,[
            'title'=> 'nullable|string|max:191',
            'subtitle'=> 'nullable|string|max:191',
            'title_ext'=> 'nullable|string|max:191',
            'subtitle_ext'=> 'nullable|string|max:191',
            'details'=> 'nullable|string',
            'btn_text'=> 'nullable|string|max:191',
            'btn_url'=> 'nullable|string|max:191',
            'btn_status'=> 'nullable|string',
            'support_title'=> 'nullable|string|max:191',
            'support_details'=> 'nullable|string',
            'image'=> 'required|string',
            'lang'=> 'nullable|string',
            'icon'=> 'nullable|string',
        ]);
        $slider = HeaderSlider::find($request->id);
        if($home_page_variant == '01'){
            $fields = ['title','subtitle','support_title','support_details','btn_text','btn_url','image','lang'];
            if($request->has('btn_status')){
                $slider->btn_status = 'on';
            }else{
                $slider->btn_status = null;
            }
        }elseif($home_page_variant == '02'){
            $fields = ['title_ext','subtitle_ext','details','icon','image','lang'];
        }elseif($home_page_variant == '03'){
            $fields = ['title','subtitle','support_title','support_details','btn_text','btn_url','image','lang'];
            if($request->has('btn_status')){
                $slider->btn_status = 'on';
            }else{
                $slider->btn_status = null;
            }
        }else{
            $fields = ['title','subtitle','support_title','support_details','image','lang'];
        }
        foreach ($fields as $field) {
           $slider->$field  = $request->$field;
        }
        $slider->save();
        return redirect()->back()->with(['msg' => __('Item Updated...'),'type' => 'success']);
    }

    public function delete($id)
    {
        HeaderSlider::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }
    public function bulk_action(Request $request){
        $all = HeaderSlider::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
