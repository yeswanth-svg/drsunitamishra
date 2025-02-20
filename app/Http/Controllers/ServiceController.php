<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use App\PricePlan;
use App\ServiceCategory;
use App\ServiceCategoryLang;
use App\Services;
use App\ServicesLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $all_services = Services::with('lang')->get();
        $service_category = ServiceCategory::with('lang')->where('status','publish')->get();
        return view('backend.pages.service.index')->with(['all_services' => $all_services, 'service_category' => $service_category]);
    }
    public function new_service()
    {
        $service_category = ServiceCategory::with('lang')->where('status','publish')->get();
        $price_plans = PricePlan::with('lang')->get();
        return view('backend.pages.service.new-service')->with(['service_category' => $service_category,'price_plans' => $price_plans]);
    }
    public function store(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request,[
            'icon_type' => 'required|string',
            'img_icon' => 'nullable|string|max:191',
            'sr_order' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'price_plan' => 'nullable',
            'meta_description'=>'nullable',
            'meta_title'=>  'nullable',
            'meta_tags'=>  'nullable',
            'og_meta_description'=>  'nullable',
            'og_meta_title'=>  'nullable',
            'og_meta_image'=>  'nullable',
            'slug' => 'nullable',
            'image' => 'nullable|string',
            'title' => 'check_array:1',
            'description' => 'check_array:1',
            'excerpt' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'description.check_array' => __('Enter Description'),
            'excerpt.check_array' => __('Enter Excerpt'),
        ]);
        
        $price_plan = !empty($request->price_plan) ? $request->price_plan : [];
        DB::beginTransaction();
        try {
            $service_id = Services::create([
                'categories_id' => $request->categories_id,
                'icon' => $request->icon,
                'icon_type' => $request->icon_type,
                'sr_order' => $request->sr_order,
                'img_icon' => $request->img_icon,
                'image' => $request->image,
                'status' => $request->status,
                'price_plan' =>  serialize($price_plan),
            ])->id;
            
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                
                ServicesLang::create([
                'service_id'=> $service_id,
                'lang' => $lang_slug,
                'title'=> $request->title[$lang_slug],
                'description' => $request->description[$lang_slug],
                'excerpt' => $request->excerpt[$lang_slug],
                'meta_description'=> $request->meta_description[$lang_slug],
                'meta_title'=> $request->meta_title[$lang_slug],
                'meta_tags'=> $request->meta_tags[$lang_slug],
                'og_meta_description'=> $request->og_meta_description[$lang_slug],
                'og_meta_title'=> $request->og_meta_title[$lang_slug],
                'og_meta_image'=> $request->og_meta_image[$lang_slug],
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug]),]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_new());
    }

    public function edit_service($id)
    {
        $service = Services::with('lang_all')->findOrFail($id);
        $service_category = ServiceCategory::with('lang')->where('status','publish')->get();
        $price_plans = PricePlan::all();
        return view('backend.pages.service.edit-service')->with(['service_category' => $service_category,'service' => $service,'price_plans' => $price_plans]);
    }

    public function update(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request,[
            'icon_type' => 'required|string',
            'img_icon' => 'nullable|string|max:191',
            'sr_order' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'price_plan' => 'nullable',
            'meta_description'=>'nullable',
            'meta_title'=>  'nullable',
            'meta_tags'=>  'nullable',
            'og_meta_description'=>  'nullable',
            'og_meta_title'=>  'nullable',
            'og_meta_image'=>  'nullable',
            'slug' => 'nullable',
            'image' => 'nullable|string',
            'title' => 'check_array:1',
            'description' => 'check_array:1',
            'excerpt' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'description.check_array' => __('Enter Description'),
            'excerpt.check_array' => __('Enter Excerpt'),
        ]);
        
        $price_plan = !empty($request->price_plan) ? $request->price_plan : [];
        
        
        
        
        DB::beginTransaction();
        try {
            Services::find($request->id)->update([
                'categories_id' => $request->categories_id,
                'icon' => $request->icon,
                'icon_type' => $request->icon_type,
                'sr_order' => $request->sr_order,
                'img_icon' => $request->img_icon,
                'image' => $request->image,
                'status' => $request->status,
                'price_plan' =>  serialize($price_plan),
            ]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ServicesLang::updateOrCreate(
                    ['service_id' => $request->id,'lang' => $lang_slug],
                [
                  'service_id' => $request->id,
                  'lang' => $lang_slug,
                'title' => $request->title[$lang_slug] ?? '',
                'description' => $request->description[$lang_slug] ?? '',
                'excerpt' => $request->excerpt[$lang_slug] ?? 'x',
                'meta_description'=> $request->meta_description[$lang_slug] ?? '',
                'meta_title'=> $request->meta_title[$lang_slug] ?? '',
                'meta_tags'=> $request->meta_tags[$lang_slug] ?? '',
                'og_meta_description'=> $request->og_meta_description[$lang_slug] ?? '',
                'og_meta_title'=> $request->og_meta_title[$lang_slug] ?? '',
                'og_meta_image'=> $request->og_meta_image[$lang_slug] ?? '',
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug] ?? 'x' ) : Str::slug($request->title[$lang_slug] ?? 'x')
                ]);
            }
            
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }
    public function service_clone(Request $request)
    {
        $service = Services::with('lang_all')->find($request->item_id);
        DB::beginTransaction();
        try {
            $service_id = Services::create([
                'categories_id' => $service->categories_id,
                'icon' => $service->icon,
                'icon_type' => $service->icon_type,
                'sr_order' => $service->sr_order,
                'img_icon' => $service->img_icon,
                'image' => $service->image,
                'status' => 'draft',
                'price_plan' =>  $service->price_plan,
            ])->id;
            foreach ($service->lang_all as $lang_item){
                ServicesLang::create([
                    'service_id' => $service_id,
                    'title' => $lang_item->title,
                    'lang'=> $lang_item->lang,
                    'slug'=> $lang_item->slug.$lang_item->id,
                    'description' => $lang_item->description,
                    'excerpt' => $lang_item->excerpt,
                    'meta_description'=> $lang_item->meta_description,
                    'meta_title'=> $lang_item->meta_title,
                    'meta_tags'=> $lang_item->meta_tags,
                    'og_meta_description'=> $lang_item->og_meta_description,
                    'og_meta_title'=> $lang_item->og_meta_title,
                    'og_meta_image'=> $lang_item->og_meta_image
               ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_cloned());
    }

    public function delete($id)
    {
        ServicesLang::where('service_id',$id)->delete();
        Services::where('id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }

    public function category_index()
    {
        $all_category = ServiceCategory::with('lang')->get();
        return view('backend.pages.service.category')->with(['all_category'=>$all_category]);
    }

    public function category_store(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request,[
            'icon' => 'nullable',
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);
        DB::beginTransaction();
        try {
            $category_id = ServiceCategory::create(['status' => $request->status,'icon'=>$request->icon])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ServiceCategoryLang::create([
                    'lang' => $lang_slug,
                    'name' =>  $request->name[$lang_slug] ?? '',
                    'category_id' => $category_id
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_new());
    }
    public function category_update(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);
        
            
            
        DB::beginTransaction();
        try {
           ServiceCategory::find($request->id)->update(['status' => $request->status,'icon'=>$request->icon]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ServiceCategoryLang::updateOrCreate(['category_id' => $request->id,'lang' => $lang->slug],[
                    'lang' => $lang_slug,
                    'name' =>  $request->name[$lang_slug]
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }

    public function category_delete(Request $request, $id)
    {
        if (Services::where('categories_id', $id)->first()) {
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Service...'),
                'type' => 'danger'
            ]);
        }
        ServiceCategoryLang::where('category_id',$id)->delete();
        ServiceCategory::where('id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }

    public function category_by_slug(Request $request)
    {
        $service_category = ServiceCategory::with('lang')->where(['status' => 'publish'])->get();
        return response()->json($service_category);
    }

    public function bulk_action(Request $request)
    {
        Services::whereIn('id',$request->ids)->delete();
        ServicesLang::whereIn('service_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_bulk_action(Request $request)
    {
        ServiceCategory::whereIn('id',$request->ids)->delete();
        ServiceCategoryLang::whereIn('category_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
