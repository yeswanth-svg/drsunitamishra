<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\BlogLang;
use App\Language;
use App\Menu;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class RecentBlogPostWidget extends WidgetBase
{

    /**
     * @inheritDoc
     */
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
            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="' .purify_html($widget_title) . '"></div>';

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

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        //Implement frontend_render() method.
        $icon_class = (get_user_lang_direction() == 'rtl')? 'ml-2' : '';
        $user_selected_language = get_user_lang();
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_' . $user_selected_language] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = Blog::all_blogs()->take($post_items)->get();
        
        $output = $this->widget_before(); //render widget before content
        $output .= '<div class="widget widget_recent_posts style-01">';
        if (!empty($widget_title)) {
            $output .= '<h4 class="widget-title style-01">' .purify_html($widget_title) . '</h4>';
        }
        $output .= '<ul class="recent_post_item">';

        foreach ($blog_posts as $post) {
            $output .= '<li class="single-recent-post-item">
                    <div class="thumb">' . render_image_markup_by_attachment_id(optional($post->blog_front)->image, '', 'thumb') . '</div>
                    <div class="content">
                        <h4 class="title"><a href="' . route('frontend.blog.single',['slug' => $post->blog_front->slug ?? 'x','id' => $post->id ]) . '">' .purify_html(optional($post->blog_front)->title) . '</a></h4>
                        <span class="time"> <i class="far fa-calendar-alt '.$icon_class.'"></i>' . optional(optional($post->blog_front)->created_at)->format('d M Y') . '</span>
                    </div>
                </li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '<br>';

        $output .= $this->widget_after(); // render widget after content
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        // TODO: Implement widget_title() method.
        return __('Sidebar Recent Blog Post');
    }
}