<?php

namespace App\Http\Controllers\Product;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;

use App\Language;
use App\ProductCategory;
use App\ProductCategoryLang;
use App\Products;
use Illuminate\Http\Request;
use DB;
class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function all_product_category(){

        $all_category = ProductCategory::with('lang')->get();
        return view('backend.products.all-products-category')->with(['all_category' => $all_category]);
    }

    public function store_product_category(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);

        DB::beginTransaction();
        try {
            $category_id = ProductCategory::create(['status' => $request->status])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ProductCategoryLang::create([
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

    public function update_product_category(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);
        DB::beginTransaction();
        try {
            ProductCategory::find($request->id)->update(['status' => $request->status]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ProductCategoryLang::updateOrCreate(['category_id' => $request->id,'lang' => $lang->slug],[
                    'lang' => $lang_slug,
                    'name' =>  $request->name[$lang_slug] ?? '',
                    'category_id' => $request->id
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }

    public function delete_product_category(Request $request,$id){
        if (Products::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Products...'),
                'type' => 'danger'
            ]);
        }
        ProductCategoryLang::where('category_id',$id)->delete();
        ProductCategory::find($id)->delete();
        return back()->with(FlashMsg::item_delete());
    }

    public function bulk_action(Request $request){
        ProductCategoryLang::whereIn('category_id',$request->ids)->delete();
        ProductCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
