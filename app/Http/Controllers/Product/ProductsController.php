<?php

namespace App\Http\Controllers\Product;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;

use App\Language;
use App\Mail\BasicMail;
use App\ProductCategory;
use App\ProductOrder;
use App\ProductRatings;
use App\Products;
use App\ProductsLang;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function all_product()
    {
        $all_products = Products::with('lang')->get();
        return view('backend.products.all-products')->with(['all_products' => $all_products]);
    }
    public function new_product()
    {
        $all_category = ProductCategory::with('lang')->where('status','publish')->get();
        return view('backend.products.new-product')->with(['all_categories' => $all_category]);
    }
    public function store_product(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request,[
            'category_id' => 'required',
            'regular_price' => 'nullable|max:191',
            'sale_price' => 'nullable|max:191',
            'sku' => 'nullable|max:191',
            'stock_status' => 'nullable|max:191',
            'is_downloadable' => 'nullable|max:191',
            'image' => 'nullable|max:191',
            'gallery' => 'nullable|max:191',
            'tax_percentage' => 'nullable|max:191',
            'status' => 'nullable|max:191',
            'downloadable_file' => 'nullable|mimes:zip|max:10650',
            'attributes_title' => 'nullable',
            'attributes_description' => 'nullable',
            'slug' => 'nullable',
            'description' => 'nullable',
            'short_description' => 'nullable',
            'meta_tags' => 'nullable|max:191',
            'meta_description' => 'nullable|max:191',
            'badge' => 'nullable',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title')
        ]);
        
        DB::beginTransaction();
        try {
            $product_id = Products::create([
                'category_id' => $request->category_id,
                'regular_price' => $request->regular_price,
                'sale_price' => $request->sale_price,
                'sku' => $request->sku,
                'stock_status' => $request->stock_status,
                'is_downloadable' => $request->is_downloadable,
                'image' => $request->image,
                'gallery' => $request->gallery,
                'tax_percentage' => $request->tax_percentage,
                'status' => $request->status,
            ])->id;
            
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ProductsLang::create([
                'lang' => $lang_slug,
                'product_id'=> $product_id,
                'title' => $request->title[$lang_slug],
                'slug' => $request->slug[$lang_slug] ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug]),
                'badge' => $request->badge[$lang_slug],
                'description' => $request->description[$lang_slug],
                'short_description' => $request->short_description[$lang_slug],
                'attributes_title' => serialize($request->attributes_title[$lang_slug] ?? []),
                'attributes_description' => serialize($request->attributes_description[$lang_slug] ?? []),
                'meta_description'=> $request->meta_description[$lang_slug],
                'meta_title'=> $request->meta_title[$lang_slug],
                'meta_tags'=> $request->meta_tags[$lang_slug],
                'og_meta_description'=> $request->og_meta_description[$lang_slug],
                'og_meta_title'=> $request->og_meta_title[$lang_slug],
                'og_meta_image'=> $request->og_meta_image[$lang_slug],
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        if ($request->hasFile('downloadable_file')){
            $file_extenstion = $request->downloadable_file->getClientOriginalExtension();
            if ($file_extenstion == 'zip'){
                $file_name_with_ext = $request->downloadable_file->getClientOriginalName();
                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));
                $file_db = $file_name . time() . '.' . $file_extenstion;
                $request->downloadable_file->move('assets/uploads/downloadable/', $file_db);
                Products::where('id',$product_id)->update(['downloadable_file' => $file_db]);
            }
        }
        return back()->with(FlashMsg::item_new());
    }

    public function product_order_view($id){
         $product = ProductOrder::findOrFail($id);
         return view('backend.products.product-order-view')->with(['product_order' => $product]);
    }
    public function edit_product($id){
        $product = Products::with('lang_all')->findOrFail($id);
        $all_category = ProductCategory::with('lang')->where('status','publish')->get();
        $check_diff =  array_merge(array_diff(exist_slugs($product), all_lang_slugs()), array_diff(all_lang_slugs(), exist_slugs($product)));
        if($check_diff != null){
           foreach ($check_diff as $key => $lang) {
            ProductsLang::create([
                'lang' => $lang,
                'product_id'=> $id,
                'title' => null, 
                'slug' => null, 
                'badge' => null, 
                'description' => null, 
                'short_description' => null, 
                'attributes_title' => null, 
                'attributes_description' => null, 
                'meta_description'=> null, 
                'meta_title'=> null, 
                'meta_tags'=> null, 
                'og_meta_description'=> null, 
                'og_meta_title'=> null, 
                'og_meta_image'=> null
            ]);
           }
        }
        $product = Products::with('lang_all')->findOrFail($id);
        return view('backend.products.edit-product')->with(['all_categories' => $all_category,'product' => $product]);
    }
    public function update_product(Request $request){
        $all_languages = Language::all();
        $product_details = Products::find($request->product_id);
        DB::beginTransaction();
        try {
            $product_details ->update([
                "category_id" => $request->category_id,
                "regular_price" => $request->regular_price,
                "sale_price" => $request->sale_price,
                "sku" => $request->sku,
                "stock_status" => $request->stock_status,
                "is_downloadable" => $request->is_downloadable,
                "image" => $request->image,
                "gallery" => $request->gallery,
                "tax_percentage" => $request->tax_percentage,
                "status" => $request->status,
            ]);
            foreach ($all_languages as $lang){
                $lang_slug = $lang->slug;
                ProductsLang::updateOrCreate(['product_id' => $request->product_id,'lang' => $lang->slug],[
                'title' => $request->title[$lang_slug],
                'slug' => $request->slug[$lang_slug] ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug]),
                'badge' => $request->badge[$lang_slug],
                'description' => $request->description[$lang_slug],
                'short_description' => $request->short_description[$lang_slug],
                'attributes_title' => serialize($request->attributes_title[$lang_slug]),
                'attributes_description' => serialize($request->attributes_description[$lang_slug]),
                'meta_description'=> $request->meta_description[$lang_slug],
                'meta_title'=> $request->meta_title[$lang_slug],
                'meta_tags'=> $request->meta_tags[$lang_slug],
                'og_meta_description'=> $request->og_meta_description[$lang_slug],
                'og_meta_title'=> $request->og_meta_title[$lang_slug],
                'og_meta_image'=> $request->og_meta_image[$lang_slug],
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        if ($request->hasFile('downloadable_file')){
            $file_extenstion = $request->downloadable_file->getClientOriginalExtension();
            if ($file_extenstion == 'zip'){
                $file_name_with_ext = $request->downloadable_file->getClientOriginalName();
                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_db = $file_name . time() . '.' . $file_extenstion;

                $request->downloadable_file->move('assets/uploads/downloadable/', $file_db);
                if (file_exists('assets/uploads/downloadable/'.$product_details->downloadable_file)){
                    @unlink('assets/uploads/downloadable/'.$product_details->downloadable_file);
                }
                $product_details ->update(['downloadable_file' => $file_db]);
            }
        }
        return back()->with(FlashMsg::item_update());
    }
    public function delete_product($id){
        $product_details = Products::find($id);
        if (file_exists('assets/uploads/downloadable/'.$product_details->downloadable_file)){
            @unlink('assets/uploads/downloadable/'.$product_details->downloadable_file);
        }
        $product_details->delete();
        ProductsLang::where('product_id',$id)->delete();
        return redirect()->back()->with(FlashMsg::item_delete());
    }
    public function clone_product(Request $request)
    {
        $products = Products::find($request->item_id);
        $product_langs = ProductsLang::where('product_id',$products->id)->get();
        $product_id = Products::create([
            'category_id' => $products->category_id,
            'regular_price' => $products->regular_price,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_status' => $products->stock_status,
            'is_downloadable' => $products->is_downloadable,
            'image' => $products->image,
            'gallery' => $products->gallery,
            'tax_percentage' => $products->tax_percentage,
            'status' => 'draft',
        ])->id;
        foreach ($product_langs as $key => $data) {
            $slug = $data->slug;
            $check_slug = ProductsLang::where('slug',$slug)->get();
            if (count($check_slug) > 0){
                $slug .= '-'.date('s');
            }
            ProductsLang::create([
                'lang' => $data->lang,
                'product_id'=> $product_id,
                'title' => $data->title,
                'badge' => $data->badge,
                'description' => $data->description,
                'short_description' => $data->short_description,
                'attributes_title' => $data->attributes_title,
                'attributes_description' => $data->attributes_description,
                'meta_description'=> $data->meta_description,
                'meta_title'=> $data->meta_title,
                'meta_tags'=> $data->meta_tags,
                'og_meta_description'=> $data->og_meta_description,
                'og_meta_title'=> $data->og_meta_title,
                'og_meta_image'=> $data->og_meta_image,
                'slug'=> $slug
            ]);
        }
        return back()->with(FlashMsg::item_clone());
    }

    public function download_file($id){
        $product_details = Products::find($id);
        if (file_exists('assets/uploads/downloadable/'.$product_details->downloadable_file)){
            $temp_file = asset('assets/uploads/downloadable/'.$product_details->downloadable_file);
            $file = new Filesystem();

            $file->copy($temp_file, 'assets/uploads/downloadable/'.Str::slug($product_details->title).'.zip');
            return response()->download('assets/uploads/downloadable/'.Str::slug($product_details->title).'.zip')->deleteFileAfterSend(true);
        }
        return redirect()->route('admin.home');
    }

    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.products.product-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
            'product_post_items' => 'nullable|string|max:191'
        ]);

        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request,[
                'product_add_to_cart_button_'.$lang->slug.'_text' => 'nullable|string|max:191',
                'product_category_'.$lang->slug.'_text' => 'nullable|string|max:191',
                'product_rating_filter_'.$lang->slug.'_text' => 'nullable|string|max:191',
                'product_price_filter_'.$lang->slug.'_text' => 'nullable|string|max:191',
            ]);
            $fields =[
                'product_add_to_cart_button_'.$lang->slug.'_text',
                'product_category_'.$lang->slug.'_text',
                'product_price_filter_'.$lang->slug.'_text',
                'product_rating_filter_'.$lang->slug.'_text',
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('product_post_items',$request->product_post_items);

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'),'type' => 'success']);
    }
    public function single_page_settings(){
        $all_languages = Language::all();
        return view('backend.products.product-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request){
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request,[
                'product_single_'.$lang->slug.'_add_to_cart_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_category_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_sku_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_description_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_attributes_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_related_product_text' => 'nullable|string|max:191',
                'product_single_'.$lang->slug.'_ratings_text' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_single_'.$lang->slug.'_add_to_cart_text' ,
                'product_single_'.$lang->slug.'_category_text' ,
                'product_single_'.$lang->slug.'_sku_text',
                'product_single_'.$lang->slug.'_description_text',
                'product_single_'.$lang->slug.'_attributes_text' ,
                'product_single_'.$lang->slug.'_related_product_text',
                'product_single_'.$lang->slug.'_ratings_text',
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('product_single_related_products_status',$request->product_single_related_products_status);
        update_static_option('product_single_products_review_status',$request->product_single_products_review_status);

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'),'type' => 'success']);
    }

    public function cancel_page_settings(){
        $all_languages = Language::all();
        return view('backend.products.product-cancel-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_cancel_page_settings(Request $request){
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request,[
                'product_cancel_page_'.$lang->slug.'_title' => 'nullable|string|max:191',
                'product_cancel_page_'.$lang->slug.'_description' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_cancel_page_'.$lang->slug.'_title' ,
                'product_cancel_page_'.$lang->slug.'_description' ,
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'),'type' => 'success']);
    }

    public function success_page_settings(){
        $all_languages = Language::all();
        return view('backend.products.product-success-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_success_page_settings(Request $request){
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request,[
                'product_success_page_'.$lang->slug.'_title' => 'nullable|string|max:191',
                'product_success_page_'.$lang->slug.'_description' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_success_page_'.$lang->slug.'_title' ,
                'product_success_page_'.$lang->slug.'_description' ,
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'),'type' => 'success']);
    }

    public function product_order_logs(){
        $all_orders = ProductOrder::all();
        return view('backend.products.product-orders-all')->with(['all_orders' => $all_orders]);
    }

    public function product_order_payment_approve(Request $request,$id){
        $order_details = ProductOrder::find($id);
        $order_details->payment_status = 'complete';
        $order_details->save();

        $site_title = get_static_option('site_'.get_default_language().'_title');
        $customer_subject = __('You order has been placed in').' '.$site_title;
        $admin_subject = __('You Have A New Product Order From').' '.$site_title;

        try{
             Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\ProductOrder($order_details,'owner',$admin_subject));
            Mail::to($order_details->billing_email)->send(new \App\Mail\ProductOrder($order_details,'customer',$customer_subject));
        }catch(\Exception $e){
            
        }
        
      

        return redirect()->back()->with(['msg' => __('Payment Status Updated..'),'type' => 'success']);
    }

    public function product_order_delete(Request $request,$id){
        ProductOrder::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Order Log Deleted..'),'type' => 'danger']);
    }

    public function product_order_status_change(Request $request){
        $this->validate($request,[
            'order_status' => 'nullable|string|max:191'
        ]);
        $order_details = ProductOrder::find($request->order_id);
        $cart_items = unserialize($order_details->cart_items,['class' => false]);
        $product = '';
        foreach($cart_items as $item){
            $product = Products::find($item['id']);
            if(!empty($product)){
                $product->sales += $item['quantity'];
                $product->save();
            }
        }
        $order_details->status = $request->order_status;
        $order_details->save();

        $data['subject'] = __('your order status has been changed');
        $data['message'] = __('hello').' '.$order_details->billing_name .'<br>';
        $data['message'] .= __('your order').' #'.$order_details->id.' ';
        $data['message'] .= __('status has been changed to').' '.str_replace('_',' ',$request->order_status).'.';
        //send mail while order status change
        try{
             Mail::to($order_details->billing_email)->send(new BasicMail($data));
        }catch(\Exception $e){
            
        }
       

        return redirect()->back()->with(['msg' => __('Product Order Status Update..'),'type' => 'success']);
    }

    public function generate_invoice(Request $request){
        $order_details = ProductOrder::find($request->order_id);
        $pdf = PDF::loadView('backend.products.pdf.order', ['order_details' => $order_details]);
        return $pdf->download('product-order-invoice.pdf');
    }

    public function product_ratings(){
        $all_ratings = ProductRatings::all();
        return view('backend.products.product-ratings-all')->with(['all_ratings' => $all_ratings]);
    }
    public function product_ratings_delete(Request $request, $id){
        ProductRatings::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Product Review Deleted..'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = Products::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function product_order_bulk_action(Request $request){
        $all = ProductOrder::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function product_ratings_bulk_action(Request $request){
        $all = ProductRatings::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function order_report(Request  $request)
    {
        $order_data = '';
        $query = ProductOrder::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->payment_status)){
            $query->where(['payment_status' => $request->payment_status ]);
        }
        if (!empty($request->order_status)){
            $query->where(['status' => $request->order_status ]);
        }
        $error_msg = __('select start & end date to generate event payment report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.products.product-order-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'error_msg' => $error_msg
        ]);
    }

    public function tax_settings(){
        $all_languages = Language::all();
        return view('frontend.pages.products.product-tax-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_tax_settings(Request $request){
        $this->validate($request,[
            'product_tax' => 'nullable|string',
            'product_tax_system' => 'nullable|string',
            'product_tax_type' => 'nullable|string',
            'product_tax_percentage' => 'nullable'
        ]);

        $all_fields = [
            'product_tax',
            'product_tax_system',
            'product_tax_type',
            'product_tax_percentage'
        ];

        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated'),'type' => 'success']);
    }

    public function order_reminder(Request $request){
        //send order reminder mail
        $order_details = ProductOrder::find($request->id);
        $data['subject'] = __('your order is still in pending at').' '. get_static_option('site_'.get_default_language().'_title');
        $data['message'] = __('hello').' '.$order_details->billing_name .'<br>';
        $data['message'] .= __('your order ').' #'.$order_details->id.' ';
        $data['message'] .= __('is still in pending, to complete your booking go to');
        $data['message'] .= ' <a href="'.route('user.home').'">'.__('your dashboard').'</a>';

        try{
            //send mail while order status change
        Mail::to($order_details->billing_email)->send(new BasicMail($data));
        }catch(\Exception $e){
            
        }

        return redirect()->back()->with(['msg' => __('Reminder Mail Send Success'),'type' => 'success']);
    }
}
