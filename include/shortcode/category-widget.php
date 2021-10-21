<?php
 /**
 * Template to show the category hierarchy
 * Usage: By default, shortcodes are not allowed to be executed in a custom HTML widget so, you have to use the HTML widghet and add this shortcode [gb_system].
 * Styled using Bootstrap
 */
function gautam_brothers_system(){
    $book_category = get_terms( 'dearpdf_category', array(
        'hide_empty' => 0,
        'exclude' => 70, // Hard code the cat. id which you want to exclude
        'orderby' => 'name',
        'order' => 'ASC',
    ) );

        $subcategories = $subsubcategories = $book_category;

        foreach ( $book_category as $category ) {
            if ( 0 != $category->parent ) {
                continue;
            }

        echo '<ul class="p-0 mt-4">';
        foreach ( $subcategories as $subcategory ) {
            if ( $category->term_id != $subcategory->parent ) {
                continue;
            }

            echo '<li id="subject" class=" py-3 px-4"><i class="fas fa-chevron-right"></i><a class="align-items-center rounded collapsed" href="' . esc_url( get_term_link( $subcategory ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'astra' ), $subcategory->name ) ) . '">' . $subcategory->name . '</a></li>';
        }

        echo '</ul>';
    }
}

add_shortcode('gb_system', 'gautam_brothers_system');