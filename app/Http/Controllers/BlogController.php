<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\BlogCategoryLang;
use App\BlogLang;
use App\Helpers\FlashMsg;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function PHPUnit\Framework\throwException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_blog = Blog::with('lang')->get();
        return view('backend.pages.blog.index')->with([
            'all_blogs' => $all_blog
        ]);
    }
    public function new_blog(){
        $all_category = BlogCategory::with('lang')->where('status','publish')->get();
        return view('backend.pages.blog.new')->with([
            'all_category' => $all_category
        ]);
    }
    public function store_new_blog(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'category_id' => 'required',
            'tags' => 'nullable',
            'meta_title' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'og_meta_title' => 'nullable',
            'og_meta_description' => 'nullable',
            'og_meta_image' => 'nullable',
            'title' => 'check_array:1',
            'slug' => 'check_array:1',
            'author' => 'check_array:1',
            'content' => 'check_array:1',
            'image' => 'check_array:1',
            'name' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Blog Title'),
            'slug.check_array' => __('Enter Blog Slug'),
            'author.check_array' => __('Enter Blog Author'),
            'content.check_array' => __('Enter Blog Content'),
            'image.check_array' => __('Enter Blog Image'),
        ]);
        DB::beginTransaction();
        try {
            $blog_id = Blog::create([
                'category_id' => $request->category_id,
                'user_id' => auth()->guard('admin')->user()->id,
                'status' => $request->status
            ])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                BlogLang::create([
                'lang' => $lang_slug,
                'blog_id'=> $blog_id,
                'title'=> $request->title[$lang_slug],
                'tags' => $request->tags[$lang_slug],
                'author' => $request->author[$lang_slug],
                'content' => $request->blog_content[$lang_slug],
                'meta_title' => $request->meta_title[$lang_slug],
                'meta_tags' => $request->meta_tags[$lang_slug],
                'meta_description' => $request->meta_description[$lang_slug],
                'og_meta_title' => $request->og_meta_title[$lang_slug],
                'og_meta_description' => $request->og_meta_description[$lang_slug],
                'og_meta_image' => $request->og_meta_image[$lang_slug],
                'image' => $request->image[$lang_slug],
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug])]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_new());
    }
    public function edit_blog($id){
        $all_category = BlogCategory::with('lang')->where('status','publish')->get();
        $blog_post = Blog::with('lang_all')->findOrFail($id);
        $check_diff =  array_merge(array_diff(exist_slugs($blog_post), all_lang_slugs()), array_diff(all_lang_slugs(), exist_slugs($blog_post)));
        if($check_diff != null){
           foreach ($check_diff as $key => $lang) {
            BlogLang::create([
                'lang' => $lang,
                'blog_id'=> $id,
                'title'=> null, 
                'tags' => null, 
                'author' => null, 
                'content' => null, 
                'meta_title' => null, 
                'meta_tags' => null, 
                'meta_description' => null,
                'og_meta_title' => null, 
                'og_meta_description' => null,
                'og_meta_image' => null,
                'image' => null, 
                'slug'=> null
            ]);
           }
        }
        $blog_post = Blog::with('lang_all')->findOrFail($id);
        return view('backend.pages.blog.edit')->with([
            'all_category' => $all_category,
            'blog_post' => $blog_post
        ]);
    }
    public function update_blog(Request $request,$id){

        $all_languages = Language::all();
        $this->validate($request,[
            'category_id' => 'required',
            'tags' => 'nullable',
            'meta_title' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'og_meta_title' => 'nullable',
            'og_meta_description' => 'nullable',
            'og_meta_image' => 'nullable',
            'title' => 'check_array:1',
            'slug' => 'check_array:1',
            'author' => 'check_array:1',
            'content' => 'check_array:1',
            'image' => 'check_array:1',
            'name' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Blog Title'),
            'slug.check_array' => __('Enter Blog Slug'),
            'author.check_array' => __('Enter Blog Author'),
            'content.check_array' => __('Enter Blog Content'),
            'image.check_array' => __('Enter Blog Image'),
        ]);


       

        DB::beginTransaction();

            try {
                Blog::find($id)->update([
                'category_id' => $request->category_id,
                'user_id' => auth()->guard('admin')->user()->id,
                'status' => $request->status
            ]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                BlogLang::updateOrCreate(['blog_id' => $id,'lang' => $lang_slug],[
                    'title'=> $request->title[$lang_slug] ?? '',
                    'tags' => $request->tags[$lang_slug] ?? '',
                    'author' => $request->author[$lang_slug] ?? '',
                    'content' => $request->blog_content[$lang_slug] ?? '',
                    'meta_title' => $request->meta_title[$lang_slug] ?? '',
                    'meta_tags' => $request->meta_tags[$lang_slug] ?? '',
                    'meta_description' => $request->meta_description[$lang_slug] ?? '',
                    'og_meta_title' => $request->og_meta_title[$lang_slug] ?? '',
                    'og_meta_description' => $request->og_meta_description[$lang_slug] ?? '',
                    'og_meta_image' => $request->og_meta_image[$lang_slug] ?? '',
                    'image' => $request->image[$lang_slug] ?? '',
                    'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug] ?? 'x') : Str::slug($request->title[$lang_slug] ?? 'x')]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }
    public function delete_blog($id){
        Blog::find($id)->delete();
        BlogLang::where('blog_id',$id)->delete();
        return redirect()->back()->with([
            'msg' => __('Blog Post Deleted Successfully...'),
            'type' => 'danger'
        ]);
    }
    public function bulk_action_blog(Request $request){
        Blog::whereIn('id',$request->ids)->delete();
        BlogLang::whereIn('blog_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
    public function clone_blog(Request $request)
    {
        $blogs = Blog::find($request->item_id);
        $blog_id = Blog::create([
            'category_id' => $blogs->category_id,
            'user_id' => $blogs->user_id,
            'status' => 'draft'
        ])->id;
        $blog_langs = BlogLang::where('blog_id',$blogs->id)->get();
        foreach ($blog_langs as $key => $data) {
            $blog_slug = $data->slug;
            $check_slug = BlogLang::where('slug',$blog_slug)->get();
            if (count($check_slug) > 0){
                $blog_slug .= '-'.date('s');
            }
            BlogLang::create([
                'lang' => $data->lang,
                'blog_id'=> $blog_id,
                'title'=> $data->title,
                'tags' => $data->tags,
                'author' => $data->author,
                'content' => $data->content,
                'meta_title' => $data->meta_title,
                'meta_tags' => $data->meta_tags,
                'meta_description' => $data->meta_description,
                'og_meta_title' => $data->og_meta_title,
                'og_meta_description' => $data->og_meta_description,
                'og_meta_image' => $data->og_meta_image,
                'image' => $data->image,
                'slug'=> $blog_slug
            ]);
        }
        return back()->with(FlashMsg::item_clone());
        
    }
    public function category(){
        $all_category = BlogCategory::with('lang')->get();
        return view('backend.pages.blog.category')->with([
            'all_category' => $all_category
        ]);
    }
    public function new_category(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name.*' => 'unique:blog_category_langs,name',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
            'name.*.unique' => __('The category name has already been taken.'),
        ]);

        DB::beginTransaction();
        try {
            $category_id = BlogCategory::create(['status' => $request->status])->id;
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                BlogCategoryLang::create([
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
    public function update_category(Request $request){
        $all_languages = Language::all();
        $this->validate($request,[
            'status' => 'required|string',
            'name' => 'check_array:1',
        ],[
            'name.check_array' => __('Enter Category name'),
        ]);
        DB::beginTransaction();
        try {
            BlogCategory::find($request->id)->update(['status' => $request->status]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                BlogCategoryLang::updateOrCreate(['category_id' => $request->id,'lang' => $lang->slug],[
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

    public function delete_category($id){
        if (Blog::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You can not delete this category, It already associated with a post...'),
                'type' => 'danger'
            ]);
        }
        BlogCategoryLang::where('category_id',$id)->delete();
        BlogCategory::where('id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }
    public function bulk_action(Request $request){
        BlogCategory::whereIn('id',$request->ids)->delete();
        BlogCategoryLang::whereIn('category_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
    public function Language_by_slug(Request $request){
        $all_category = BlogCategoryLang::where('lang',$request->lang)->get();
        return response()->json($all_category);
    }

}
