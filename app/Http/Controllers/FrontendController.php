<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Appointment;
use App\Page;
use App\Blog;
use App\BlogCategory;
use App\BlogCategoryLang;
use App\BlogLang;
use App\Counterup;
use App\KeyFeatures;
use App\PricePlan;
use App\HeaderSlider;
use App\Language;
use App\Mail\AdminResetEmail;
use App\Order;
use App\PaymentLogs;
use App\ProductCategory;
use App\ProductOrder;
use App\ProductRatings;
use App\Products;
use App\ProductShipping;
use App\ProgressBar;
use App\ServiceCategory;
use App\Services;
use App\User;
use App\Testimonial;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $selected_lang = !empty(session()->get('lang')) ? session()->get('lang') : Language::where('default',1)->first()->slug;
        $home_page_variant = get_static_option('home_page_variant');
      //dd($home_page_variant);
        $all_key_features = KeyFeatures::where('lang',$selected_lang)->get()->take(get_static_option('home_page_'.$home_page_variant.'_key_feature_item'));
        $heaer_sliders = HeaderSlider::where('lang',$selected_lang)->get();
      //dd($heaer_sliders);
        $all_why_choose_us = Services::with('lang_front','category_front')->find(unserialize(get_static_option('why_choose_us_selected_services')));
        if(empty($all_why_choose_us)){
            $all_why_choose_us = Services::with('lang_front','category_front')->take(4)->get();
        }
        $all_counterups = Counterup::where('lang',$selected_lang)->get();
        $all_team_members = Appointment::with('lang_front')->where('status','publish')->take(get_static_option('home_page_team_section_item'))->get();
        $all_testimonials = Testimonial::where('lang',$selected_lang)->get();
        $all_price_plans = PricePlan::with('lang_front')->take(get_static_option('home_page_price_plan_section_display_item'))->get();
        $all_recent_blogs = Blog::with(['category_front','blog_front'])->where(['status' => 'publish'])->orderBy('id', 'desc')->take(get_static_option('home_page_latest_blog_section_display_item'))->get();
        return view('frontend.frontend-home')->with([
            'all_key_features' => $all_key_features,
            'heaer_sliders' => $heaer_sliders,
            'all_why_choose_us' => $all_why_choose_us,
            'all_counterups' => $all_counterups,
            'all_team_members' => $all_team_members,
            'all_testimonials' => $all_testimonials,
            'all_price_plans' => $all_price_plans,
            'all_recent_blogs' => $all_recent_blogs
        ]);
    }
    public function home_page_change($id)
    {
        if (!in_array($id, ['01', '02', '03', '04'])) {
            abort(404);
        }
        $selected_lang = !empty(session()->get('lang')) ? session()->get('lang') : Language::where('default',1)->first()->slug;
        $home_page_variant = $id;
        $all_key_features = KeyFeatures::where('lang',$selected_lang)->get()->take(get_static_option('home_page_'.$home_page_variant.'_key_feature_item'));
        $heaer_sliders = HeaderSlider::where('lang',$selected_lang)->get();
        $all_why_choose_us = Services::with('lang_front','category_front')->find(unserialize(get_static_option('why_choose_us_selected_services'),['class' => false]));
        if(empty($all_why_choose_us)){
            $all_why_choose_us = Services::with('lang_front','category_front')->take(4)->get();
        }
        $all_counterups = Counterup::where('lang',$selected_lang)->get();
        $all_team_members = Appointment::with('lang_front')->where('status','publish')->take(get_static_option('home_page_team_section_item'))->get();
        $all_testimonials = Testimonial::where('lang',$selected_lang)->get();
        $all_price_plans = PricePlan::with('lang_front')->take(get_static_option('home_page_price_plan_section_display_item'))->get();
        $all_recent_blogs = Blog::with(['category_front','blog_front'])->where(['status' => 'publish'])->orderBy('id', 'desc')->take(get_static_option('home_page_latest_blog_section_display_item'))->get();
        return view('frontend.frontend-home-demo')->with([
            'all_key_features' => $all_key_features,
            'heaer_sliders' => $heaer_sliders,
            'all_why_choose_us' => $all_why_choose_us,
            'all_counterups' => $all_counterups,
            'all_team_members' => $all_team_members,
            'all_testimonials' => $all_testimonials,
            'all_price_plans' => $all_price_plans,
            'all_recent_blogs' => $all_recent_blogs,
            'home_page' => $id,
        ]);
    }

    public function ajax_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6'
        ], [
            'username.required'   => __('Username required'),
            'password.required' => __('Password required'),
            'password.min' => __('Password length must be 6 characters')
        ]);
        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return response()->json([
                'msg' => __('Login Success Redirecting'),
                'type' => 'danger',
                'status' => 'valid'
            ]);
        }
        return response()->json([
            'msg' => __('User name and password do not match'),
            'type' => 'danger',
            'status' => 'invalid'
        ]);
    }
    public function blog_page()
    {
        $all_recent_blogs = Blog::with('lang_front')->where('status','publish')->orderBy('id','DESC')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_blogs = Blog::with('lang_front')->where('status','publish')->paginate(get_static_option('blog_page_item'));
        $all_category = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->get();
        return view('frontend.pages.blog')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }
    public function category_wise_blog_page($id)
    {
        $all_blogs = Blog::with('lang_front')->where(['status'=>'publish','category_id'=>$id])->paginate(get_static_option('blog_page_item'));
        $all_recent_blogs = Blog::with('lang_front')->where('status','publish')->orderBy('id','DESC')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->get();
        $category_name = BlogCategoryLang::where(['category_id' => $id,'lang'=>front_default_lang()])->first()->name;
        return view('frontend.pages.blog-category')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'category_name' => $category_name,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }
    public function tags_wise_blog_page($tag)
    {
        $all_blogs = BlogLang::where('tags', 'LIKE', '%' . $tag . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));
        $all_recent_blogs = Blog::with('lang_front')->where('status','publish')->orderBy('id','DESC')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->get();
        return view('frontend.pages.blog-tags')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'tag_name' => $tag,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }
    public function blog_search_page(Request $request)
    {
        $all_recent_blogs = Blog::with('lang_front')->where('status','publish')->orderBy('id','DESC')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->get();
        $all_blogs = BlogLang::where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('content', 'LIKE', '%' . $request->search . '%')
            ->orWhere('tags', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));
        return view('frontend.pages.blog-search')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'search_term' => $request->search,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }
    public function blog_single_page($slug,$id){
        $blog_post = Blog::with('lang_front')->where('id',$id)->first();
        $all_recent_blogs = Blog::with('lang_front')->where('status','publish')->orderBy('id','DESC')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->get();
        return view('frontend.pages.blog-single')->with([
            'blog_post' => $blog_post,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }
    public function showAdminForgetPasswordForm()
    {
        return view('auth.admin.forget-password');
    }
    public function sendAdminForgetPasswordMail(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string:max:191'
        ]);
        $user_info = Admin::where('username', $request->username)->orWhere('email', $request->username)->first();
        $token_id = Str::random(30);
        $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
        if (empty($existing_token)) {
            DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
        }
        $message = __('Here is you password reset link, If you did not request to reset your password just ignore this mail.').' <a style="background-color:#d0f1ff;color:#fff;text-decoration:none;padding: 10px 15px;border-radius: 3px;display: block;width: 130px;margin-top: 20px;" href="' . route('admin.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">'.__('Click Reset Password').'</a>';
        if (sendEmail($user_info->email, $user_info->username, __('Reset Your Password'), $message)) {
            return redirect()->back()->with([
                'msg' => __('Check Your Mail For Reset Password Link'),
                'type' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'msg' => __('Something Wrong, Please Try Again!!'),
            'type' => 'danger'
        ]);
    }
    public function showAdminResetPasswordForm($username, $token)
    {
        return view('auth.admin.reset-password')->with([
            'username' => $username,
            'token' => $token
        ]);
    }
    public function AdminResetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user_info = Admin::where('username', $request->username)->first();
        $user = Admin::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('admin.login')->with(['msg' =>__( 'Password Changed Successfully'), 'type' => 'success']);
        }
        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }
    public function lang_change(Request $request)
    {
        session()->put('lang', $request->lang);
        return redirect()->route('homepage');
    }

    public function send_contact_message(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:191',
            'name' => 'required|string|max:191',
            'subject' => 'required|string|max:191',
            'message' => 'required'
        ]);
        $subject = 'From ' . get_static_option('site_title') . ' ' . $request->subject;
        if (sendPlanEmail(get_static_option('site_global_email'), $request->name, $subject, $request->message, $request->email)) {
            return redirect()->back()->with(['msg' => __('Thanks for your contact!!'), 'type' => 'success']);
        }
        return redirect()->back()->with(['msg' => __('Something goes wrong, Please try again later !!'), 'type' => 'danger']);
    }
    public function dynamic_single_page($slug,$id)
    {
        $page_post = Page::with('lang_front')->where('id', $id)->first();
        return view('frontend.pages.dynamic-single')->with([
            'page_post' => $page_post
        ]);
    }
    public function showUserForgetPasswordForm()
    {
        return view('frontend.user.forget-password');
    }
    public function sendUserForgetPasswordMail(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string:max:191'
        ]);
        $user_info = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        if (!empty($user_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
            }
            $message = __('Here is you password reset link, If you did not request to reset your password just ignore this mail.') . ' <a class="btn" href="' . route('user.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">' . __('Click Reset Password') . '</a>';
            $data = [
                'username' => $user_info->username,
                'message' => $message
            ];
            Mail::to($user_info->email)->send(new AdminResetEmail($data));

            return redirect()->back()->with([
                'msg' => __('Check Your Mail For Reset Password Link'),
                'type' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'msg' => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger'
        ]);
    }
    public function showUserResetPasswordForm($username, $token)
    {
        return view('frontend.user.reset-password')->with([
            'username' => $username,
            'token' => $token
        ]);
    }
    public function UserResetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user_info = User::where('username', $request->username)->first();
        $user = User::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('user.login')->with(['msg' => __('Password Changed Successfully'), 'type' => 'success']);
        }
        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }
    public function price_plan_page()
    {
        $default_lang = Language::where('default', 1)->first();
        $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;
        $all_price_plan = PricePlan::where(['lang' => $lang])->get()->groupBy('categories_id');
        return view('frontend.pages.price-plan')->with(['all_price_plan' => $all_price_plan]);
    }
    public function order_confirm($id)
    {
        $order_details = Order::find($id);
        return view('frontend.payment.order-confirm')->with(['order_details' => $order_details]);
    }
    public function order_payment_cancel($id)
    {
        $order_details = Order::find($id);
        return view('frontend.payment.payment-cancel')->with(['order_details' => $order_details]);
    }
    public function plan_order($id)
    {
        $order_details = PricePlan::find($id);
        return view('frontend.pages.package.order-page')->with([
            'order_details' => $order_details
        ]);
    }
    public function order_payment_success($id)
    {
        $extract_id = substr($id, 6);
        $extract_id =  substr($extract_id, 0, -6);
        $order_details = Order::find($extract_id);
        if (empty($order_details)) {
            return view('frontend.pages.404');
        }
        $package_details = PricePlan::find($order_details->package_id);
        $payment_details = PaymentLogs::where('order_id', $extract_id)->first();
        return view('frontend.payment.payment-success')->with(
            [
                'order_details' => $order_details,
                'package_details' => $package_details,
                'payment_details' => $payment_details,
            ]
        );
    }

    public function flutterwave_pay_get()
    {
        return redirect_404_page();
    }
    public function generate_package_invoice(Request $request)
    {
        $payment_details = PaymentLogs::where(['order_id' => $request->id])->first();
        $order_details = Order::where(['id' => $request->id])->first();
        if (empty($order_details)) {
            return redirect_404_page();
        }
        $pdf = PDF::loadView('invoice.package-order', ['order_details' => $order_details, 'payment_details' => $payment_details]);
        return $pdf->download('package-invoice.pdf');
    }
    public function generate_invoice(Request $request)
    {
        $order_details = ProductOrder::find($request->order_id);
        if (empty($order_details)) {
            return redirect_404_page();
        }
        $pdf = PDF::loadView('backend.products.pdf.order', ['order_details' => $order_details]);
        return $pdf->download('product-order-invoice.pdf');
    }
    public function order_details($id)
    {
        
        $order_details = Order::find($id);
        if(empty($order_details)){
            abort(404);
        }
        $package_details = PricePlan::find($order_details->package_id);
        $payment_details = PaymentLogs::where('order_id', $id)->first();
        return view('frontend.pages.package.view-order')->with(
            [
                'order_details' => $order_details,
                'package_details' => $package_details,
                'payment_details' => $payment_details,
            ]
        );
    }
    public function about_page()
    {
        $all_counterups = Counterup::where('lang',front_default_lang())->get();
        $all_progressbar = ProgressBar::where('lang',front_default_lang())->get();
        $all_team_members = Appointment::with('lang_front')->where('status','publish')->take(get_static_option('about_page_team_member_item'))->get();
        $all_why_choose_us = Services::with('lang_front','category_front')->find(unserialize(get_static_option('about_page_why_choose_us_selected_service_ids')));
        if(empty($all_why_choose_us)){
            $all_why_choose_us = Services::with('lang_front','category_front')->take(4)->get();
        }
        return view('frontend.pages.about-us')->with([
            'all_team_members' => $all_team_members,
            'all_counterups' => $all_counterups,
            'all_progressbar' => $all_progressbar,
            'all_why_choose_us' => $all_why_choose_us,
        ]);
    }

    public function contact_page()
    {
        return view('frontend.pages.contact-page');
    }
    // service Page
    public function service_page()
    {
        $all_services = Services::with('lang_front','category_front')->where(['status' => 'publish'])->orderBy('sr_order', 'asc')->paginate(get_static_option('service_page_service_items'));
        return view('frontend.pages.service.services')->with(['all_services' => $all_services]);
    }
    public function services_single_page($slug,$id)
    {
        $service_item = Services::with('lang_front')->find($id);
        $service_category = ServiceCategory::with('lang_front')->where('status','publish')->get();
        $price_plan =  !empty($service_item) && !empty($service_item->price_plan) ? PricePlan::with('lang_front')->find(unserialize($service_item->price_plan)) : '' ;
        return view('frontend.pages.service.service-single')->with(['service_item' => $service_item, 'service_category' => $service_category,'price_plan' => $price_plan]);
    }

    public function category_wise_services_page($id, $any)
    {
        $category_name = ServiceCategory::with('lang_front')->find($id)->lang_front->name;
        $service_item = Services::with('lang_front')->where(['categories_id' => $id])->paginate(6);
        return view('frontend.pages.service.service-category')->with(['service_items' => $service_item, 'category_name' => $category_name]);
    }
    public function user_logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    //products
    public function products(Request $request)
    {
        $selected_rating = $request->rating ? $request->rating : '';
        $search_term = $request->q ? $request->q : '';
        $query = Products::with(['lang_front'=>function($query) use($search_term){
            $query->where('title', 'LIKE', '%' . $search_term . '%');
        },'category_front']);
        if ($selected_rating != null) {
            $product_ids = [];
            $all_products_id = ProductRatings::where('ratings', '>=', $selected_rating)->get('product_id');
            foreach ($all_products_id as $product_id) {
                $product_ids[] = $product_id->product_id;
            }
            $query->find(array_unique($product_ids));
        }
        $query->where(['status' => 'publish']);
        $maximum_available_price = Products::max('sale_price');
        $all_category = ProductCategory::with('lang_front')->where('status','publish')->get();
        $selected_category = $request->cat_id ? $request->cat_id : '';
        
        $selected_order = $request->orderby ? $request->orderby : 'default';

        if ($selected_category) {
            $query->where(['category_id' => $selected_category]);
        }

        $min_price = $request->min_price ? $request->min_price : 0;
        $max_price = $request->max_price ? $request->max_price : $maximum_available_price;
        if ($min_price) {
            $query->where('sale_price', '>=', $min_price);
        }
        if ($max_price) {
            $query->where('sale_price', '<=', $max_price);
        }
        if ($selected_order == 'old') {
            $query->orderBy('id', 'ASC');
        } elseif ($selected_order == 'high_low') {
            $query->orderBy('sale_price', 'DESC');
        } elseif ($selected_order == 'low_high') {
            $query->orderBy('sale_price', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }
        $all_products = $query->paginate(get_static_option('product_post_items'));
        return view('frontend.pages.products.products')->with([
            'all_products' => $all_products,
            'all_category' => $all_category,
            'search_term' => $search_term,
            'selected_rating' => $selected_rating,
            'selected_order' => $selected_order,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'selected_category' => $selected_category,
            'maximum_available_price' => $maximum_available_price
        ]);
    }

    public function product_single($slug,$id)
    {
        $product = Products::with('lang_front')->where('id', $id)->first();
        if (empty($product)) {
            return redirect_404_page();
        }
        $related_products = Products::where('category_id', $product->category_id)->get()->except($product->id)->take(4);
        $average_ratings = ProductRatings::Where('product_id', $product->id)->pluck('ratings')->avg();
        return view('frontend.pages.products.product-single')->with(
            [
                'product' => $product,
                'related_products' => $related_products,
                'average_ratings' => $average_ratings
            ]);
    }

    public function products_category($id, $any)
    {
        $all_products = Products::with('lang_front')->where(['status' => 'publish', 'category_id' => $id])->orderBy('id', 'desc')->paginate(get_static_option('product_post_items'));
        $category_name = ProductCategory::with('lang_front')->find($id)->lang_front->name;
        return view('frontend.pages.products.product-category')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function products_cart()
    {
        $all_cart_items = get_cart_items();
        $all_shipping = ProductShipping::where(['lang' => get_default_language(), 'status' => 'publish'])->orderBy('order', 'ASC')->get();
        return view('frontend.pages.products.product-cart')->with([
            'all_cart_items' => $all_cart_items,
            'all_shipping' => $all_shipping,
        ]);
    }

    public function product_checkout()
    {
        return view('frontend.pages.products.product-checkout');
    }

    public function product_payment_success($id)
    {
        $extract_id = substr($id,6);
        $extract_id =  substr($extract_id,0,-6);
        $order_details = ProductOrder::find($extract_id);
        if (empty($order_details)) {
            return redirect_404_page();
        }
        return view('frontend.pages.products.product-success')->with(['order_details' => $order_details]);
    }

    public function product_payment_cancel($id)
    {
        $order_details = ProductOrder::find($id);
        if (empty($order_details)) {
            return redirect_404_page();
        }
        return view('frontend.pages.products.product-cancel')->with(['order_details' => $order_details]);
    }

    public function product_ratings(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'ratings' => 'required',
            'ratings_message' => 'nullable|string'
        ]);

        $existing_rating = ProductRatings::where(['product_id' => $request->product_id, 'user_id' => auth()->guard('web')->user()->id])->first();
        if (!empty($existing_rating)) {
            return redirect()->back()->with(['msg' => __('You have already rated this product'), 'type' => 'danger']);
        }
        ProductRatings::create([
            'ratings' => $request->ratings,
            'message' => $request->ratings_message,
            'product_id' => $request->product_id,
            'user_id' => auth()->guard('web')->user()->id
        ]);

        return redirect()->back()->with(['msg' => __('Thanks for your rating'), 'type' => 'success']);
    }

    public function quote_page(){

        return view('frontend.pages.quote-page');
    }
}
