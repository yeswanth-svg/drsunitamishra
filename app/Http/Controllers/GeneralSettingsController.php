<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\PopupBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Language;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapGenerator;

class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function site_identity()
    {
        return view('backend.general-settings.site-identity');
    }
    public function update_site_identity(Request $request)
    {
        $this->validate($request, [
            'site_logo' => 'nullable|string',
            'site_favicon' => 'nullable|string',
            'site_white_logo' => 'nullable|string',
            'site_heading_icon' => 'nullable|string',
            'site_breadcrumb_img' => 'nullable|string',
            'site_footer_img' => 'nullable|string',
        ]);
        $fields = [
            'site_logo',
            'site_favicon',
            'site_white_logo',
            'site_heading_icon',
            'site_breadcrumb_img',
            'site_footer_img'
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function basic_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.basic')->with(['all_languages' => $all_languages]);
    }
    public function update_basic_settings(Request $request)
    {
        $this->validate($request, [
            'language_select_option' => 'nullable|string',
            'disable_user_email_verify' => 'nullable|string',
            'site_main_color_one' => 'nullable|string',
            'site_main_color_two' => 'nullable|string',
            'site_secondary_color' => 'nullable|string',
            'site_heading_color' => 'nullable|string',
            'site_paragraph_color' => 'nullable|string',
            'site_maintenance_mode' => 'nullable|string',
            'admin_loader_animation' => 'nullable|string',
            'site_loader_animation' => 'nullable|string',
            'site_force_ssl_redirection' => 'nullable|string',
            'guest_order_system_status' => 'nullable|string',
            'admin_panel_rtl_status' => 'nullable|string',
            'site_google_captcha_enable' => 'nullable|string',
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang) {
            $this->validate($request, [
                'site_' . $lang->slug . '_title' => 'nullable|string',
                'site_' . $lang->slug . '_tag_line' => 'nullable|string',
                'site_' . $lang->slug . '_footer_copyright' => 'nullable|string',
            ]);
            $_title = 'site_' . $lang->slug . '_title';
            $_tag_line = 'site_' . $lang->slug . '_tag_line';
            $_footer_copyright = 'site_' . $lang->slug . '_footer_copyright';
            update_static_option($_title, $request->$_title);
            update_static_option($_tag_line, $request->$_tag_line);
            update_static_option($_footer_copyright, $request->$_footer_copyright);
        }
        $all_fields = [
            'site_payment_gateway',
            'language_select_option',
            'disable_user_email_verify',
            'site_main_color_one',
            'site_main_color_two',
            'site_secondary_color',
            'site_heading_color',
            'site_paragraph_color',
            'site_maintenance_mode',
            'admin_loader_animation',
            'site_loader_animation',
            'guest_order_system_status',
            'admin_panel_rtl_status',
            'site_force_ssl_redirection',
            'site_google_captcha_enable',
        ];
        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function seo_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.seo')->with(['all_languages' => $all_languages]);
    }
    public function update_seo_settings(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'site_meta_' . $lang->slug . '_tags' => 'nullable|string',
                'site_meta_' . $lang->slug . '_description' => 'nullable|string',
                'og_meta_' . $lang->slug . '_title' => 'nullable|string',
                'og_meta_' . $lang->slug . '_description' => 'nullable|string',
                'og_meta_' . $lang->slug . '_site_name' => 'nullable|string',
                'og_meta_' . $lang->slug . '_url' => 'nullable|string',
                'og_meta_' . $lang->slug . '_image' => 'nullable|string',
            ]);
            $fields = [
                'site_meta_' . $lang->slug . '_tags',
                'site_meta_' . $lang->slug . '_description',
                'og_meta_' . $lang->slug . '_title',
                'og_meta_' . $lang->slug . '_description',
                'og_meta_' . $lang->slug . '_site_name',
                'og_meta_' . $lang->slug . '_url',
                'og_meta_' . $lang->slug . '_image'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function scripts_settings()
    {
        return view('backend.general-settings.thid-party');
    }
    public function update_scripts_settings(Request $request)
    {

        $this->validate($request, [
            'site_disqus_key' => 'nullable|string',
            'tawk_api_key' => 'nullable|string',
            'site_third_party_tracking_code' => 'nullable|string',
            'site_google_analytics' => 'nullable|string',
            'site_google_captcha_v3_site_key' => 'nullable|string',
            'site_google_captcha_v3_secret_key' => 'nullable|string',
        ]);
        $fields = [
            'site_disqus_key',
            'site_google_analytics',
            'tawk_api_key',
            'site_google_captcha_v3_site_key',
            'site_google_captcha_v3_secret_key',
            'site_third_party_tracking_code',
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function email_template_settings()
    {
        return view('backend.general-settings.email-template');
    }
    public function update_email_template_settings(Request $request)
    {

        $this->validate($request, [
            'site_global_email' => 'required|string',
            'site_global_email_template' => 'required|string',
        ]);

        $save_data = [
            'site_global_email',
            'site_global_email_template'
        ];
        foreach ($save_data as $item) {
            if (empty($request->$item)) {
                continue;
            }
            update_static_option($item, $request->$item);
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function cache_settings()
    {
        return view('backend.general-settings.cache-settings');
    }
    public function email_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.email-settings')->with(['all_languages' => $all_languages]);
    }
    public function update_email_settings(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'contact_mail_' . $lang->slug . '_success_message' => 'nullable|string',
                'order_mail_' . $lang->slug . '_success_message' => 'nullable|string',

            ]);
            $fields = [

                'contact_mail_' . $lang->slug . '_success_message',
                'order_mail_' . $lang->slug . '_success_message',
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function update_cache_settings(Request $request)
    {

        $this->validate($request, [
            'cache_type' => 'required|string'
        ]);

        Artisan::call($request->cache_type . ':clear');

        return redirect()->back()->with(['msg' => __('Cache Cleaned'), 'type' => 'success']);
    }
    public function typography_settings()
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        return view('backend.general-settings.typograhpy')->with(['google_fonts' => json_decode($all_google_fonts)]);
    }
    public function get_single_font_variant(Request $request)
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        $decoded_fonts = json_decode($all_google_fonts, true);
        return response()->json($decoded_fonts[$request->font_family]);
    }
    public function update_typography_settings(Request $request)
    {
        $this->validate($request, [
            'body_font_family' => 'required|string|max:191',
            'body_font_variant' => 'required',
            'heading_font' => 'nullable|string',
            'heading_font_family' => 'nullable|string|max:191',
            'heading_font_variant' => 'nullable',
        ]);

        $save_data = [
            'body_font_family',
            'heading_font_family',
        ];
        foreach ($save_data as $item) {
            update_static_option($item, $request->$item);
        }
        $body_font_variant = !empty($request->body_font_variant) ? $request->body_font_variant : ['regular'];
        $heading_font_variant = !empty($request->heading_font_variant) ? $request->heading_font_variant : ['regular'];

        update_static_option('heading_font', $request->heading_font);
        update_static_option('body_font_variant', serialize($body_font_variant));
        update_static_option('heading_font_variant', serialize($heading_font_variant));

        return redirect()->back()->with(['msg' => __('Typography Settings Updated..'), 'type' => 'success']);
    }
    public function smtp_settings()
    {
        return view('backend.general-settings.smtp-settings');
    }
    public function update_smtp_settings(Request $request)
    {

        $this->validate($request, [
            'site_smtp_mail_host' => 'required|string',
            'site_smtp_mail_mailer' => 'required|string',
            'site_smtp_mail_port' => 'required|string',
            'site_smtp_mail_username' => 'required|string',
            'site_smtp_mail_password' => 'required|string',
            'site_smtp_mail_encryption' => 'required|string'
        ]);

        $fields = [
            'site_smtp_mail_mailer',
            'site_smtp_mail_host',
            'site_smtp_mail_port',
            'site_smtp_mail_username',
            'site_smtp_mail_password',
            'site_smtp_mail_encryption',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }
        $env_val['MAIL_MAILER'] = !empty($request->site_smtp_mail_mailer) ? $request->site_smtp_mail_mailer : 'smtp';
        $env_val['MAIL_HOST'] = !empty($request->site_smtp_mail_host) ? $request->site_smtp_mail_host : 'YOUR_SMTP_MAIL_HOST';
        $env_val['MAIL_PORT'] = !empty($request->site_smtp_mail_port) ? $request->site_smtp_mail_port : 'YOUR_SMTP_MAIL_POST';
        $env_val['MAIL_USERNAME'] = !empty($request->site_smtp_mail_username) ? $request->site_smtp_mail_username : 'YOUR_SMTP_MAIL_USERNAME';
        $env_val['MAIL_PASSWORD'] = !empty($request->site_smtp_mail_password) ? $request->site_smtp_mail_password : 'YOUR_SMTP_MAIL_USERNAME_PASSWORD';
        $env_val['MAIL_ENCRYPTION'] = !empty($request->site_smtp_mail_encryption) ? $request->site_smtp_mail_encryption : 'YOUR_SMTP_MAIL_ENCRYPTION';

        setEnvValue($env_val);

        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function page_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'about_page_slug' => 'nullable|string|max:191',
            'contact_page_slug' => 'nullable|string|max:191',
            'blog_page_slug' => 'nullable|string|max:191',
            'price_plan_page_slug' => 'nullable|string|max:191',
            'service_page_slug' => 'nullable|string|max:191',
            'product_page_slug' => 'nullable|string|max:191',
            'appointment_page_slug' => 'nullable|string|max:191',
            'quote_page_slug' => 'nullable|string|max:191',
        ]);
        $pages_list = ['about', 'contact', 'blog', 'price_plan', 'service', 'product', 'appointment', 'quote'];

        foreach ($pages_list as $slug_field) {
            $field = $slug_field . '_page_slug';
            update_static_option($field, Str::slug($request->$field));
        }
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'about_page_' . $lang->slug . '_name' => 'nullable|string',
                'about_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'about_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'contact_page_' . $lang->slug . '_name' => 'nullable|string',
                'contact_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'contact_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'blog_page_' . $lang->slug . '_name' => 'nullable|string',
                'blog_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'blog_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'price_plan_page_' . $lang->slug . '_name' => 'nullable|string',
                'price_plan_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'price_plan_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'service_page_' . $lang->slug . '_name' => 'nullable|string',
                'service_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'service_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'product_page_' . $lang->slug . '_name' => 'nullable|string',
                'product_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'product_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'appointment_page_' . $lang->slug . '_name' => 'nullable|string',
                'appointment_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'appointment_page_' . $lang->slug . '_meta_description' => 'nullable|string'
            ]);
            foreach ($pages_list as $field) {
                $field_name = $field . '_page_' . $lang->slug . '_name';
                $field_meta_tags = $field . '_page_' . $lang->slug . '_meta_tags';
                $field_meta_meta_description = $field . '_page_' . $lang->slug . '_meta_description';
                update_static_option($field_name, $request->$field_name);
                update_static_option($field_meta_tags, $request->$field_meta_tags);
                update_static_option($field_meta_meta_description, $request->$field_meta_meta_description);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function payment_settings()
    {
        return view('backend.general-settings.payment-gateway');
    }

    public function update_payment_settings(Request $request)
    {
        $this->validate($request, [
            'razorpay_preview_logo' => 'nullable|string|max:191',
            'stripe_preview_logo' => 'nullable|string|max:191',
            'paypal_gateway' => 'nullable|string|max:191',
            'paypal_preview_logo' => 'nullable|string|max:191',
            'paypal_client_id' => 'nullable|string|max:191',
            'paypal_secret' => 'nullable|string|max:191',
            'paytm_gateway' => 'nullable|string|max:191',
            'paytm_preview_logo' => 'nullable|string|max:191',
            'paytm_merchant_key' => 'nullable|string|max:191',
            'paytm_merchant_mid' => 'nullable|string|max:191',
            'paytm_merchant_website' => 'nullable|string|max:191',
            'site_global_currency' => 'nullable|string|max:191',
            'site_manual_payment_name' => 'nullable|string|max:191',
            'manual_payment_preview_logo' => 'nullable|string|max:191',
            'site_manual_payment_description' => 'nullable|string',
            'razorpay_key' => 'nullable|string|max:191',
            'razorpay_secret' => 'nullable|string|max:191',
            'stripe_publishable_key' => 'nullable|string|max:191',
            'stripe_secret_key' => 'nullable|string|max:191',
            'site_global_payment_gateway' => 'nullable|string|max:191',
            'paystack_merchant_email' => 'nullable|string|max:191',
            'paystack_preview_logo' => 'nullable|string|max:191',
            'paystack_public_key' => 'nullable|string|max:191',
            'paystack_secret_key' => 'nullable|string|max:191',
            'cash_on_delivery_gateway' => 'nullable|string|max:191',
            'cash_on_delivery_preview_logo' => 'nullable|string|max:191',
            'mollie_preview_logo' => 'nullable|string|max:191',
            'mollie_public_key' => 'nullable|string|max:191',
        ]);
        $save_data = [
            'cash_on_delivery_preview_logo',
            'stripe_preview_logo',
            'paystack_preview_logo',
            'paystack_public_key',
            'paystack_secret_key',
            'paystack_merchant_email',
            'razorpay_preview_logo',
            'paypal_preview_logo',
            'paypal_app_client_id',
            'paypal_app_secret',
            'paytm_preview_logo',
            'paytm_merchant_key',
            'paytm_merchant_mid',
            'paytm_merchant_website',
            'site_global_currency',
            'manual_payment_preview_logo',
            'site_manual_payment_name',
            'site_manual_payment_description',
            'razorpay_key',
            'razorpay_secret',
            'stripe_publishable_key',
            'stripe_secret_key',
            'site_global_payment_gateway',
            'site_usd_to_ngn_exchange_rate',
            'site_euro_to_ngn_exchange_rate',
            'mollie_public_key',
            'mollie_preview_logo',
            'flutterwave_preview_logo',
            'flutterwave_secret_key',
            'flutterwave_public_key',
            'site_currency_symbol_position',
            'site_default_payment_gateway',
        ];
        foreach ($save_data as $item) {
            update_static_option($item, $request->$item);
        }

        update_static_option('manual_payment_gateway', $request->manual_payment_gateway);
        update_static_option('paypal_gateway', $request->paypal_gateway);
        update_static_option('paytm_test_mode', $request->paytm_test_mode);
        update_static_option('paypal_test_mode', $request->paypal_test_mode);
        update_static_option('paytm_gateway', $request->paytm_gateway);
        update_static_option('razorpay_gateway', $request->razorpay_gateway);
        update_static_option('stripe_gateway', $request->stripe_gateway);
        update_static_option('paystack_gateway', $request->paystack_gateway);
        update_static_option('mollie_gateway', $request->mollie_gateway);
        update_static_option('cash_on_delivery_gateway', $request->cash_on_delivery_gateway);
        update_static_option('flutterwave_gateway', $request->flutterwave_gateway);

        $env_val['PAYSTACK_PUBLIC_KEY'] = $request->paystack_public_key ?: env('PAYSTACK_PUBLIC_KEY');
        $env_val['PAYSTACK_SECRET_KEY'] = $request->paystack_secret_key ?: env('PAYSTACK_SECRET_KEY');
        $env_val['MERCHANT_EMAIL'] = $request->paystack_merchant_email ?: 'example@gmail.com';
        $env_val['MOLLIE_KEY'] = $request->mollie_public_key ?: env('MOLLIE_KEY');
        $env_val['RAVE_PUBLIC_KEY'] = $request->flutterwave_public_key ?: env('RAVE_PUBLIC_KEY');
        $env_val['RAVE_SECRET_KEY'] = $request->flutterwave_secret_key ?: env('RAVE_SECRET_KEY');
        $env_val['PAYPAL_MODE'] = !empty($request->paypal_test_mode) ? 'sandbox' : 'live';
        $env_val['PAYPAL_CLIENT_ID'] = $request->paypal_app_client_id ?: env('PAYPAL_CLIENT_ID');
        $env_val['PAYPAL_SECRET'] = $request->paypal_app_secret ?: env('PAYPAL_SECRET');
        $env_val['PAYTM_ENVIRONMENT'] = !empty($request->paytm_test_mode) ? 'local' : 'production';
        $env_val['PAYTM_MERCHANT_ID'] = $request->paytm_merchant_mid ?: env('PAYTM_MERCHANT_ID');
        $env_val['PAYTM_MERCHANT_KEY'] = '"' . $request->paytm_merchant_key . '"' ?: env('PAYTM_MERCHANT_KEY');
        $env_val['PAYTM_MERCHANT_WEBSITE'] = '"' . $request->paytm_merchant_website . '"' ?: 'WEBSTAGING';
        $env_val['PAYTM_CHANNEL'] = '"' . $request->paytm_channel . '"' ?: 'WEB';
        $env_val['PAYTM_INDUSTRY_TYPE'] = '"' . $request->paytm_industry_type . '"' ?: 'Retail';
        $env_val['RAVE_TITLE'] = '"' . get_static_option('site_' . get_default_language() . '_title') . '"';
        $env_val['RAVE_ENVIRONMENT'] = getenv('APP_ENV') === 'local' ? "staging" : "live";
        $env_val['FLW_PUBLIC_KEY'] = $request->flutterwave_public_key ?: env('FLW_PUBLIC_KEY');
        $env_val['FLW_SECRET_KEY'] = $request->flutterwave_secret_key ?: env('FLW_SECRET_KEY');

        setEnvValue($env_val);

        $global_currency = get_static_option('site_global_currency');
        $currency_filed_name = 'site_' . strtolower($global_currency) . '_to_usd_exchange_rate';
        $inr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_inr_exchange_rate';
        $ngn_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_ngn_exchange_rate';

        update_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate', $request->$currency_filed_name);
        update_static_option('site_' . strtolower($global_currency) . '_to_inr_exchange_rate', $request->$inr_currency_filed_name);
        update_static_option('site_' . strtolower($global_currency) . '_to_ngn_exchange_rate', $request->$ngn_currency_filed_name);

        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function custom_css_settings()
    {
        $custom_css = '/* Write Custom Css Here */';
        if (file_exists('assets/frontend/css/dynamic-style.css')) {
            $custom_css = file_get_contents('assets/frontend/css/dynamic-style.css');
        }
        return view('backend.general-settings.custom-css')->with(['custom_css' => $custom_css]);
    }

    public function update_custom_css_settings(Request $request)
    {
        file_put_contents('assets/frontend/css/dynamic-style.css', $request->custom_css_area);

        return redirect()->back()->with(['msg' => __('Custom Style Successfully Added...'), 'type' => 'success']);
    }

    public function custom_js_settings()
    {
        $custom_js = '/* Write Custom js Here */';
        if (file_exists('assets/frontend/js/dynamic-script.js')) {
            $custom_js = file_get_contents('assets/frontend/js/dynamic-script.js');
        }
        return view('backend.general-settings.custom-js')->with(['custom_js' => $custom_js]);
    }

    public function update_custom_js_settings(Request $request)
    {
        file_put_contents('assets/frontend/js/dynamic-script.js', $request->custom_js_area);

        return redirect()->back()->with(['msg' => __('Custom Script Successfully Added...'), 'type' => 'success']);
    }
    public function gdpr_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.gdpr')->with(['all_languages' => $all_languages]);
    }

    public function update_gdpr_cookie_settings(Request $request)
    {

        $this->validate($request, [
            'site_gdpr_cookie_enabled' => 'nullable|string|max:191',
            'site_gdpr_cookie_expire' => 'required|string|max:191',
            'site_gdpr_cookie_delay' => 'required|string|max:191',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang) {
            $this->validate($request, [
                "site_gdpr_cookie_" . $lang->slug . "_title" => 'nullable|string',
                "site_gdpr_cookie_" . $lang->slug . "_message" => 'nullable|string',
                "site_gdpr_cookie_" . $lang->slug . "_more_info_label" => 'nullable|string',
                "site_gdpr_cookie_" . $lang->slug . "_more_info_link" => 'nullable|string',
                "site_gdpr_cookie_" . $lang->slug . "_accept_button_label" => 'nullable|string',
                "site_gdpr_cookie_" . $lang->slug . "_decline_button_label" => 'nullable|string',
            ]);
            $_title = "site_gdpr_cookie_" . $lang->slug . "_title";
            $_message = "site_gdpr_cookie_" . $lang->slug . "_message";
            $_more_info_label = "site_gdpr_cookie_" . $lang->slug . "_more_info_label";
            $_more_info_link = "site_gdpr_cookie_" . $lang->slug . "_more_info_link";
            $_accept_button_label = "site_gdpr_cookie_" . $lang->slug . "_accept_button_label";
            $decline_button_label = "site_gdpr_cookie_" . $lang->slug . "_decline_button_label";

            $fields = [
                $_title,
                $_message,
                $_more_info_label,
                $_more_info_link,
                $_accept_button_label,
                $decline_button_label,
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        $fields = [
            'site_gdpr_cookie_delay',
            'site_gdpr_cookie_enabled',
            'site_gdpr_cookie_expire',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }


    public function license_settings()
    {
        return view('backend.general-settings.license-settings');
    }

    public function update_license_settings(Request $request)
    {
        $this->validate($request, [
            'item_purchase_key' => 'required|string|max:191'
        ]);

        $response = Http::get('https://api.xgenious.com/license/new', [
            'purchase_code' => $request->item_purchase_key,
            'site_url' => url('/'),
            'item_unique_key' => 'bsS5QTe0ZUsK7miRTVIRXYhWoeJeeD63',
        ]);
        $result['msg'] = __('something went wrong try after sometimes');
        $type = 'danger';

        if ($response->ok()) {
            $result = $response->json();
            update_static_option('item_purchase_key', $request->item_purchase_key);
            update_static_option('item_license_status', $result['license_status']);
            update_static_option('item_license_msg', $result['msg']);

            $type = 'verified' == $result['license_status'] ? 'success' : 'danger';
            setcookie("site_license_check", "", time() - 3600, '/');
            $license_info = [
                "item_license_status" => $result['license_status'],
                "last_check" => time(),
                "purchase_code" => get_static_option('item_purchase_key'),
                "xgenious_app_key" => env('XGENIOUS_API_KEY'),
                "author" => env('XGENIOUS_API_AUTHOR'),
                "message" => $result['msg']
            ];
            file_put_contents('@core/license.json', json_encode($license_info));

        }

        return redirect()->back()->with(['msg' => $result['msg'], 'type' => $type]);
    }
    public function popup_settings()
    {
        $all_languages = Language::all();
        $all_popup = PopupBuilder::all()->groupBy('lang');
        return view('backend.general-settings.popup-settings')->with(['all_popup' => $all_popup, 'all_languages' => $all_languages]);
    }

    public function update_popup_settings(Request $request)
    {
        $this->validate($request, [
            'popup_enable_status' => 'nullable|string',
            'popup_delay_time' => 'nullable|string',
        ]);
        $fields = [
            'popup_enable_status',
            'popup_delay_time',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'popup_selected_' . $lang->slug . '_id' => 'nullable|string'
            ]);
            $field = 'popup_selected_' . $lang->slug . '_id';
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function sitemap_settings()
    {
        $all_sitemap = glob('sitemap/*');
        return view('backend.general-settings.sitemap-settings')->with(['all_sitemap' => $all_sitemap]);
    }

    public function update_sitemap_settings(Request $request)
    {
        $this->validate($request, [
            'site_url' => 'required|url',
            'title' => 'nullable|string',
        ]);
        $title = $request->title ? $request->title : time();
        SitemapGenerator::create($request->site_url)->writeToFile('sitemap/sitemap-' . $title . '.xml');
        return redirect()->back()->with([
            'msg' => __('Sitemap Generated..'),
            'type' => 'success'
        ]);
    }

    public function delete_sitemap_settings(Request $request)
    {
        if (file_exists($request->sitemap_name)) {
            @unlink($request->sitemap_name);
        }
        return redirect()->back()->with(['msg' => __('Sitemap Deleted...'), 'type' => 'danger']);
    }


    public function new_popup()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.popup-new')->with(['all_languages' => $all_languages]);
    }

    public function store_popup(Request $request)
    {
        $this->validate($request, [
            'lang' => 'required|string',
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::create([
            'lang' => $request->lang,
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('New Popup Added'), 'type' => 'success']);
    }

    public function all_popup()
    {
        $all_popup = PopupBuilder::all()->groupBy('lang');
        return view('backend.general-settings.popup-all')->with(['all_popup' => $all_popup]);
    }

    public function delete_popup(Request $request, $id)
    {
        PopupBuilder::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Popup Deleted...'), 'type' => 'danger']);
    }

    public function edit_popup($id)
    {
        $all_languages = Language::all();
        $popup = PopupBuilder::find($id);
        return view('backend.general-settings.popup-edit')->with(['all_languages' => $all_languages, 'popup' => $popup]);
    }

    public function update_popup(Request $request, $id)
    {
        $this->validate($request, [
            'lang' => 'required|string',
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::find($id)->update([
            'lang' => $request->lang,
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('Popup Update Success'), 'type' => 'success']);
    }
    public function clone_popup(Request $request, $id)
    {
        $popup_details = PopupBuilder::find($id);
        PopupBuilder::create([
            'lang' => $popup_details->lang,
            'name' => $popup_details->name,
            'title' => $popup_details->title,
            'type' => $popup_details->type,
            'description' => $popup_details->description,
            'offer_time_end' => $popup_details->offer_time_end,
            'btn_status' => $popup_details->btn_status,
            'button_text' => $popup_details->button_text,
            'button_link' => $popup_details->button_link,
            'background_image' => $popup_details->background_image,
            'only_image' => $popup_details->only_image,
        ]);
        return redirect()->back()->with(['msg' => __('Popup Clone Success'), 'type' => 'success']);
    }

    public function bulk_action(Request $request)
    {
        $all = PopupBuilder::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
