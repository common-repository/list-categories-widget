<?php
class Peacefulqode_Helper
{
    protected static $instance = null;

    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}


Peacefulqode_Helper::instance();

class List_Category_Images extends Walker_Category {
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
        $saved_data = wp_get_attachment_url( $thumbnail_id );



        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );


        $link = '<a href="' . ( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            $link .= 'title="' . esc_attr( wp_strip_all_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '>';

        $link .= $cat_name . '</a>';
        $link .= '<img src="' . esc_url($saved_data) . '">';

        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' (' . number_format_i18n( $category->count ) . ')';
        }

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $class = 'cat-item cat-item-' . $category->term_id;
            if ( ! empty( $args['current_category'] ) )
            {
                $_current_category = get_term( $args['current_category'], $category->taxonomy );
                if ( $category->term_id == $args['current_category'] ) {
                    $class .=  ' current-cat';
                } elseif ( $category->term_id == $_current_category->parent ) {
                    $class .=  ' current-cat-parent';
                }
            }
            $output .=  ' class="' . $class . '"';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}

