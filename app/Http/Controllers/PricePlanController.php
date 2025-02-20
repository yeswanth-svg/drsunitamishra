<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use App\PricePlan;
use App\PricePlanLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_price_plan = PricePlan::with('lang')->get();
        return view('backend.pages.price-plan.price-plan-all')->with([
            'all_price_plan' => $all_price_plan
        ]);
    }
    public function add(){
        return view('backend.pages.price-plan.price-plan-new');
    }
    public function store(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'price' => 'required|numeric',
            'btn_url' => 'nullable|string|max:191',
            'image' => 'required|string',
            'title' => 'check_array:1',
            'btn_text' => 'check_array:1',
            'features' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'btn_text.check_array' => __('Enter Button Text'),
            'features.check_array' => __('Enter Price Plan Features'),
        ]);
        DB::beginTransaction();
        try {
            $price_plan_id = PricePlan::create([
                    'btn_url' => $request->btn_url,
                    'price' => $request->price,
                    'image' => $request->image
            ])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                PricePlanLang::create([
                    'price_plan_id'=> $price_plan_id,
                    'lang' => $lang_slug,
                    'title'=> $request->title[$lang_slug],
                    'type'=> $request->type[$lang_slug],
                    'features'=> $request->features[$lang_slug],
                    'btn_text'=> $request->btn_text[$lang_slug],
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_new());
    }
    public function edit($id){
        $price_plan = PricePlan::with('lang_all')->findOrFail($id);
        $check_diff =  array_merge(array_diff(exist_slugs($price_plan), all_lang_slugs()), array_diff(all_lang_slugs(), exist_slugs($price_plan)));
        if($check_diff != null){
           foreach ($check_diff as $key => $lang) {
            PricePlanLang::create([
                'lang' => $lang,
                'price_plan_id'=> $id,
                'title'=> null,
                'type'=> null,
                'features'=> null,
                'btn_text'=> null
            ]);
           }
        }
        $price_plan = PricePlan::with('lang_all')->findOrFail($id);
        return view('backend.pages.price-plan.price-plan-edit')->with([
            'price_plan' => $price_plan
        ]);
    }
    public function update(Request $request,$id){
        $all_languages = Language::all();
        $this->validate($request,[
            'price' => 'required|numeric',
            'btn_url' => 'nullable|string|max:191',
            'image' => 'required|string',
            'title' => 'check_array:1',
            'btn_text' => 'check_array:1',
            'features' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'btn_text.check_array' => __('Enter Button Text'),
            'features.check_array' => __('Enter Price Plan Features'),
        ]);
        DB::beginTransaction();
        try {
            PricePlan::find($id)->update([
                    'btn_url' => $request->btn_url,
                    'price' => $request->price,
                    'image' => $request->image
            ]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                PricePlanLang::where(['price_plan_id' => $id,'lang' => $lang->slug])->update([
                    'title'=> $request->title[$lang_slug],
                    'type'=> $request->type[$lang_slug],
                    'features'=> $request->features[$lang_slug],
                    'btn_text'=> $request->btn_text[$lang_slug],
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }
    public function delete($id){
        PricePlan::where('id',$id)->delete();
        PricePlanLang::where('price_plan_id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }
    public function clone_price_plan(Request $request)
    {
        $price_plans = PricePlan::find($request->item_id);
        $price_plan_id = PricePlan::create([
            'btn_url' => $price_plans->btn_url,
            'price' => $price_plans->price,
            'image' => $price_plans->image
        ])->id;
        $price_plan_langs = PricePlanLang::where('price_plan_id',$price_plans->id)->get();
        foreach ($price_plan_langs as $key => $data) {
            PricePlanLang::create([
                'lang' => $data->lang,
                'price_plan_id'=> $price_plan_id,
                'title'=> $data->title,
                'type'=> $data->type,
                'features'=> $data->features,
                'btn_text'=> $data->btn_text,
            ]);
        }
        return back()->with(FlashMsg::item_clone());
    }
    public function bulk_action(Request $request){
        PricePlan::whereIn('id',$request->ids)->delete();
        PricePlanLang::whereIn('price_plan_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
