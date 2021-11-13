<?php
/**
 * The template is for the category page for DearPDF.
 *
 * It contains content and sidebar.
 *
 * @package Neve
 */

add_action( "after_dearpdf_category_content", "pn_after_category_content" );
function pn_category_single_template_content(){
    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $postslist = get_posts(
        array(
            'post_type'      => 'dearpdf',
            'posts_per_page' => -1,
            'nopaging'       => true,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'dearpdf_category',
                    'field'    => 'slug',
                    'terms'    => $current_term->slug,
                )
            ),
        )
    ); ?>

    <div class="row pb-5 p-md-5 p-sm-3" style="min-height: 80vh;">
        <?php the_archive_title('<h1 class="fw-semibold mt-5 mb-3">', '</h1>'); ?>
        <div class="col-12 col-xl-8">
            <div class="row g-2">
                <?php
                if ( count( $postslist ) > 0 ) {
                    foreach ( $postslist as $post ) {
                        $post_data = get_post_meta( $post->ID, '_dearpdf_data' ,true); ?>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card pb-3">
                                    <a href="<?php the_permalink( $post->ID );?>">
                                        <?php echo '<img src=" ' . $post_data['pdfThumb'] . ' " class="img-fluid rounded-start" alt="book-cover" width="700" height="500"></img>'; ?>
                                    </a>
                                    <div class="card-body">
                                        <h6 class="pb-4" style="border-bottom: 1px solid #ccc; margin-bottom:20px; font-size: 0.9rem; font-weight: 600;"><?php echo get_the_title( $post->ID ) ; ?></h6>
                                        <a href="<?php the_permalink( $post->ID );?>" class="btn-category">Read Book</a>
                                    </div>
                                </div>
                            </div>
                <?php
                    }
                } else{
                    echo  '<h1>No Posts Found</h1><br>' ;
                }?>
            </div>
        </div>
    <?php add_action( 'dearpdf_category_content','pn_category_single_template_content' ); ?>
    <?php function pn_after_category_content() { ?>
        <div class="col-12 col-xl-4">
            <aside class="mx-3 mx-lg-3 mx-xl-4 mt-5 mt-lg-0 bg-light">
                <?php dynamic_sidebar('books-sidebar'); ?>
            </aside>
        </div>
    </div> <!-- Closing row div -->
    <?php }
}

