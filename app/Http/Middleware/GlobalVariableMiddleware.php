<?php

namespace App\Http\Middleware;

use App\InfobarRightIcons;
use App\Language;
use App\Menu;
use App\SocialIcons;
use App\StaticOption;
use App\TopbarInfo;
use Closure;

class GlobalVariableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->composer('*', function ($view) {
            $lang = !empty(session()->get('lang')) ? session()->get('lang') : Language::where('default',1)->first()->slug;
            $all_language = Language::where('status', 'publish')->get();
            $popup_id = get_static_option('popup_selected_'.$lang.'_id');
            $popup_details = \App\PopupBuilder::find($popup_id);
            $website_url = url('/');
            if (preg_match('/(xgenious)/',$website_url)){
                $popup_details = \App\PopupBuilder::where('lang',$lang)->inRandomOrder()->first();
            }
            $primary_menu = Menu::where(['status' => 'default'])->first();
            if(\Request::is('home/01')){
                $home_variant_number = '01';
            }
            elseif(\Request::is('home/02')){
                $home_variant_number = '02';
            }
            elseif(\Request::is('home/03')){
                $home_variant_number = '03';
            }
            elseif(\Request::is('home/04')){
                $home_variant_number = '04';
            }else{
                $home_variant_number = get_static_option('home_page_variant');
            }
            $all_topbar_infos = TopbarInfo::all();
            $all_social_icons = SocialIcons::all();
            $all_right_section_items = InfobarRightIcons::all();
            //make a function to call all static option by home page
            $static_option_arr = [
                'product_module_status',
                'site_white_logo',
                'site_google_analytics',
                'og_meta_image_for_site',
                'site_main_color_one',
                'site_main_color_two',
                'site_secondary_color',
                'site_heading_color',
                'site_paragraph_color',
                'heading_font',
                'heading_font_family',
                'body_font_family',
                'body_font_family',
                'site_rtl_enabled',
                'services_page_slug',
                'about_page_slug',
                'contact_page_slug',
                'blog_page_slug',
                'team_page_slug',
                'faq_page_slug',
                'works_page_slug',
                'site_third_party_tracking_code',
                'site_favicon',
                'home_page_variant',
                'item_license_status',
                'site_script_unique_key',
                'site_meta_'.$lang.'_description',
                'site_meta_'.$lang.'_tags',
                'site_'.$lang.'_title',
                'site_'.$lang.'_tag_line',
            ];
            $static_field_data = StaticOption::whereIn('option_name',$static_option_arr)->get()->mapWithKeys(function ($item) {
                return [$item->option_name => $item->option_value];
            })->toArray();
            $view->with('global_static_field_data', $static_field_data);
            $view->with('popup_details', $popup_details);
            $view->with('all_language', $all_language);
            $view->with('user_select_lang_slug', $lang);
            $view->with('home_variant_number', $home_variant_number);
            $view->with('primary_menu', $primary_menu->id);
            $view->with('all_social_icons', $all_social_icons);
            $view->with('all_topbar_infos', $all_topbar_infos);
            $view->with('all_right_section_items', $all_right_section_items);
        });
        return $next($request);
    }
}
