<?php

namespace App\Http\Controllers;

use App\Language;
use App\TopbarInfo;
use Illuminate\Http\Request;

class TopbarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_topbar_infos = TopbarInfo::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.top-bar-settings')->with([
            'all_topbar_infos' => $all_topbar_infos,
            'all_languages' => $all_language,
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'details' => 'required|string',
        ]);
        TopbarInfo::create($request->all());
        return redirect()->back()->with([
            'msg' => __('New Item Added...'),
            'type' => 'success'
        ]);
    }
    public function update(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'details' => 'required|string',
        ]);

        TopbarInfo::find($request->id)->update([
            'icon' => $request->icon,
            'details' => $request->details,
        ]);
        return redirect()->back()->with([
            'msg' => __('Item Updated...'),
            'type' => 'success'
        ]);
    }
    public function delete(Request $request,$id){
        TopbarInfo::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Item Deleted...'),
            'type' => 'danger'
        ]);
    }
    public function bulk_action(Request $request){
        $all = TopbarInfo::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
