<?php
/**
 * Plugin Name:     Dearpdf Helper
 * Plugin URI:      https://pixelnib.com
 * Description:     Helper plugin for DearPDF
 * Author:          PixelNib
 * Author URI:      https://pixelnib.com
 * Text Domain:     dearpdf-helper
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Dearpdf_Helper
 */

    //Fixing slug for CPT
    add_filter( 'register_taxonomy_args', 'pn_taxonomy_args', 10, 2 );
    function pn_taxonomy_args( $args, $taxonomy ) {

    // Target "my-taxonomy"
    if ( 'dearpdf_category' !== $taxonomy ) {
        return $args;
    }

    // Set slug
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'dearpdf-helper' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'dearpdf-helper' ),
        'search_items'      => __( 'Search Categories', 'dearpdf-helper' ),
        'all_items'         => __( 'All Categories', 'dearpdf-helper' ),
        'view_item'         => __( 'View Category', 'dearpdf-helper' ),
        'parent_item'       => __( 'Parent Category', 'dearpdf-helper' ),
        'parent_item_colon' => __( 'Parent Category:', 'dearpdf-helper' ),
        'edit_item'         => __( 'Edit Category', 'dearpdf-helper' ),
        'update_item'       => __( 'Update Category', 'dearpdf-helper' ),
        'add_new_item'      => __( 'Add New Category', 'dearpdf-helper' ),
        'new_item_name'     => __( 'New Category Name', 'dearpdf-helper' ),
        'not_found'         => __( 'No Categories Found', 'dearpdf-helper' ),
        'back_to_items'     => __( 'Back to Categories', 'dearpdf-helper' ),
        'menu_name'         => __( 'Categories', 'dearpdf-helper' ),
    );

    $args = array(
            'labels' => $labels,
            'rewrite' => array('slug' => "books"),
            'hierarchical' => true,
    );

    // Return
    return $args;
}

include( plugin_dir_path( __FILE__ ) . 'include/inc/remove-action.php');
include( plugin_dir_path( __FILE__ ) . 'include/templates/single-page.php');
include( plugin_dir_path( __FILE__ ) . 'include/templates/categories-page.php');




//Enque bootstrap
function hook_javascript() { ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

<?php } add_action('wp_head', 'hook_javascript');

/**
 * Register sidebar area
 */
function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Books Sidebar', 'textdomain' ),
        'id'            => 'books-sidebar',
        'description'   => __( 'Widgets in this area will be shown on all books and category pages.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );


/**
 * Function to show the category hierarchy
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

        echo '<ul class="p-3 py-3">';
        foreach ( $subcategories as $subcategory ) {
            if ( $category->term_id != $subcategory->parent ) {
                continue;
            }

            echo '<li id="subject" class="mb-3"><a class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#' .  $subcategory->slug . '" aria-expanded="false" href="' . esc_url( get_term_link( $subcategory ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'astra' ), $subcategory->name ) ) . '">' . $subcategory->name . '</a></li>';
            echo '<div class="collapse" id="' .  $subcategory->slug . '"><ul id="books" class="btn-toggle-nav fw-normal pb-3 ms-4 small">';


            foreach ( $subsubcategories as $subsubcategory ) {
                if ( $subcategory->term_id != $subsubcategory->parent ) {
                    continue;
                }

                echo '<li id="list"><a class="" href="'.get_category_link($subsubcategory->term_id).'">' . $subsubcategory->name . '</a></li>';
            }

            echo '</ul></div>';
        }

        echo '</ul>';
    }
}

add_shortcode('gb_system', 'gautam_brothers_system');

//Equeue styles from assets
function pn_add_to_head() {
    if ( is_singular('dearpdf') || is_archive( 'dearpdf' ) ) {
            wp_enqueue_style( 'dearpdf-helper', plugins_url( '/assets/css/style.css', __FILE__ ) );
            wp_enqueue_script( 'dearpdf-helper', plugins_url( '/assets/js/script.js', __FILE__ ), array('jquery') );
    }
}

add_action( 'wp_enqueue_scripts', 'pn_add_to_head' );
