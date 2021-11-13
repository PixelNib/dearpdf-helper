<?php
/**
 * The template is for the single page for DearPDF.
 *
 * It contains content and sidebar.
 *
 * @package Neve
 */

 // Single book
function pn_single_template_content(){
    global  $post ;
    ?>
    <div class="row pb-5 p-md-5 p-sm-3" style="min-height: 80vh;">
        <div class="col-12 col-xl-8">
            <div class="row text-center d-lg-none d-md-block">
                <h1 class=" fw-semibold px-5 mt-5"><?php the_title(); ?></h1>
                <section class="d-flex justify-content-center py-5">
                    <div class="gb-page-divider"></div>
                </section>
            </div>
            <div class="card rounded-0 mb-3">
            <div class="row g-0">
                <div class="col-12 col-md-5">
                    <?php $post_data = get_post_meta( $post->ID, '_dearpdf_data' ,true); ?>
                    <?php echo '<img src=" ' . $post_data['pdfThumb'] . ' " class="img-fluid rounded-start" alt="book-cover" width="700" height="500"></img>'; ?>
                </div>
                <div class="col-12 col-md-7">
                    <div class="card-body p-5">
                        <h3 class="book-title"><?php the_title(); ?></h3>
                        <div class="col col-12 mt-2">
                       <?php if (strpos($_SERVER['REQUEST_URI'], "full") !== false){
                            echo  do_shortcode( '[dearpdf type="button" id="' . $post->ID . '"]View Fullbook[/dearpdf]' ) ;
                                } else {
                            echo  do_shortcode( '[dearpdf type="button" id="' . $post->ID . '"]View Sample[/dearpdf]' ) ;
                        }
                        ?>
                        </div>
                        <div class="col mt-5">
                            <label class="pb-3">Preview other parts of this series:</label>
                                <div class="drop-down-container">
                                <select id="book-series" class="form-select" aria-label="<?php the_title( ); ?>">
                                    <?php
                                        $posttag = wp_get_post_tags(get_the_ID());
                                        $first_tag = $posttag[0]->term_id;

                                        $postcat = wp_get_post_categories();

                                        $args = array (
                                            'post_type'      => 'dearpdf',
                                            'posts_per_page' => -1,
                                            'orderby'       => 'date',
                                            'order'     => 'ASC',
                                            'tag__in' => array($first_tag),
                                            "tax_query" => array(
                                                array(
                                                    "taxonomy" => "dearpdf_category",
                                                    "field"    => "term_id",
                                                    "terms"    => array( 43 ), // Add the Categofy ID from which you want to querry
                                                )
                                            ),
                                        );

                                        $myposts = get_posts( $args );

                                        if ( $myposts ) {
                                            foreach ( $myposts as $post ) :
                                            setup_postdata( $post ); ?>
                                                <option value="<?php the_permalink( ); ?>"><?php the_title(); ?></option>
                                                <?php
                                            endforeach;
                                        wp_reset_postdata();
                                        }
                                    ?>
                                </select>
                                    <a id="btn-for-book" class="btn-category" href="#">Open Book</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php

    function pn_after_single_content() { ?>
            <div class="col-12 col-xl-4">
                <aside class="mx-3 mx-lg-3 mx-xl-4 mt-5 mt-lg-0 bg-light">
                    <?php dynamic_sidebar('books-sidebar'); ?>
                </aside>
            </div>
    </div> <!-- Closing row div -->
    <?php
    }

    add_action( "after_dearpdf_single_content", "pn_after_single_content", 9, 1 );
}

add_action("dearpdf_single_content", "pn_single_template_content", 9, 1);