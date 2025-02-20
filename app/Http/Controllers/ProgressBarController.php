<?php

namespace App\Http\Controllers;

use App\ProgressBar;
use Illuminate\Http\Request;

class ProgressBarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function store(Request $request){
        $this->validate($request,[
           'title' => 'required|string',
           'progress' => 'required|string',
           'lang' => 'required|string',
        ]);
        ProgressBar::create($request->all());
        return redirect()->back()->with(['msg' => __('Item Added Successfully...'), 'type' => 'success']);
    }
    public function update(Request $request){
        $this->validate($request,[
           'title' => 'required|string',
           'progress' => 'required|string',
           'lang' => 'required|string',
        ]);
        ProgressBar::find($request->id)->update([
            'title' => $request->title,
            'progress' => $request->progress,
            'lang' => $request->lang,
        ]);
        return redirect()->back()->with(['msg' => __('Item Updated Successfully...'), 'type' => 'success']);
    }
    public function delete($id){
        ProgressBar::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Item Deleted Successfully...'), 'type' => 'danger']);
    }
    public function bulk_action(Request $request){
        $all = ProgressBar::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
