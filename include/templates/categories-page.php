<?php
/**
 *
 * The template is for the category page for DearPDF.
 *
 * It contains content and sidebar.
 *
 * @package Neve
 */


function pn_category_single_template_content(){

    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $postslist = get_posts( array(
        'post_type'      => 'dearpdf',
        'posts_per_page' => -1,
        'nopaging'       => true,
        'tax_query'      => array( array(
        'taxonomy' => 'dearpdf_category',
        'field'    => 'slug',
        'terms'    => $current_term->slug,
    ) ),
    ) ); ?>
    <div class="row pb-5 p-md-5 p-sm-3" style="min-height: 80vh;">

    <?php the_archive_title('<h1 class="pb-5">', '</h1>'); ?>
    <div class="col-12 col-xl-8">
        <div class="row">
    <?php if ( count( $postslist ) > 0 ) {
        foreach ( $postslist as $post ) {
            $post_data = get_post_meta( $post->ID, '_dearpdf_data' ,true);
            echo '<div class="col-2">';
            echo '<a href="' . get_permalink( $post->ID ) . '">';
            echo '<img src=" ' . $post_data['pdfThumb'] . ' " class="d-block img-fluid img-thumbnail"></img>';
            echo '</a>';
            echo  '</div>' ;
        }
    } else {
        echo  '<h1>No Posts Found</h1><br>' ;
    }
    echo  '</div>' ;
    echo  '</div>' ;
    function pn_after_category_content() { ?>
        <div class="col-12 col-xl-4">
            <aside class="mx-3 mx-lg-3 mx-xl-5 mt-5 mt-lg-0 bg-light">
                <h4 class="p-4 fw-normal">Browse By Subject</h4>
            <?php dynamic_sidebar('books-sidebar'); ?>
            </aside>
        </div>
    </div> <!-- Closing row div -->
    <?php
    }
    add_action( 'dearpdf_category_content','pn_category_single_template_content' );
}

add_action( "after_dearpdf_category_content", "pn_after_category_content" );
