<?php

namespace App\Http\Controllers\Appointment\Backend;

use App\Http\Controllers\Controller;
use App\AppointmentCategory;
use App\AppointmentCategoryLang;
use App\Helpers\FlashMsg;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentCategoryController extends Controller
{
    public function category_all(){
         $all_categories = AppointmentCategory::with('lang')->get();
         return view('backend.appointment.appointment-category')->with(['all_category' => $all_categories]);
    }
    public function category_new(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);

        DB::beginTransaction();
        try {
            $category_id = AppointmentCategory::create(['status' => $request->status])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentCategoryLang::create([
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

    public function category_delete(Request $request,$id){
        AppointmentCategoryLang::where('category_id',$id)->delete();
        AppointmentCategory::where('id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }

    public function bulk_action(Request $request){
        AppointmentCategoryLang::whereIn('category_id',$request->ids)->delete();
        AppointmentCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_update(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);
        DB::beginTransaction();
        try {
            AppointmentCategory::find($request->id)->update(['status' => $request->status]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentCategoryLang::updateOrCreate(['category_id' => $request->id,'lang' => $lang->slug],[
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


}
