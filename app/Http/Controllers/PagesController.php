<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use App\Page;
use App\PageLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_pages = Page::with('lang')->get();
        return view('backend.pages.page.index')->with([
            'all_pages' => $all_pages
        ]);
    }
    public function new_page(){
        return view('backend.pages.page.new');
    }
    public function store_new_page(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'content' => 'nullable',
            'slug' => 'nullable',
            'meta_description'=>'nullable',
            'meta_title'=>  'nullable',
            'meta_tags'=>  'nullable',
            'og_meta_description'=>  'nullable',
            'og_meta_title'=>  'nullable',
            'og_meta_image'=>  'nullable',
            'status' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
        ]);
        DB::beginTransaction();
        try {
            $page_id = Page::create(['status' => $request->status])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                PageLang::create([
                'page_id'=> $page_id,
                'lang' => $lang_slug,
                'title'=> $request->title[$lang_slug],
                'content'=> $request->content[$lang_slug],
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
    public function edit_page($id){
        $page_post = Page::with('lang_all')->findOrFail($id);
        $check_diff =  array_merge(array_diff(exist_slugs($page_post), all_lang_slugs()), array_diff(all_lang_slugs(), exist_slugs($page_post)));
        if($check_diff != null){
           foreach ($check_diff as $key => $lang) {
            PageLang::create([
                'page_id'=> $id,
                'lang' => $lang,
                'title'=> null,
                'content'=>null,
                'meta_description'=> null,
                'meta_title'=>null,
                'meta_tags'=> null,
                'og_meta_description'=> null,
                'og_meta_title'=> null,
                'og_meta_image'=>null,
                'slug'=> null
            ]);
           }
        }
        $page_post = Page::with('lang_all')->findOrFail($id);
        return view('backend.pages.page.edit')->with([
            'page_post' => $page_post
        ]);
    }
    public function update_page(Request $request,$id){
        $all_languages = Language::all();
        $this->validate($request,[
            'content' => 'nullable',
            'slug' => 'nullable',
            'meta_description'=>  'nullable',
            'meta_title'=>  'nullable',
            'meta_tags'=>  'nullable',
            'og_meta_description'=>  'nullable',
            'og_meta_title'=>  'nullable',
            'og_meta_image'=>  'nullable',
            'status' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
        ]);
        DB::beginTransaction();
        try {
            Page::find($id)->update([
                'status' => $request->status,
            ]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                PageLang::where(['page_id' => $id,'lang' => $lang->slug])->update([
                'title'=> $request->title[$lang_slug],
                'content'=> $request->content[$lang_slug],
                'meta_description'=> $request->meta_description[$lang_slug],
                'meta_title'=> $request->meta_title[$lang_slug],
                'meta_tags'=> $request->meta_tags[$lang_slug],
                'og_meta_description'=> $request->og_meta_description[$lang_slug],
                'og_meta_title'=> $request->og_meta_title[$lang_slug],
                'og_meta_image'=> $request->og_meta_image[$lang_slug],
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug])
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }
    public function delete_page(Request $request,$id){
        Page::where('id',$id)->delete();
        PageLang::where('page_id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }
    public function bulk_action(Request $request){
        Page::whereIn('id',$request->ids)->delete();
        PageLang::whereIn('page_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
