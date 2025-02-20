<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Language;
use App\ProductShipping;
use Illuminate\Http\Request;
use \Mews\Purifier\Facades\Purifier;

class ProductShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_shipping(){
        $all_shipping = ProductShipping::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.products.shipping.all-shipping')->with(['all_shipping' => $all_shipping,'all_languages' => $all_languages]);
    }

    public function store_all_shipping(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191:unique:product_shippings',
            'status' => 'required|string|max:191',
            'description' => 'nullable|string',
            'cost' => 'required|string',
            'order' => 'nullable|string',
            'lang' => 'required|string',
        ]);

        ProductShipping::create([
            'title' => Purifier::clean($request->title),
            'status' =>  $request->status,
            'description' =>  Purifier::clean($request->description),
            'cost' =>  $request->cost,
            'order' =>  $request->order,
            'lang' =>  $request->lang,
        ]);

        return redirect()->back()->with(['msg' => __('New Shipping Added..'),'type' => 'success']);
    }

    public function update_shipping(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191:unique:product_shippings',
            'status' => 'required|string|max:191',
            'description' => 'nullable|string',
            'cost' => 'required|string',
            'order' => 'nullable|string',
            'lang' => 'required|string',
        ]);

        ProductShipping::find($request->id)->update([
            'title' => Purifier::clean($request->title),
            'status' =>  $request->status,
            'description' =>  Purifier::clean($request->description),
            'cost' =>  $request->cost,
            'order' =>  $request->order,
            'lang' =>  $request->lang,
            ]);

        return redirect()->back()->with(['msg' => __('Shipping Updated..'),'type' => 'success']);
    }

    public function delete_shipping(Request $request,$id){
        ProductShipping::find($request->id)->delete();
        return redirect()->back()->with(['msg' => __('Shipping Deleted..'),'type' => 'danger']);
    }

    public function default_shipping($id){
        $shipping = ProductShipping::find($id);
        ProductShipping::where(['is_default' => '1', 'lang' => $shipping->lang])->update(['is_default' => '0']);
        $shipping->is_default = '1';
        $shipping->save();

        return redirect()->back()->with([
            'msg' => __('Default Shipping Set To').' '.Purifier::clean($shipping->title),
            'type' => 'success'
        ]);
    }

    public function bulk_action(Request $request){
        $all = ProductShipping::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
