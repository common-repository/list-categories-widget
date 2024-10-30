<?php
new Custom_Post_Type_Widgets();
class Custom_Post_Type_Widgets
{
    /**
     * Sets up a new widget instance
     */
    public function __construct()
    {
        add_action('widgets_init', array($this, 'init'));
    }
    public function init()
    {
        register_widget('WP_Custom_Post_Type_Widgets_Categories');
    }
}
class WP_Custom_Post_Type_Widgets_Categories extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'widget_categories',
            'description'                 => esc_html('A list or dropdown of categories.', 'category-widget'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('custom-post-type-categories', esc_html('Categories (Custom Post Type)', 'category-widget'), $widget_ops);
    }
    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html('Categories', 'category-widget');
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $taxonomy = !empty($instance['taxonomy']) ? $instance['taxonomy'] : 'category';
        $c        = !empty($instance['count']) ? (bool) $instance['count'] : false;
        $h        = !empty($instance['hierarchical']) ? (bool) $instance['hierarchical'] : false;
        echo wp_kses_post($args['before_widget']); 
        if ($title) 
        {
            echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']); 
        }
        $cat_args = array(
            'orderby'      => 'name',
            'taxonomy'     => $taxonomy,
            'show_count'   => $c,
            'hierarchical' => $h,
            'sanitize_links' => 1,
            'walker'        => new List_Category_Images
        );?>
        <ul>
            <?php
            $cat_args['title_li'] = '';
            wp_list_categories(
                apply_filters(
                    'custom_post_type_widgets/categories/widget_categories_args',
                    $cat_args,
                    $instance,
                    $this->id,
                    $taxonomy
                )
            );
            ?>
        </ul>
        <?php
        echo wp_kses_post($args['after_widget']);
    }
    public function update($new_instance, $old_instance)
    {
        $instance                 = $old_instance;
        $instance['title']        = sanitize_text_field($new_instance['title']);
        $instance['taxonomy']     = stripslashes($new_instance['taxonomy']);
        $instance['count']        = !empty($new_instance['count']) ? (bool) $new_instance['count'] : false;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? (bool) $new_instance['hierarchical'] : false;
        return $instance;
    }
    public function form($instance)
    {
        $title        = isset($instance['title']) ? $instance['title'] : '';
        $taxonomy     = isset($instance['taxonomy']) ? $instance['taxonomy'] : '';
        $count        = isset($instance['count']) ? (bool) $instance['count'] : false;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : false;
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title'));   ?>"><?php esc_html_e('Title:', 'category-widget');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));   ?>" name="<?php echo esc_attr($this->get_field_name('title'));   ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <?php
            $taxonomies = get_taxonomies(array(), 'objects');
            if ($taxonomies) {
                printf(
                    '<p><label for="%1$s">%2$s</label>' .
                    '<select class="widefat" id="%1$s" name="%3$s">',
                    esc_attr($this->get_field_id('taxonomy')),
                    esc_html('Taxonomy:', 'category-widget'),
                    esc_html($this->get_field_name('taxonomy'))
                ); 
                foreach ($taxonomies as $taxobjects => $value) {
                    if (!$value->hierarchical) {
                        continue;
                    }
                    if ('nav_menu' === $taxobjects || 'link_category' === $taxobjects || 'post_format' === $taxobjects) {
                        continue;
                    }
                    printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($taxobjects),
                        selected($taxobjects, $taxonomy, false),
                        esc_html($value->label, 'category-widget') . ' ' . esc_html($taxobjects)
                    );
                }
                echo '</select></p>';
            }
            ?>
            <p>
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count'));   ?>" name="<?php echo esc_attr($this->get_field_name('count'));   ?>"<?php checked($count);?> />
                <label for="<?php echo esc_attr($this->get_field_id('count'));   ?>"><?php esc_html_e('Show post counts', 'category-widget');?></label><br />
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical'));   ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical'));   ?>"<?php checked($hierarchical);?> />
                <label for="<?php echo esc_attr($this->get_field_id('hierarchical'));   ?>"><?php esc_html_e('Show hierarchy', 'category-widget');?></label></p>
                <?php
            }
        }
