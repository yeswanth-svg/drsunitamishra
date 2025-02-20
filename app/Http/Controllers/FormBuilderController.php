<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function order_form_index()
    {
        return view('backend.form-builder.order-form');
    }
    public function update_order_form(Request $request)
    {
        $this->validate($request, [
            'field_name' => 'required|max:191',
            'field_placeholder' => 'required|max:191',
        ]);
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname) {
             $all_fields_name[] = Str::slug(htmlspecialchars(strip_tags($fname)));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('order_page_form_fields', $json_encoded_data);
        return redirect()->back()->with(['msg' => __('Form Updated...'), 'type' => 'success']);
    }
    public function contact_form_index()
    {
        return view('backend.form-builder.contact-form');
    }
    public function update_contact_form(Request $request)
    {
        $this->validate($request, [
            'field_name' => 'required|max:191',
            'field_placeholder' => 'required|max:191',
        ]);
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname) {
            $all_fields_name[] = Str::slug(htmlspecialchars(strip_tags($fname)));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('contact_page_contact_form_fields', $json_encoded_data);
        return redirect()->back()->with(['msg' => __('Form Updated...'), 'type' => 'success']);
    }
    public function quote_form_index(){
        return view('backend.form-builder.quote-form');
    }
    public function update_quote_form(Request $request){
        unset($request['_token']);
       $all_fields_name = [];
       $all_request_except_token = $request->all();
       foreach ($request->field_name as $fname){
            $all_fields_name[] = Str::slug(htmlspecialchars(strip_tags($fname)));
       }
       $all_request_except_token['field_name'] = $all_fields_name;
       $json_encoded_data = json_encode($all_request_except_token);

       update_static_option('quote_page_form_fields',$json_encoded_data);
       return redirect()->back()->with(['msg' => __('Form Updated...'),'type' => 'success']);
   }
}
