<?php

namespace App\Http\Controllers;

use App\Language;
use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_testimonial = Testimonial::all()->groupBy('lang');
        return view('backend.pages.testimonial')->with([
            'all_testimonials' => $all_testimonial
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
           'name' => 'required|string|max:191',
           'description' => 'required',
           'image' => 'nullable|string',
           'rating_star' => 'nullable|integer',
           'lang' => 'nullable|string'
        ]);
        Testimonial::create($request->all());
        return redirect()->back()->with(['msg' => __('Item Added Successfully...'), 'type' => 'success']);
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'description' => 'required',
            'image' => 'nullable|string',
            'rating_star' => 'nullable|integer',
            'lang' => 'nullable|string'
        ]);
        Testimonial::find($request->id)->update($request->all());
        return redirect()->back()->with(['msg' => __('Item Updated Successfully...'), 'type' => 'success']);
    }
    public function delete($id){
        Testimonial::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Item Deleted Successfully...'), 'type' => 'danger']);
    }
    public function bulk_action(Request $request){
        $all = Testimonial::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
