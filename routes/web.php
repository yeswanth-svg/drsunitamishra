<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*----------------------------------------------------------------------------------------------------------------------------
| FRONTEND
|----------------------------------------------------------------------------------------------------------------------------*/
Route::group(['middleware' =>['setlang:frontend','globalVariable','maintains_mode']],function (){
    $about_page_slug = get_static_option('about_page_slug') ?? 'about';
    $contact_page_slug = get_static_option('contact_page_slug') ?? 'contact';
    $blog_page_slug = get_static_option('blog_page_slug') ?? 'blog';
    $price_plan_page_slug = get_static_option('price_plan_page_slug') ?? 'price-plan';
    $service_page_slug = get_static_option('service_page_slug') ?? 'services';
    $product_page_slug = !empty(get_static_option('product_page_slug')) ? get_static_option('product_page_slug') : 'product';
    $quote_page_slug = !empty(get_static_option('quote_page_slug')) ? get_static_option('quote_page_slug') : 'quote';
    /*----------------------------------------------------------------------------------------------------------------------------
    | FRONTEND ROUTES
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::get('/','FrontendController@index')->name('homepage');
    Route::get('/home/{id}','FrontendController@home_page_change')->name('homepage.demo');
    Route::get('/p/{slug?}/{id}','FrontendController@dynamic_single_page')->name('frontend.dynamic.page');
    Route::get('/'.$quote_page_slug,'FrontendController@quote_page')->name('frontend.quote');
    Route::get('/'.$blog_page_slug,'FrontendController@blog_page')->name('frontend.blog');
    Route::get('/'.$blog_page_slug.'/{slug?}/{id}','FrontendController@blog_single_page')->name('frontend.blog.single');
    Route::get('/'.$blog_page_slug.'/search','FrontendController@blog_search_page')->name('frontend.blog.search');
    Route::get('/'.$blog_page_slug.'/category/{id}/{any}','FrontendController@category_wise_blog_page')->name('frontend.blog.category');
    Route::get('/'.$blog_page_slug.'-tags/{name}','FrontendController@tags_wise_blog_page')->name('frontend.blog.tags.page');
    Route::get('/'.$about_page_slug,'FrontendController@about_page')->name('frontend.about');
    Route::get('/'.$service_page_slug, 'FrontendController@service_page')->name('frontend.service');
    Route::get('/'.$service_page_slug . '/{slug?}/{id}', 'FrontendController@services_single_page')->name('frontend.services.single');
    Route::get('/'.$service_page_slug . '/category/{id}/{any?}', 'FrontendController@category_wise_services_page')->name('frontend.services.category');
    Route::get('/'.$contact_page_slug,'FrontendController@contact_page')->name('frontend.contact');
    Route::post('/request-quote','FrontendFormController@send_quote_message')->name('frontend.quote.message');
    /*----------------------------------------------------------------------------------------------------------------------------
    | APPOINTMENT FRONTEND ROUTES
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::group(['namespace'=>'Appointment\Frontend'],function (){
        $appointment_page_slug = !empty(get_static_option('appointment_page_slug')) ? get_static_option('appointment_page_slug') : 'appointment';
        //appointment details
        Route::get('/' . $appointment_page_slug, 'AppointmentController@page')->name('frontend.appointment');
        Route::get('/' . $appointment_page_slug . '/{slug?}/{id}', 'AppointmentController@single')->name('frontend.appointment.single');
        Route::get('/' . $appointment_page_slug . '-category/{id}/{any?}', 'AppointmentController@category')->name('frontend.appointment.category');
        Route::get('/' . $appointment_page_slug . '-search', 'AppointmentController@search')->name('frontend.appointment.search');
        Route::post('/' . $appointment_page_slug . '-booking', 'AppointmentBookingController@booking')->name('frontend.appointment.booking');
        Route::post('/' . $appointment_page_slug . '-review', 'AppointmentController@review')->name('frontend.appointment.review');
        Route::get('/'.$appointment_page_slug.'-success/{id}', 'AppointmentController@payment_success')->name('frontend.appointment.payment.success');
        Route::get('/'.$appointment_page_slug.'-cancel/{id}', 'AppointmentController@payment_cancel')->name('frontend.appointment.payment.cancel');
        //appointment payment ipn
        Route::get('/'.$appointment_page_slug.'-paypal-ipn', 'AppointmentBookingController@paypal_ipn')->name('frontend.appointment.paypal.ipn');
        Route::post('/appointment-paytm-ipn', 'AppointmentBookingController@paytm_ipn')->name('frontend.appointment.paytm.ipn');
        Route::post('/'.$appointment_page_slug.'-stripe', 'AppointmentBookingController@stripe_ipn')->name('frontend.appointment.stripe.ipn');
        Route::get('/'.$appointment_page_slug.'-stripe/pay', 'AppointmentBookingController@stripe_success')->name('frontend.appointment.stripe.success');
        Route::post('/'.$appointment_page_slug.'-razorpay', 'AppointmentBookingController@razorpay_ipn')->name('frontend.appointment.razorpay.ipn');
        Route::post('/'.$appointment_page_slug.'-paystack/pay', 'AppointmentBookingController@paystack_pay')->name('frontend.appointment.paystack.pay');
        Route::get('/'.$appointment_page_slug.'-mollie/webhook', 'AppointmentBookingController@mollie_webhook')->name('frontend.appointment.mollie.webhook');
        Route::get('/'.$appointment_page_slug.'-flutterwave/callback', 'AppointmentBookingController@flutterwave_callback')->name('frontend.appointment.flutterwave.callback');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    | PRODUCT FRONTEND ROUTES
    |----------------------------------------------------------------------------------------------------------------------------*/
    //product
    Route::get('/' . $product_page_slug, 'FrontendController@products')->name('frontend.products');
    Route::get('/' . $product_page_slug . '/{slug?}/{id}', 'FrontendController@product_single')->name('frontend.products.single');
    Route::get('/' . $product_page_slug . '-category/{id}/{any?}', 'FrontendController@products_category')->name('frontend.products.category');
    Route::get('/' . $product_page_slug . '-cart', 'FrontendController@products_cart')->name('frontend.products.cart');
    Route::post('/' . $product_page_slug . '-ratings', 'FrontendController@product_ratings')->name('product.ratings.store');
    Route::get('/' . $product_page_slug . '-checkout', 'FrontendController@product_checkout')->name('frontend.products.checkout');
    //product order
    Route::get('/' . $product_page_slug . '-success/{id}', 'FrontendController@product_payment_success')->name('frontend.product.payment.success');
    Route::get('/' . $product_page_slug . '-cancel/{id}', 'FrontendController@product_payment_cancel')->name('frontend.product.payment.cancel');
    //product payment ipn
    Route::post('/' . $product_page_slug . '-cart/remove', 'Product\ProductCartController@remove_cart_item')->name('frontend.products.cart.ajax.remove');
    Route::post('/' . $product_page_slug . '-item/add-to-cart', 'Product\ProductCartController@add_to_cart')->name('frontend.products.add.to.cart');
    Route::post('/' . $product_page_slug . '-item/ajax/add-to-cart', 'Product\ProductCartController@ajax_add_to_cart')->name('frontend.products.add.to.cart.ajax');
    Route::post('/' . $product_page_slug . '-item/ajax/coupon', 'Product\ProductCartController@ajax_coupon_code')->name('frontend.products.coupon.code');
    Route::post('/' . $product_page_slug . '-item/ajax/shipping', 'Product\ProductCartController@ajax_shipping_apply')->name('frontend.products.shipping.apply');
    Route::post('/' . $product_page_slug . '-item/ajax/cart-update', 'Product\ProductCartController@ajax_cart_update')->name('frontend.products.ajax.cart.update');
    Route::post('/' . $product_page_slug . '-checkout', 'Product\ProductOrderController@product_checkout');
    //product payment ipn
    Route::get('/product-paypal-ipn', 'Product\ProductOrderController@paypal_ipn')->name('frontend.product.paypal.ipn');
    Route::post('/product-paytm-ipn', 'Product\ProductOrderController@paytm_ipn')->name('frontend.product.paytm.ipn');

    Route::post('/product-stripe', 'Product\ProductOrderController@stripe_charge')->name('frontend.product.stripe.ipn');
    Route::get('/product-stripe/pay', 'Product\ProductOrderController@stripe_success')->name('frontend.product.stripe.success');

    Route::post('/product-razorpay', 'Product\ProductOrderController@razorpay_ipn')->name('frontend.product.razorpay.ipn');
    Route::post('/product-paystack/pay', 'Product\ProductOrderController@paystack_pay')->name('frontend.product.paystack.pay');
    Route::get('/product-flullterwave/pay', 'FrontendController@flutterwave_pay_get')->name('frontend.product.flutterwave.pay');
    Route::post('/product-flullterwave/pay', 'Product\ProductOrderController@flutterwave_pay');
    Route::get('/product-flullterwave/callback', 'Product\ProductOrderController@flutterwave_callback')->name('frontend.product.flutterwave.callback');
    Route::get('/product-mollie/webhook', 'Product\ProductOrderController@mollie_webhook')->name('frontend.product.mollie.webhook');
    //contact-message
    Route::post('/contact-message','FrontendFormController@send_contact_message')->name('frontend.contact.message');
    Route::post('/place-order','FrontendFormController@send_order_message')->name('frontend.order.message');
    //product invoice for user
    Route::post('/package-user/generate-invoice','FrontendController@generate_package_invoice')->name('frontend.package.invoice.generate');
    Route::get('/order-details/{id}','FrontendController@order_details')->name('frontend.order.view');
    Route::post('/products-user/generate-invoice', 'FrontendController@generate_invoice')->name('frontend.product.invoice.generate');
    //place order form
    Route::get('/'.$price_plan_page_slug,'FrontendController@price_plan_page')->name('frontend.price.plan');
    Route::get('/'.$price_plan_page_slug.'/{id}','FrontendController@plan_order')->name('frontend.plan.order');
    //payment status route
    Route::get('/order-success/{id}','FrontendController@order_payment_success')->name('frontend.order.payment.success');
    Route::get('/order-cancel/{id}','FrontendController@order_payment_cancel')->name('frontend.order.payment.cancel');
    Route::get('/order-confirm/{id}','FrontendController@order_confirm')->name('frontend.order.confirm');
    Route::post('/order-confirm','PaymentLogController@order_payment_form')->name('frontend.order.payment.form');
    //ipn route
    Route::get('/paypal-ipn','PaymentLogController@paypal_ipn')->name('frontend.paypal.ipn');
    Route::post('/paytm-ipn','PaymentLogController@paytm_ipn')->name('frontend.paytm.ipn');
    Route::get('/paystack/callback','PaymentLogController@paystack_callback')->name('frontend.paystack.callback');
    Route::get('/mollie/callback','PaymentLogController@mollie_webhook')->name('frontend.mollie.webhook');
    Route::post('/stripe','PaymentLogController@stripe_charge')->name('frontend.stripe.charge');
    Route::get('/stripe/pay','PaymentLogController@stripe_ipn')->name('frontend.stripe.ipn');
    Route::post('/razorpay','PaymentLogController@razorpay_ipn')->name('frontend.razorpay.ipn');
    Route::post('/flutterwave/pay','PaymentLogController@flutterwave_pay')->name('frontend.flutterwave.pay');
    Route::get('/flutterwave/callback','PaymentLogController@flutterwave_callback')->name('frontend.flutterwave.callback');
    Route::post('/paystack/pay','PaymentLogController@paystack_pay')->name('frontend.paystack.pay');
    /*----------------------------------------------------------------------------------------------------------------------------
    | USER DASHBOARD
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('user-home')->middleware(['userEmailVerify','setlang:backend','globalVariable'])->group(function (){
        Route::get('/', 'UserDashboardController@user_index')->name('user.home');
    Route::get('/download/file/{id}', 'UserDashboardController@download_file')->name('user.dashboard.download.file');
    Route::get('/package-orders', 'UserDashboardController@package_orders')->name('user.home.package.order');
    Route::get('/product-orders', 'UserDashboardController@product_orders')->name('user.home.product.order');
    Route::get('/product-download', 'UserDashboardController@product_downloads')->name('user.home.product.download');
    Route::get('/appointment-booking', 'UserDashboardController@appointment_booking')->name('user.home.appointment.booking');
    Route::get('/change-password', 'UserDashboardController@change_password')->name('user.home.change.password');
    Route::get('/edit-profile', 'UserDashboardController@edit_profile')->name('user.home.edit.profile');
    Route::post('/profile-update', 'UserDashboardController@user_profile_update')->name('user.profile.update');
    Route::post('/password-change', 'UserDashboardController@user_password_change')->name('user.password.change');
    Route::post('/package-order/cancel', 'UserDashboardController@package_order_cancel')->name('user.dashboard.package.order.cancel');
    Route::post('/product-order/cancel', 'UserDashboardController@product_order_cancel')->name('user.dashboard.product.order.cancel');
    Route::post('/appointment-order/cancel', 'UserDashboardController@appointment_order_cancel')->name('user.dashboard.appointment.order.cancel');
    Route::get('/product-order/view/{id}', 'UserDashboardController@product_order_view')->name('user.dashboard.product.order.view');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    | USER LOGIN - REGISTRATION
    |----------------------------------------------------------------------------------------------------------------------------*/
    //user login
    Route::get('/login','Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('/ajax-login','FrontendController@ajax_login')->name('user.ajax.login');
    Route::post('/login','Auth\LoginController@login');
    Route::get('/login/forget-password','FrontendController@showUserForgetPasswordForm')->name('user.forget.password');
    Route::get('/login/reset-password/{user}/{token}','FrontendController@showUserResetPasswordForm')->name('user.reset.password');
    Route::post('/login/reset-password','FrontendController@UserResetPassword')->name('user.reset.password.change');
    Route::post('/login/forget-password','FrontendController@sendUserForgetPasswordMail');
    Route::post('/logout','Auth\LoginController@logout')->name('user.logout');
    Route::get('/user-logout','FrontendController@user_logout')->name('frontend.user.logout');
    //user register
    Route::post('/register','Auth\RegisterController@register');
    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('user.register');
    //user email verify
    Route::get('/user/email-verify','UserDashboardController@user_email_verify_index')->name('user.email.verify');
    Route::get('/user/resend-verify-code','UserDashboardController@reset_user_email_verify_code')->name('user.resend.verify.mail');
    Route::post('/user/email-verify','UserDashboardController@user_email_verify');
});
/*----------------------------------------------------------------------------------------------------------------------------
| LANGUAGE CHANGE
|----------------------------------------------------------------------------------------------------------------------------*/
Route::get('/lang','FrontendController@lang_change')->name('frontend.langchange');
/*----------------------------------------------------------------------------------------------------------------------------
| ADMIN LOGIN
|----------------------------------------------------------------------------------------------------------------------------*/
Route::middleware(['setlang:backend'])->group(function (){
Route::get('/login/admin','Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('/login/admin/forget-password','FrontendController@showAdminForgetPasswordForm')->name('admin.forget.password');
Route::get('/login/admin/reset-password/{user}/{token}','FrontendController@showAdminResetPasswordForm')->name('admin.reset.password');
Route::post('/login/admin/reset-password','FrontendController@AdminResetPassword')->name('admin.reset.password.change');
Route::post('/login/admin/forget-password','FrontendController@sendAdminForgetPasswordMail');
Route::get('/logout/admin','AdminDashboardController@adminLogout')->name('admin.logout');
Route::post('/login/admin','Auth\LoginController@adminLogin');
});
/*----------------------------------------------------------------------------------------------------------------------------
| ADMIN PANEL ROUTES
|----------------------------------------------------------------------------------------------------------------------------*/
Route::prefix('admin-home')->middleware(['setlang:backend','adminglobalVariable'])->group(function (){
      // media upload routes end
    Route::post('/media-upload/all','MediaUploadController@all_upload_media_file')->name('admin.upload.media.file.all');
    Route::post('/media-upload','MediaUploadController@upload_media_file')->name('admin.upload.media.file');
    Route::post('/media-upload/alt','MediaUploadController@alt_change_upload_media_file')->name('admin.upload.media.file.alt.change');
});
Route::prefix('admin-home')->middleware(['setlang:backend','adminglobalVariable'])->group(function (){
    
    // media upload routes for restrict user in demo mode
    Route::get('/media-upload/page','MediaUploadController@all_upload_media_images_for_page')->name('admin.upload.media.images.page');
    Route::post('/media-upload/delete','MediaUploadController@delete_upload_media_file')->name('admin.upload.media.file.delete');
    /*----------------------------------------------------------------------------------------------------------------------------
    | GENERAL SETTINGS MANAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('general-settings')->group(function (){
        //site-identity
        Route::get('/site-identity','GeneralSettingsController@site_identity')->name('admin.general.site.identity');
        Route::post('/site-identity','GeneralSettingsController@update_site_identity');
        //basic-settings
        Route::get('/basic-settings','GeneralSettingsController@basic_settings')->name('admin.general.basic.settings');
        Route::post('/basic-settings','GeneralSettingsController@update_basic_settings');
        //seo settings
        Route::get('/seo-settings','GeneralSettingsController@seo_settings')->name('admin.general.seo.settings');
        Route::post('/seo-settings','GeneralSettingsController@update_seo_settings');
        //scripts settings
        Route::get('/scripts','GeneralSettingsController@scripts_settings')->name('admin.general.scripts.settings');
        Route::post('/scripts','GeneralSettingsController@update_scripts_settings');
        //email template settings
        Route::get('/email-template','GeneralSettingsController@email_template_settings')->name('admin.general.email.template');
        Route::post('/email-template','GeneralSettingsController@update_email_template_settings');
        //email settings
        Route::get('/email-settings','GeneralSettingsController@email_settings')->name('admin.general.email.settings');
        Route::post('/email-settings','GeneralSettingsController@update_email_settings');
        //typography settings
        Route::get('/typography-settings','GeneralSettingsController@typography_settings')->name('admin.general.typography.settings');
        Route::post('/typography-settings','GeneralSettingsController@update_typography_settings');
        Route::post('typography-settings/single','GeneralSettingsController@get_single_font_variant')->name('admin.general.typography.single');
        //smtp settings
        Route::get('/smtp-settings','GeneralSettingsController@smtp_settings')->name('admin.general.smtp.settings');
        Route::post('/smtp-settings','GeneralSettingsController@update_smtp_settings');
        //page settings
        Route::get('/page-settings','GeneralSettingsController@page_settings')->name('admin.general.page.settings');
        Route::post('/page-settings','GeneralSettingsController@update_page_settings');
        //payment gateway
        Route::get('/payment-settings', 'GeneralSettingsController@payment_settings')->name('admin.general.payment.settings');
        Route::post('/payment-settings', 'GeneralSettingsController@update_payment_settings');
        //custom css
        Route::get('/custom-css','GeneralSettingsController@custom_css_settings')->name('admin.general.custom.css');
        Route::post('/custom-css','GeneralSettingsController@update_custom_css_settings');
        //custom js
        Route::get('/custom-js','GeneralSettingsController@custom_js_settings')->name('admin.general.custom.js');
        Route::post('/custom-js','GeneralSettingsController@update_custom_js_settings');
        //gdpr-settings
        Route::get('/gdpr-settings','GeneralSettingsController@gdpr_settings')->name('admin.general.gdpr.settings');
        Route::post('/gdpr-settings','GeneralSettingsController@update_gdpr_cookie_settings');
        //sitemap
        Route::get('/sitemap-settings','GeneralSettingsController@sitemap_settings')->name('admin.general.sitemap.settings');
        Route::post('/sitemap-settings','GeneralSettingsController@update_sitemap_settings');
        Route::post('/sitemap-settings/delete','GeneralSettingsController@delete_sitemap_settings')->name('admin.general.sitemap.settings.delete');
        //license-setting
        Route::get('/license-setting','GeneralSettingsController@license_settings')->name('admin.general.license.settings');
        Route::post('/license-setting','GeneralSettingsController@update_license_settings');
        //popup-setting
        Route::get('/popup-settings','GeneralSettingsController@popup_settings')->name('admin.general.popup.settings');
        Route::post('/popup-settings','GeneralSettingsController@update_popup_settings');
        //cache settings
        Route::get('/cache-settings','GeneralSettingsController@cache_settings')->name('admin.general.cache.settings');
        Route::post('/cache-settings','GeneralSettingsController@update_cache_settings');

    });
    //admin index
    Route::get('/', 'AdminDashboardController@adminIndex')->name('admin.home');
    Route::get('/dark-mode-toggle', 'AdminDashboardController@dark_mode_toggle')->name('admin.dark.mode.toggle');
    //widget manage
    Route::get('/widgets','WidgetsController@index')->name('admin.widgets');
    Route::post('/widgets/create','WidgetsController@new_widget')->name('admin.widgets.new');
    Route::post('/widgets/markup','WidgetsController@widget_markup')->name('admin.widgets.markup');
    Route::post('/widgets/update','WidgetsController@update_widget')->name('admin.widgets.update');
    Route::post('/widgets/update/order','WidgetsController@update_order_widget')->name('admin.widgets.update.order');
    Route::post('/widgets/delete','WidgetsController@delete_widget')->name('admin.widgets.delete');
    //home page variant select
    Route::get('/home-variant',"AdminDashboardController@home_variant")->name('admin.home.variant');
    Route::post('/home-variant',"AdminDashboardController@update_home_variant");
    //navbar settings
    Route::get('/navbar-settings',"AdminDashboardController@navbar_settings")->name('admin.navbar.settings');
    Route::post('/navbar-settings',"AdminDashboardController@update_navbar_settings");
    //TOPBAR SETTINGS
    Route::get('/topbar-settings',"TopbarController@index")->name('admin.topbar.settings');
    Route::post('/topbar-settings','TopbarController@store');
    Route::post('/update-topbar-settings','TopbarController@update')->name('admin.topbar.update');
    Route::post('/delete-topbar-settings/{id}','TopbarController@delete')->name('admin.topbar.delete');
    Route::post('/topbar-settings/bulk-action','TopbarController@bulk_action')->name('admin.topbar.bulk.action');
    //INFOBAR SETTINGS
    Route::get('/infobar-settings',"InfoBarController@index")->name('admin.infobar.settings');
    Route::post('/infobar-settings','InfoBarController@store');
    Route::post('/update-infobar-settings','InfoBarController@update')->name('admin.infobar.update');
    Route::post('/delete-infobar-settings/{id}','InfoBarController@delete')->name('admin.infobar.delete');
    Route::post('/infobar-settings/bulk-action','InfoBarController@bulk_action')->name('admin.infobar.bulk.action');
    Route::post('/update-infobar-right-section','InfoBarController@update_infobar_right_section')->name('admin.infobar.right.section.update');
    Route::post('/infobar-right-section-icons','InfoBarController@store_right_icons')->name('admin.infobar.right.icons');
    Route::post('/update-infobar-right-section-icons','InfoBarController@update_right_icons')->name('admin.infobar.right.icons.update');
    Route::post('/delete-infobar-right-section-icons/{id}','InfoBarController@delete_right_icons')->name('admin.infobar.right.icons.delete');
    Route::post('/infobar-right-section-icons/bulk-action','InfoBarController@bulk_action_right_icons')->name('admin.infobar.right.icons.bulk.action');
    //blog page
    Route::get('/blog-page','AdminDashboardController@blog_page')->name('admin.blog.page');
    Route::post('/blog-page','AdminDashboardController@blog_page_update');
    //pages
    Route::get('/page','PagesController@index')->name('admin.page');
    Route::get('/new-page','PagesController@new_page')->name('admin.page.new');
    Route::post('/new-page','PagesController@store_new_page');
    Route::get('/page-edit/{id}','PagesController@edit_page')->name('admin.page.edit');
    Route::post('/page-update/{id}','PagesController@update_page')->name('admin.page.update');
    Route::post('/page-delete/{id}','PagesController@delete_page')->name('admin.page.delete');
    Route::post('/page-bulk-action','PagesController@bulk_action')->name('admin.page.bulk.action');
    //menu manage
    Route::get('/menu','MenuController@index')->name('admin.menu');
    Route::post('/new-menu','MenuController@store_new_menu')->name('admin.menu.new');
    Route::get('/menu-edit/{id}','MenuController@edit_menu')->name('admin.menu.edit');
    Route::post('/menu-update/{id}','MenuController@update_menu')->name('admin.menu.update');
    Route::post('/menu-delete/{id}','MenuController@delete_menu')->name('admin.menu.delete');
    Route::post('/menu-default/{id}','MenuController@set_default_menu')->name('admin.menu.default');
    Route::post('/mega-menu', 'MenuController@mega_menu_item_select_markup')->name('admin.mega.menu.item.select.markup');
    //404 page manage
    Route::get('404-page-manage','Error404PageManage@error_404_page_settings')->name('admin.404.page.settings');
    Route::post('404-page-manage','Error404PageManage@update_error_404_page_settings');
    // maintains page
    Route::get('/maintains-page/settings','MaintainsPageController@maintains_page_settings')->name('admin.maintains.page.settings');
    Route::post('/maintains-page/settings','MaintainsPageController@update_maintains_page_settings');
    /*----------------------------------------------------------------------------------------------------------------------------
    | ALL SECTIONS
    |----------------------------------------------------------------------------------------------------------------------------*/
    //TESTIMONIAL SECTION
    Route::get('/testimonial','TestimonialController@index')->name('admin.testimonial');
    Route::post('/testimonial','TestimonialController@store');
    Route::post('/update-testimonial','TestimonialController@update')->name('admin.testimonial.update');
    Route::post('/delete-testimonial/{id}','TestimonialController@delete')->name('admin.testimonial.delete');
    Route::post('/testimonial-bulk-action','TestimonialController@bulk_action')->name('admin.testimonial.bulk.action');
    //KEYFEATURES SECTION
    Route::get('/keyfeatures','KeyFeaturesController@index')->name('admin.keyfeatures');
    Route::post('/keyfeatures','KeyFeaturesController@store');
    Route::post('/update-keyfeatures','KeyFeaturesController@update')->name('admin.keyfeatures.update');
    Route::post('/delete-keyfeatures/{id}','KeyFeaturesController@delete')->name('admin.keyfeatures.delete');
    Route::post('/keyfeatures-bulk-action','KeyFeaturesController@bulk_action')->name('admin.keyfeatures.bulk.action');
    //PRICE PLAN SECTION
    Route::get('/price-plan','PricePlanController@index')->name('admin.price.plan');
    Route::get('/new-price-plan','PricePlanController@add')->name('admin.price.plan.new');
    Route::post('/new-price-plan','PricePlanController@store');
    Route::get('/edit-price-plan/{id}','PricePlanController@edit')->name('admin.price.plan.edit');
    Route::post('/update-price-plan/{id}','PricePlanController@update')->name('admin.price.plan.update');
    Route::post('/delete-price-plan/{id}','PricePlanController@delete')->name('admin.price.plan.delete');
    Route::post('/price-plan-bulk-action','PricePlanController@bulk_action')->name('admin.price.plan.bulk.action');
    Route::post('/price-plan-clone','PricePlanController@clone_price_plan')->name('admin.price.plan.clone');
    //COUNTERUP SECTION
    Route::get('/counterup','CounterUpController@index')->name('admin.counterup');
    Route::post('/counterup','CounterUpController@store');
    Route::post('/update-counterup','CounterUpController@update')->name('admin.counterup.update');
    Route::post('/delete-counterup/{id}','CounterUpController@delete')->name('admin.counterup.delete');
    Route::post('/counterup/bulk-action','CounterUpController@bulk_action')->name('admin.counterup.bulk.action');
    //ProgressBar SETTINGS
    Route::post('/progressbar','ProgressBarController@store')->name('admin.progressbar');
    Route::post('/update-progressbar','ProgressBarController@update')->name('admin.progressbar.update');
    Route::post('/delete-progressbar/{id}','ProgressBarController@delete')->name('admin.progressbar.delete');
    Route::post('/progressbar/bulk-action','ProgressBarController@bulk_action')->name('admin.progressbar.bulk.action');
    /*----------------------------------------------------------------------------------------------------------------------------
    | HOMEPAGE MANAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    //homepage manage
    Route::prefix('home-page')->group(function (){
        //header slider
        Route::get('/header','HeaderSliderController@index')->name('admin.home.header');
        Route::post('/header','HeaderSliderController@store');
        Route::post('/update-header','HeaderSliderController@update')->name('admin.home.header.update');
        Route::post('/delete-header/{id}','HeaderSliderController@delete')->name('admin.home.header.delete');
        Route::post('/header/bulk-action/','HeaderSliderController@bulk_action')->name('admin.home.header.bulk.action');
        //testimonial area
        Route::get('/testimonial-area-settings','HomePageController@testimonial_area')->name('admin.home.testimonial');
        Route::post('/testimonial-area-settings','HomePageController@update_testimonial_area');
        //Quote area
        Route::get('/quote-area-settings','HomePageController@quote_area')->name('admin.home.quote');
        Route::post('/quote-area-settings','HomePageController@update_quote_area');
        //call-us-banner area
        Route::get('/call-us-banner-area-settings','HomePageController@call_us_banner_area')->name('admin.home.callus');
        Route::post('/call-us-banner-area-settings','HomePageController@update_call_us_banner_area');
        //why-choose-us area
        Route::get('/why-choose-us-area-settings','HomePageController@why_choose_us_area')->name('admin.home.why.choose.us');
        Route::post('/why-choose-us-area-settings','HomePageController@update_why_choose_us_area');
        //keyfeatures area
        Route::get('/keyfeatures-area-settings','HomePageController@keyfeatures_area')->name('admin.home.keyfeatures');
        Route::post('/keyfeatures-area-settings','HomePageController@update_keyfeatures_area');
        //price plan area
        Route::get('/price-plan-area-settings','HomePageController@price_plan_area')->name('admin.home.price.plan');
        Route::post('/price-plan-area-settings','HomePageController@update_price_plan_area');
        //full width service area
        Route::get('/full-width-service-settings','HomePageController@full_width_service_area')->name('admin.home.full.width.service');
        Route::post('/full-width-service-settings','HomePageController@update_full_width_service_area');
        //call to action area
        Route::get('/call-to-action-settings','HomePageController@call_to_action_area')->name('admin.home.call.to.action');
        Route::post('/call-to-action-settings','HomePageController@update_call_to_action_area');
        //latest blog area
        Route::get('/latest-blog-settings','HomePageController@latest_blog_area')->name('admin.home.blog.latest');
        Route::post('/latest-blog-settings','HomePageController@update_latest_blog_area');
        //counterup
        Route::get('/counterup-settings','HomePageController@counterup_settings')->name('admin.home.counterup');
        Route::post('/counterup-settings','HomePageController@update_counterup_settings');
        //team member
        Route::get('/team-member-settings','HomePageController@team_member_section')->name('admin.home.team.member');
        Route::post('/team-member-settings','HomePageController@update_team_member_section');
        //section manage
        Route::get('/section-manage','HomePageController@section_manage')->name('admin.home.section.manage');
        Route::post('/section-manage','HomePageController@update_section_manage');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    | ABOUT US PAGE MANAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('about-page')->group(function (){
        //about page
        Route::get('/about-us','AboutUsPageController@about_section')->name('admin.about.page.about');
        Route::post('/about-us','AboutUsPageController@update_about_section');
        //progressbar
        Route::get('/progressbar','AboutUsPageController@progressbar_section')->name('admin.about.progressbar');
        Route::post('/progressbar','AboutUsPageController@update_progressbar_section');
        //key feature
        Route::get('/why-choose-us-section','AboutUsPageController@whychoose_section')->name('admin.about.whychoose');
        Route::post('/why-choose-us-section','AboutUsPageController@update_whychoose_section');
        //section manage
        Route::get('/section-manage','AboutUsPageController@section_manage')->name('admin.about.page.section.manage');
        Route::post('/section-manage','AboutUsPageController@update_section_manage');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    | CONTACT PAGE MANAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('contact-page')->group(function (){
        //map
        Route::get('/settings','ContactPageController@contact_page_settings')->name('admin.contact.page.settings');
        Route::post('/settings','ContactPageController@update_contact_page');
        //section manage
        Route::get('/section-manage','ContactPageController@section_manage')->name('admin.contact.page.section.manage');
        Route::post('/section-manage','ContactPageController@update_section_manage');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    | Quote PAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::get('/quote-manage/all','QuoteManageController@all_quotes')->name('admin.quote.manage.all');
    Route::get('/quote-manage/pending','QuoteManageController@pending_quotes')->name('admin.quote.manage.pending');
    Route::get('/quote-manage/completed','QuoteManageController@completed_quotes')->name('admin.quote.manage.completed');
    Route::post('/quote-manage/change-status','QuoteManageController@change_status')->name('admin.quote.manage.change.status');
    Route::post('/quote-manage/send-mail','QuoteManageController@send_mail')->name('admin.quote.manage.send.mail');
    Route::post('/quote-manage/delete/{id}','QuoteManageController@quote_delete')->name('admin.quote.manage.delete');
    Route::get('/quote-manage/view/{id}','QuoteManageController@quote_view')->name('admin.quote.manage.view');
    Route::post('/quote-manage/bulk-action','QuoteManageController@bulk_action')->name('admin.quote.manage.bulk.action');
    Route::get('/quote-manage/quote-settings','QuoteManageController@index_quote')->name('admin.quote.settings');
    Route::post('/quote-manage/quote-settings','QuoteManageController@udpate_quote');
    /*----------------------------------------------------------------------------------------------------------------------------
    | BLOG
    |----------------------------------------------------------------------------------------------------------------------------*/
    //blog
    Route::get('/blog','BlogController@index')->name('admin.blog');
    Route::get('/new-blog','BlogController@new_blog')->name('admin.blog.new');
    Route::post('/new-blog','BlogController@store_new_blog');
    Route::get('/blog-edit/{id}','BlogController@edit_blog')->name('admin.blog.edit');
    Route::post('/blog-update/{id}','BlogController@update_blog')->name('admin.blog.update');
    Route::post('/blog-delete/{id}','BlogController@delete_blog')->name('admin.blog.delete');
    Route::post('/blog-bulk-action','BlogController@bulk_action_blog')->name('admin.blog.bulk.action');
    Route::post('/blog/clone','BlogController@clone_blog')->name('admin.blog.clone');
    //category
    Route::get('/blog-category','BlogController@category')->name('admin.blog.category');
    Route::post('/blog-category/store','BlogController@new_category')->name('admin.blog.category.store');
    Route::post('/update-blog-category','BlogController@update_category')->name('admin.blog.category.update');
    Route::post('/delete-blog-category/{id}','BlogController@delete_category')->name('admin.blog.category.delete');
    Route::post('/category-bulk-action', 'BlogController@bulk_action')->name('admin.blog.category.bulk.action');
    Route::post('/blog-lang-by-cat','BlogController@Language_by_slug')->name('admin.blog.lang.cat');
    //admin user role management
    Route::get('/new-user','UserRoleManageController@new_user')->name('admin.new.user');
    Route::post('/new-user','UserRoleManageController@new_user_add');
    Route::post('/user-update','UserRoleManageController@user_update')->name('admin.user.update');
    Route::post('/user-password-chnage','UserRoleManageController@user_password_change')->name('admin.user.password.change');
    Route::post('/delete-user/{id}','UserRoleManageController@new_user_delete')->name('admin.delete.user');
    Route::get('/all-user','UserRoleManageController@all_user')->name('admin.all.user');
    //user role management
    Route::get('/frontend/new-user','FrontendUserManageController@new_user')->name('admin.frontend.new.user');
    Route::post('/frontend/new-user','FrontendUserManageController@new_user_add');
    Route::post('/frontend/user-update','FrontendUserManageController@user_update')->name('admin.frontend.user.update');
    Route::post('/frontend/user-password-chnage','FrontendUserManageController@user_password_change')->name('admin.frontend.user.password.change');
    Route::post('/frontend/delete-user/{id}','FrontendUserManageController@new_user_delete')->name('admin.frontend.delete.user');
    Route::get('/frontend/all-user','FrontendUserManageController@all_user')->name('admin.all.frontend.user');
    Route::post('/frontend/all-user/bulk-action','FrontendUserManageController@bulk_action')->name('admin.all.frontend.user.bulk.action');
    Route::post('/frontend/all-user/email-status','FrontendUserManageController@email_status')->name('admin.all.frontend.user.email.status');
    //admin settings
    Route::get('/settings','AdminDashboardController@admin_settings')->name('admin.profile.settings');
    Route::get('/profile-update','AdminDashboardController@admin_profile')->name('admin.profile.update');
    Route::post('/profile-update','AdminDashboardController@admin_profile_update');
    Route::get('/password-change','AdminDashboardController@admin_password')->name('admin.password.change');
    Route::post('/password-change','AdminDashboardController@admin_password_chagne');
    //language
    Route::get('/languages','LanguageController@index')->name('admin.languages');
    Route::get('/languages/words/frontend/{id}','LanguageController@frontend_edit_words')->name('admin.languages.words.frontend');
    Route::get('/languages/words/backend/{id}','LanguageController@backend_edit_words')->name('admin.languages.words.backend');
    Route::post('/languages/words/update/{id}','LanguageController@update_words')->name('admin.languages.words.update');
    Route::post('/languages/new','LanguageController@store')->name('admin.languages.new');
    Route::post('/languages/update','LanguageController@update')->name('admin.languages.update');
    Route::post('/languages/delete/{id}','LanguageController@delete')->name('admin.languages.delete');
    Route::post('/languages/default/{id}','LanguageController@make_default')->name('admin.languages.default');
    Route::post('/languages/clone','LanguageController@clone_languages')->name('admin.languages.clone');
    Route::post('/languages/add-new-string','LanguageController@add_new_string')->name('admin.languages.add.string');
    //popup page
    Route::get('/popup-builder/all','GeneralSettingsController@all_popup')->name('admin.popup.builder.all');
    Route::get('/popup-builder/new','GeneralSettingsController@new_popup')->name('admin.popup.builder.new');
    Route::post('/popup-builder/new','GeneralSettingsController@store_popup');
    Route::get('/popup-builder/edit/{id}','GeneralSettingsController@edit_popup')->name('admin.popup.builder.edit');
    Route::post('/popup-builder/update/{id}','GeneralSettingsController@update_popup')->name('admin.popup.builder.update');
    Route::post('/popup-builder/delete/{id}','GeneralSettingsController@delete_popup')->name('admin.popup.builder.delete');
    Route::post('/popup-builder/clone/{id}','GeneralSettingsController@clone_popup')->name('admin.popup.builder.clone');
    Route::post('/popup-builder/bulk-action','GeneralSettingsController@bulk_action')->name('admin.popup.builder.bulk.action');
  
    //form builder route
    Route::get('/form-builder/order-form','FormBuilderController@order_form_index')->name('admin.form.builder.order');
    Route::post('/form-builder/order-form','FormBuilderController@update_order_form');
    Route::get('/form-builder/contact-form','FormBuilderController@contact_form_index')->name('admin.form.builder.contact');
    Route::post('/form-builder/contact-form','FormBuilderController@update_contact_form');
    Route::get('/form-builder/quote-form','FormBuilderController@quote_form_index')->name('admin.form.builder.quote');
    Route::post('/form-builder/quote-form','FormBuilderController@update_quote_form');
    //payment log route
    Route::get('/payment-logs','OrderManageController@all_payment_logs')->name('admin.payment.logs');
    Route::get('/payment-logs/view/{id}','OrderManageController@payment_logs_view')->name('admin.payment.view');
    Route::post('/payment-logs/delete/{id}','OrderManageController@payment_logs_delete')->name('admin.payment.delete');
    Route::post('/payment-logs/approve/{id}','OrderManageController@payment_logs_approve')->name('admin.payment.approve');
    Route::post('/payment-logs/bulk-action','OrderManageController@payment_log_bulk_action')->name('admin.payment.bulk.action');
    Route::get('/payment-logs/report','OrderManageController@payment_report')->name('admin.payment.report');
    /*----------------------------------------------------------------------------------------------------------------------------
    | PACKAGE ORDER MANAGE
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('package')->group(function (){
        Route::get('/order-manage/all','OrderManageController@all_orders')->name('admin.package.order.manage.all');
        Route::get('/order-manage/pending','OrderManageController@pending_orders')->name('admin.package.order.manage.pending');
        Route::get('/order-manage/completed','OrderManageController@completed_orders')->name('admin.package.order.manage.completed');
        Route::get('/order-manage/in-progress','OrderManageController@in_progress_orders')->name('admin.package.order.manage.in.progress');
        Route::post('/order-manage/change-status','OrderManageController@change_status')->name('admin.package.order.manage.change.status');
        Route::post('/order-manage/send-mail','OrderManageController@send_mail')->name('admin.package.order.manage.send.mail');
        Route::post('/order-manage/delete/{id}','OrderManageController@order_delete')->name('admin.package.order.manage.delete');
        
        Route::get('/order-manage/view/{id}','OrderManageController@order_view')->name('admin.package.order.manage.view');
          
        //thank you page
        Route::get('/order-manage/success-page','OrderManageController@order_success_payment')->name('admin.package.order.success.page');
        Route::post('/order-manage/success-page','OrderManageController@update_order_success_payment');
        //cancel page
        Route::get('/order-manage/cancel-page','OrderManageController@order_cancel_payment')->name('admin.package.order.cancel.page');
        Route::post('/order-manage/cancel-page','OrderManageController@update_order_cancel_payment');
        Route::get('/order-page','OrderPageController@index')->name('admin.package.order.page');
        Route::post('/order-page','OrderPageController@udpate');
        Route::post('/order-manage/bulk-action','OrderManageController@bulk_action')->name('admin.package.order.bulk.action');
        Route::post('/order-manage/reminder','OrderManageController@order_reminder')->name('admin.package.order.reminder');
        Route::get('/order-report','OrderManageController@order_report')->name('admin.package.order.report');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    |  appoointment routeprice
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::group(['prefix' => 'appointment','namespace'=>'Appointment\Backend','middleware' => 'auth:admin'],function () {
        Route::get('/all', 'AppointmentController@appointment_all')->name('admin.appointment.all');
        Route::get('/new', 'AppointmentController@appointment_new')->name('admin.appointment.new');
        Route::post('/new', 'AppointmentController@appointment_store');
        Route::get('/edit/{id}', 'AppointmentController@appointment_edit')->name('admin.appointment.edit');
        Route::post('/delete/{id}', 'AppointmentController@appointment_delete')->name('admin.appointment.delete');
        Route::post('/clone', 'AppointmentController@appointment_clone')->name('admin.appointment.clone');
        Route::post('/update', 'AppointmentController@appointment_update')->name('admin.appointment.update');
        Route::post('/cat-by-lang', 'AppointmentController@category_by_lang')->name('admin.appointment.category.by.lang');
        Route::post('/bulk-action', 'AppointmentController@bulk_action')->name('admin.appointment.bulk.action');
        Route::get('/form-builder', 'AppointmentController@form_builder')->name('admin.appointment.booking.form.builder');
        Route::post('/form-builder', 'AppointmentController@form_builder_save');
        Route::get('/settings', 'AppointmentController@settings')->name('admin.appointment.booking.settings');
        Route::post('/settings', 'AppointmentController@settings_save');
        //category
        Route::get('/category', 'AppointmentCategoryController@category_all')->name('admin.appointment.category.all');
        Route::post('/category/new', 'AppointmentCategoryController@category_new')->name('admin.appointment.category.store');
        Route::post('/category/update', 'AppointmentCategoryController@category_update')->name('admin.appointment.category.update');
        Route::post('/category/delete/{id}', 'AppointmentCategoryController@category_delete')->name('admin.appointment.category.delete');
        Route::post('/category/bulk-action', 'AppointmentCategoryController@bulk_action')->name('admin.appointment.category.bulk.action');
        //booking time
        Route::get('/booking-time', 'AppointmentBookingTimeController@booking_time_all')->name('admin.appointment.booking.time.all');
        Route::post('/booking-time/new', 'AppointmentBookingTimeController@booking_time_new')->name('admin.appointment.booking.time.store');
        Route::post('/booking-time/update', 'AppointmentBookingTimeController@booking_time_update')->name('admin.appointment.booking.time.update');
        Route::post('/booking-time/delete/{id}', 'AppointmentBookingTimeController@booking_time_delete')->name('admin.appointment.booking.time.delete');
        Route::post('/booking-time/bulk-action', 'AppointmentBookingTimeController@booking_bulk_action')->name('admin.appointment.booking.time.bulk.action');
        Route::post('/booking/update', 'AppointmentBookingTimeController@booking_update')->name('admin.appointment.booking.update');
        // appointment booking
        Route::get('/booking', 'AppointmentBookingController@booking_all')->name('admin.appointment.booking.all');
        Route::post('/booking/new', 'AppointmentBookingController@booking_new')->name('admin.appointment.booking.store');
        Route::post('/booking/update', 'AppointmentBookingController@booking_update')->name('admin.appointment.booking.update');
        Route::post('/booking/delete/{id}', 'AppointmentBookingController@booking_delete')->name('admin.appointment.booking.delete');
        Route::get('/booking/view/{id}', 'AppointmentBookingController@booking_view')->name('admin.appointment.booking.view');
        Route::post('/booking/bulk-action', 'AppointmentBookingController@bulk_action')->name('admin.appointment.booking.bulk.action');
        Route::post('/booking/approve-payment/{id}', 'AppointmentBookingController@approve_payment')->name('admin.appointment.booking.approve.payment');
        Route::post('/booking/reminder-mail', 'AppointmentBookingController@reminder_mail')->name('admin.appointment.booking.reminder.mail');
        // appointment booking
        Route::get('/review', 'AppointmentReviewController@review_all')->name('admin.appointment.review.all');
        Route::post('/review/delete/{id}', 'AppointmentReviewController@review_delete')->name('admin.appointment.review.delete');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    |  services route
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('services')->group(function () {
        //services
        Route::get('/', 'ServiceController@index')->name('admin.services');
        Route::post('/', 'ServiceController@store');
        Route::get('/new', 'ServiceController@new_service')->name('admin.services.new');
        Route::get('/edit/{id}', 'ServiceController@edit_service')->name('admin.services.edit');
        Route::post('/at-by-slug', 'ServiceController@category_by_slug')->name('admin.service.category.by.slug');
        Route::post('/update', 'ServiceController@update')->name('admin.services.update');
        Route::post('/clone', 'ServiceController@clone_service_as_draft')->name('admin.services.clone');
        Route::post('/bulk-action', 'ServiceController@bulk_action')->name('admin.services.bulk.action');
        Route::post('/clone', 'ServiceController@service_clone')->name('admin.service.clone');
        Route::post('/delete/{id}', 'ServiceController@delete')->name('admin.services.delete');

        Route::get('/category', 'ServiceController@category_index')->name('admin.service.category');
        Route::post('/category', 'ServiceController@category_store');
        Route::post('/update-category', 'ServiceController@category_update')->name('admin.service.category.update');
        Route::post('/delete-category/{id}', 'ServiceController@category_delete')->name('admin.service.category.delete');
        Route::post('/category/bulk-action', 'ServiceController@category_bulk_action')->name('admin.service.category.bulk.action');
        //service page
        Route::get('/page-settings', 'ServicePageController@service_page_settings')->name('admin.services.page.settings');
        Route::post('/page-settings', 'ServicePageController@update_service_page_settings');
        //service single page
        Route::get('/single-page-settings', 'ServicePageController@service_single_page_settings')->name('admin.services.single.page.settings');
        Route::post('/single-page-settings', 'ServicePageController@update_service_single_page_settings');
    });
    /*----------------------------------------------------------------------------------------------------------------------------
    |  products route
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('products')->namespace('Product')->group(function () {
        //products
        Route::get('/', 'ProductsController@all_product')->name('admin.products.all');
        Route::get('/new', 'ProductsController@new_product')->name('admin.products.new');
        Route::post('/new', 'ProductsController@store_product');
        Route::get('/edit/{id}', 'ProductsController@edit_product')->name('admin.products.edit');
        Route::post('/update', 'ProductsController@update_product')->name('admin.products.update');
        Route::post('/delete/{id}', 'ProductsController@delete_product')->name('admin.products.delete');
        Route::post('/clone', 'ProductsController@clone_product')->name('admin.products.clone');
        Route::post('/bulk-action', 'ProductsController@bulk_action')->name('admin.products.bulk.action');
        Route::get('/file/download/{id}', 'ProductsController@download_file')->name('admin.products.file.download');
        //product ratings
        Route::get('/product-ratings', 'ProductsController@product_ratings')->name('admin.products.ratings');
        Route::post('/product-ratings/delete/{id}', 'ProductsController@product_ratings_delete')->name('admin.products.ratings.delete');
        Route::post('/product-ratings/bulk-action', 'ProductsController@product_ratings_bulk_action')->name('admin.products.ratings.bulk.action');
        //orders
        Route::get('/product-order-logs', 'ProductsController@product_order_logs')->name('admin.products.order.logs');
        Route::get('/product-order-logs/view/{id}', 'ProductsController@product_order_view')->name('admin.products.order.view');
        Route::post('/product-order-logs/approve/{id}', 'ProductsController@product_order_payment_approve')->name('admin.products.order.payment.approve');
        Route::post('/product-order-logs/delete/{id}', 'ProductsController@product_order_delete')->name('admin.product.payment.delete');
        Route::post('/product-order-logs/status-change', 'ProductsController@product_order_status_change')->name('admin.product.order.status.change');
        Route::post('/product-order-logs/bulk-actoin', 'ProductsController@product_order_bulk_action')->name('admin.product.order.bulk.action');
        Route::post('/generate-invoice', 'ProductsController@generate_invoice')->name('admin.product.invoice.generate');
        Route::post('/order-reminder', 'ProductsController@order_reminder')->name('admin.product.order.reminder');
        //products  page settings
        Route::get('/page-settings', 'ProductsController@page_settings')->name('admin.products.page.settings');
        Route::post('/page-settings', 'ProductsController@update_page_settings');
        Route::get('/single-page-settings', 'ProductsController@single_page_settings')->name('admin.products.single.page.settings');
        Route::post('/single-page-settings', 'ProductsController@update_single_page_settings');
        Route::get('/success-page-settings', 'ProductsController@success_page_settings')->name('admin.products.success.page.settings');
        Route::post('/success-page-settings', 'ProductsController@update_success_page_settings');
        Route::get('/cancel-page-settings', 'ProductsController@cancel_page_settings')->name('admin.products.cancel.page.settings');
        Route::post('/cancel-page-settings', 'ProductsController@update_cancel_page_settings');
        Route::get('/order-report', 'ProductsController@order_report')->name('admin.products.order.report');
        Route::get('/tax-settings', 'ProductsController@tax_settings')->name('admin.products.tax.settings');
        Route::post('/tax-settings', 'ProductsController@update_tax_settings');
        //products category
        Route::get('/category', 'ProductCategoryController@all_product_category')->name('admin.products.category.all');
        Route::post('/category/new', 'ProductCategoryController@store_product_category')->name('admin.products.category.new');
        Route::post('/category/update', 'ProductCategoryController@update_product_category')->name('admin.products.category.update');
        Route::post('/category/delete/{id}', 'ProductCategoryController@delete_product_category')->name('admin.products.category.delete');
        Route::post('/category/lang', 'ProductCategoryController@category_by_language_slug')->name('admin.products.category.by.lang');
        Route::post('/category/bulk-action', 'ProductCategoryController@bulk_action')->name('admin.products.category.bulk.action');
        //coupon
        Route::get('/coupon', 'ProductCouponController@all_coupon')->name('admin.products.coupon.all');
        Route::post('/coupon/new', 'ProductCouponController@store_coupon')->name('admin.products.coupon.new');
        Route::post('/coupon/update', 'ProductCouponController@update_coupon')->name('admin.products.coupon.update');
        Route::post('/coupon/delete/{id}', 'ProductCouponController@delete_coupon')->name('admin.products.coupon.delete');
        Route::post('/coupon/bulk-action', 'ProductCouponController@bulk_action')->name('admin.products.coupon.bulk.action');
        //shipping
        Route::get('/shipping', 'ProductShippingController@all_shipping')->name('admin.products.shipping.all');
        Route::post('/shipping/new', 'ProductShippingController@store_all_shipping')->name('admin.products.shipping.new');
        Route::post('/shipping/update', 'ProductShippingController@update_shipping')->name('admin.products.shipping.update');
        Route::post('/shipping/delete/{id}', 'ProductShippingController@delete_shipping')->name('admin.products.shipping.delete');
        Route::post('/shipping/default/{id}', 'ProductShippingController@default_shipping')->name('admin.products.shipping.default');
        Route::post('/shipping/bulk-action', 'ProductShippingController@bulk_action')->name('admin.products.shipping.bulk.action');
    });
});
