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
                            <?php echo  do_shortcode( '[dearpdf type="button" id="' . $post->ID . '"]View Sample[/dearpdf]' ) ; ?>
                        </div>
                        <div class="col mt-5">
                            <p>Preview other parts of this series:</p>
                            <?php

    echo get_the_tag_list(
        '<ul class="my-tags-list"><li>',
        '</li><li>',
        '</li></ul>',
        get_queried_object_id()
    );

?>
                            <div class="dropdown"><button class="btn btn-secondary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">Part 1 </button>
                                <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
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
                <aside class="mx-3 mx-lg-3 mx-xl-5 mt-5 mt-lg-0 bg-light">
                    <h4 class="p-4 fw-normal">Browse By Subject</h4>
                <?php dynamic_sidebar('books-sidebar'); ?>
                </aside>
            </div>
    </div> <!-- Closing row div -->
    <?php
    }

    add_action( "after_dearpdf_single_content", "pn_after_single_content", 9, 1 );
}

add_action("dearpdf_single_content", "pn_single_template_content", 9, 1);