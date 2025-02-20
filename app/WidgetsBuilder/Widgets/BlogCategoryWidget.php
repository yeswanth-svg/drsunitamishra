<?php


namespace App\WidgetsBuilder\Widgets;


use App\BlogCategory;
use App\EventsCategory;
use App\Language;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class BlogCategoryWidget extends WidgetBase
{

    public function admin_render()
    {
        // TODO: Implement admin_render() method.
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //render language tab
        $output .= $this->admin_language_tab();
        $output .= $this->admin_language_tab_start();

        $all_languages = Language::all();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $widget_title = $widget_saved_values['widget_title_' . $lang->slug] ?? '';
            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="' .  purify_html($widget_title) . '"></div>';

            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end();
        //end multi langual tab option
        $post_items = $widget_saved_values['post_items'] ?? '';
        $output .= '<div class="form-group"><input type="number" name="post_items" class="form-control" placeholder="' . __('Post Items') . '" value="' . $post_items . '"></div>';

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        // TODO: Implement frontend_render() method.
        $icon_class = (get_user_lang_direction() == 'rtl')? 'left ml-2' : 'right';
        $user_selected_language = get_user_lang();
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_' . $user_selected_language] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = BlogCategory::with('category_front')->where('status','publish')->orderBy('id','desc')->take($post_items)->get();

        $output = $this->widget_before('widget_archive'); //render widget before content
        $output .=  '<div class="widget widget_archive style-01">';
        if (!empty($widget_title)) {
            $output .= '<h3 class="widget-title style-01">' .  purify_html($widget_title) . '</h3>';
        }
        $output .= '<ul>';
        foreach ($blog_posts as $post) {
            $output .= '<li><a href="' . route('frontend.blog.category', ['id' => $post->id,'any' => Str::slug(purify_html($post->category_front->name ?? 'x'))]) . '"> <i class="fas fa-chevron-'.$icon_class.'"></i>' .  purify_html(optional($post->category_front)->name) . '</a></li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        // TODO: Implement widget_title() method.
        return __('Blog Category');
    }
}