<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Blog;
use App\Language;
use App\Menu;
use App\Page;
use App\Products;
use App\Services;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $all_menu = Menu::all();
        return view('backend.pages.menu.menu-index')->with([
            'all_menu' => $all_menu
        ]);
    }

    public function store_new_menu(Request $request)
    {
        $this->validate($request, [
            'content' => 'nullable',
            'title' => 'required',
        ]);

        Menu::create([
            'content' => $request->page_content,
            'title' => $request->title,
        ]);

        return redirect()->back()->with([
            'msg' => __('New Menu Created...'),
            'type' => 'success'
        ]);
    }
    public function edit_menu($id)
    {
        $page_post = Menu::find($id);
        $all_page = Page::with('lang_front')->where(['status'=>'publish'])->get();
        $all_services = Services::with('lang_front')->where(['status'=>'publish'])->get();
        $all_blogs = Blog::with('lang_front')->where(['status'=>'publish'])->get();
        $all_products = Products::with('lang_front')->where(['status'=>'publish'])->get();
        $all_appointments = Appointment::with('lang_front')->where(['status'=>'publish'])->get();

        return view('backend.pages.menu.menu-edit')->with([
            'page_post' => $page_post,
            'all_page' => $all_page,
            'all_services' => $all_services,
            'all_blogs' => $all_blogs,
            'all_products' => $all_products,
            'all_appointments' => $all_appointments,
        ]);
    }
    public function update_menu(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'nullable',
            'title' => 'required',
        ]);
        Menu::where('id', $id)->update([
            'content' => $request->menu_content,
            'title' => $request->title,
        ]);

        return redirect()->back()->with([
            'msg' => __('Menu updated...'),
            'type' => 'success'
        ]);
    }

    public function delete_menu(Request $request, $id)
    {
        Menu::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Menu Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function set_default_menu(Request $request, $id)
    {
        $lang = Menu::find($id);
        Menu::where(['status' => 'default'])->update(['status' => '']);

        Menu::find($id)->update(['status' => 'default']);
        $lang->status = 'default';
        $lang->save();
        return redirect()->back()->with([
            'msg' => __('Default Menu Set To') .' '. purify_html($lang->title),
            'type' => 'success'
        ]);
    }
    public function mega_menu_item_select_markup(Request $request){

        return render_mega_menu_item_select_markup($request->type,$request->menu_id);
    }

}
