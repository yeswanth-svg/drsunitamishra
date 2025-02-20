<?php

namespace App\Http\Controllers;

use App\Language;
use App\Mail\OrderReply;
use App\Mail\QuoteReply;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_quotes(){
        $all_quotes = Quote::all();
        return view('backend.quote-manage.quote-manage-all')->with(['all_quotes' => $all_quotes]);
    }

    public function pending_quotes(){
        $all_quotes = Quote::where('status','pending')->get();
        return view('backend.quote-manage.quote-manage-pending')->with(['all_quotes' => $all_quotes]);
    }

    public function completed_quotes(){
        $all_quotes = Quote::where('status','completed')->get();
        return view('backend.quote-manage.quote-manage-completed')->with(['all_quotes' => $all_quotes]);
    }

    public function quote_delete(Request $request,$id){
        Quote::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Quote Status Deleted Success...'),'type' => 'danger']);
    }
    public function quote_view($id){
        $qute =  Quote::find($id);
        return view('backend.quote-manage.quote-manage-view')->with(['quote' => $qute]);
    }

    public function change_status(Request $request){
        $this->validate($request,[
           'quote_status' => 'required|string|max:191',
            'quote_id' => 'required|string|max:191'
        ]);
        $quote_details = Quote::find($request->quote_id);
        $quote_details->status = $request->quote_status;
        $quote_details->save();
        return redirect()->back()->with(['msg' => __('Quote Status Update Success...'),'type' => 'success']);
    }

    public function send_mail(Request $request){
        $this->validate($request,[
           'email' => 'required|string|max:191',
           'name' => 'required|string|max:191',
           'subject' => 'required|string',
           'message' => 'required|string',
        ]);
        $data = [
            'name' => $request->name,
            'message' => $request->message,
            'subject' => str_replace('{site}',get_static_option('site_'.get_default_language().'_title'),$request->subject)
        ];
        Mail::to($request->email)->send(new QuoteReply($data));
        return redirect()->back()->with(['msg' => __('Quote Reply Mail Send Success...'),'type' => 'success']);
    }

    public function bulk_action(Request $request){
        $all = Quote::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function index_quote(){
        return view('backend.quote-manage.quote-setup');
    }
    public function udpate_quote(Request $request){
        $this->validate($request,[
            'quote_page_form_mail' => 'nullable|string',
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'quote_mail_'.$lang->slug.'_subject' => 'nullable|string',
            ]);
            $fields = [
              'quote_mail_'.$lang->slug.'_subject',
              'quote_page_'.$lang->slug.'_form_title',
              'quote_page_'.$lang->slug.'_form_button_text',
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('quote_page_form_mail',$request->quote_page_form_mail);
        return redirect()->back()->with(['msg' => __('Settings Updated Successfully...'),'type' => 'success']);
    }
}
