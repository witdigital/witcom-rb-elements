<?php

/* ==========================================================================
    * Filename: render_template.php
    * Description: Front end for Coupon Grid Block
    * Author:  Ryan E. Mitchell

   [Table of contents]

    1. Includes and Dependencies
    2. Define Variables
        Get Wit Commander fields and set vars
    3. Get Posts
    4. Set instance specific vars
    5. Create Block Dynamic SCSS
    5. Compile SCSS
    7. Block Specific JS
    8. Render the Frontend
    ========================================================================== */


/* ===========================  Includes and Dependencies  ========================== */

use ScssPhp\ScssPhp\Compiler;


//  Check that post type is set and set as VAR
if (get_field('witcom_posts_slider_post_type')) :
    $witcoposttype = get_field('witcom_posts_slider_post_type');


    /* ==========================================================================
        Define Variables
       ========================================================================== */

    if (!empty($block)) {
        //    This instances ID
        $blockID = $block['id'];
        $blockName = $block['name'];
        // replace forward slash in block name for better compatibility
        $blockName = str_replace('/', '_', $blockName);
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'witcom-block ' . $blockName . ' ' . $blockID;
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    /* ===  Get Wit Commander fields and set vars   ==== */

//        Breakpoints
//        todo convert to plugin level class
    if (have_rows('witcom_breakpoints', 'option')):
        while (have_rows('witcom_breakpoints', 'option')): the_row();

            $witcom_breakpoint_xs = get_sub_field('witcom_breakpoint_xs');
            $witcom_breakpoint_sm = get_sub_field('witcom_breakpoint_sm');
            $witcom_breakpoint_md = get_sub_field('witcom_breakpoint_md');
            $witcom_breakpoint_lg = get_sub_field('witcom_breakpoint_lg');
            $witcom_breakpoint_xl = get_sub_field('witcom_breakpoint_xl');

        endwhile;
    endif;

    /* ===========================  Fonts  ========================== */

    if (get_field('witcom_body_font', 'option')) {
        $witcom_body_font = get_field('witcom_body_font', 'option');
    } else {
        $witcom_body_font = 'Georgia, serif;';
    }

    if (get_field('witcom_header_font', 'option')) {
        $witcom_header_font = get_field('witcom_header_font', 'option');
    } else {
        $witcom_header_font = 'Georgia, serif;';
    }





    /* ===  Set instance specific vars ==== */

    /* =========================== Layout ========================== */

    if (!get_field('witcom_post_slider_slider_on_desktop')) {
        $witcom_post_slider_slider_on_desktop = 'transform: initial !important;cursor: initial;';
    } else {
        $witcom_post_slider_slider_on_desktop = '';
    }

//Arrows

    if (get_field('witcom_post_slider_arrow_prev')) {
        $witcom_post_slider_arrow_prev = get_field('witcom_post_slider_arrow_prev');
    } else {
        $witcom_post_slider_arrow_prev = '<';
    }


    if (get_field('witcom_post_slider_arrow_next')) {
        $witcom_post_slider_arrow_next = get_field('witcom_post_slider_arrow_next');
    } else {
        $witcom_post_slider_arrow_next = '>';
    }


    if (get_field('witcom_post_slider_perview_mobile')) {
        $witcom_post_slider_perview_mobile = get_field('witcom_post_slider_perview_mobile');
    } else {
        $witcom_post_slider_perview_mobile = 1;
    }

    if (get_field('witcom_post_slider_perview_desktop')) {
        $witcom_post_slider_perview_desktop = get_field('witcom_post_slider_perview_desktop');
    } else {
        $witcom_post_slider_perview_desktop = 1;
    }


    if (get_field('witcom_post_slider_mobile_arrows')) {
        $witcom_post_slider_mobile_arrows = 'inline-block';
    } else {
        $witcom_post_slider_mobile_arrows = 'none';
    }


    if (get_field('witcom_post_slider_desktop_arrows')) {
        $witcom_post_slider_desktop_arrows = 'inline-block';
    } else {
        $witcom_post_slider_desktop_arrows = 'none';
    }


    if (get_field('witcom_post_slider_desktop_dots')) {
        $witcom_post_slider_desktop_dots = 'inline-block';
    } else {
        $witcom_post_slider_desktop_dots = 'none';
    }


    if (get_field('witcom_post_slider_mobile_dots')) {
        $witcom_post_slider_mobile_dots = 'inline-block';
    } else {
        $witcom_post_slider_mobile_dots = 'none';
    }


    /* =========================== Font Sizes  ========================== */


    /* =========================== Additional SCSS   ========================== */


    if (get_field('witcom_acf_post_slider_additional_scss')) {
        $witcom_acf_post_slider_additional_scss = get_field('witcom_acf_post_slider_additional_scss');
    } else {
        $witcom_acf_post_slider_additional_scss = '';
    }


    /* ==========================================================================
       Create Block Dynamic SCSS
       ========================================================================== */

    $witcom_acf_post_slider_scss = /** @lang SCSS */
        "

            .$blockID {
            
            
             .glide-wrapper {
                            position: relative;

                        }
            
          .glide {
//           height: 100px;
          }
            
            
            .glide__slides {
            
            
             @media only screen and (min-width: ${witcom_breakpoint_md}px){
//                               $witcom_post_slider_slider_on_desktop
                            }
            
            }
            
            
            
            
            
            .glide__slide {
            flex-shrink: unset;
            align-self: center;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            
            }
            
            
              .glide__arrows {
                      display: $witcom_post_slider_mobile_arrows;
              
                            @media only screen and (min-width: ${witcom_breakpoint_md}px){
                               display: $witcom_post_slider_desktop_arrows;
                            }
                            
                            .glide__arrow {
                            
                                position: absolute;
                                display: block;
                                top: calc(50% - 1em);
                                z-index: 2;
                                color: #fff;
                                text-transform: uppercase;
                                padding: 9px 12px;
                                background-color: transparent;
                                border: none;
                                border-radius: 4px;
                                box-shadow: none;
                                text-shadow: none;
                                opacity: 1;
                                cursor: pointer;
                                transition: opacity .15s ease,border .3s ease-in-out;
                                transform: translateY(-50%);
                                line-height: 1;
                            
                            }
                            
                            
                            
                            .glide__arrow--left {
                            left: -.5em;

                            }
                            .glide__arrow--right {
                             right: -.5em;
                             
                            }
                            
            
              }
            

               .glide__bullets {
                      display: $witcom_post_slider_mobile_dots;
               
                @media only screen and (min-width: ${witcom_breakpoint_md}px){
                               display: $witcom_post_slider_desktop_dots;
                            }
               
              
               }
             

               $witcom_acf_post_slider_additional_scss

            } /* End of .$blockID */

       ";  // end $witcom_split_content_scss


    /* ==========================================================================
       Compile SCSS
        todo evaluate if autoprefixer is needed.

       ========================================================================== */

    $scss = new Compiler();

    // Option to Crunch SCSS
    if (get_field('crunch_witcom_scss', 'option')):
        $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
    else:
        $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
    endif;


    $compiledCssCode = $scss->compile($witcom_acf_post_slider_scss);

    echo("<style id='witcom-post-slider-$blockID'>\r\n");
    echo $compiledCssCode;
    echo('</style>');


    /* ==========================================================================
       Render the Frontend
       ========================================================================== */


    $args = array(
    'post_type' => $witcoposttype,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    );

    $post_query = new WP_Query($args);

    if ($post_query->have_posts()):


    /* ===  Get post type options and set vars  ==== */


    /* =========================== Additional SCSS   ========================== */

    $witcom_button_radius = get_field('witcom_button_radius', 'option');

    if (get_field('witcom_review_grid_additional_scss')) {
    $witcom_review_grid_additional_scss = get_field('witcom_review_grid_additional_scss');
    } else {
    $witcom_review_grid_additional_scss = '';
    }


    /* ==========================================================================
    Create Block Dynamic SCSS
    ========================================================================== */

    $witcom_post_slider_scss = /** @lang SCSS */
    "

    .$blockID {


    $witcom_review_grid_additional_scss

    } /* End of .$blockID */

    ";  // end $witcom_split_content_scss


    /* ==========================================================================
    Compile SCSS
    todo evaluate if autoprefixer is needed.

    ========================================================================== */

    $scss = new Compiler();

    // Option to Crunch SCSS
    if (get_field('crunch_witcom_scss', 'option')):
    $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
    else:
    $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
    endif;


    $compiledCssCode = $scss->compile($witcom_post_slider_scss);

    echo("<style id='witcom-post-slider-$blockID'>\r\n");
    echo $compiledCssCode;
    echo('</style>');


    /* ==========================================================================
    Render the Frontend
    ========================================================================== */
    ?>


    <div class="<?php echo esc_attr($className); ?> witcom-post-slider">

        <div class="inner-wrapper">

            <div class="glide-wrapper">
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">

                        <div class="glide__slides posts">

                            <?php while ($post_query->have_posts()) : $post_query->the_post();

                                // Get the post ID for getting fields
                                $postId = get_the_id();
                                ?>

                                <div class="post glide__slide">

                                    <?php
//                                    the_title();
//                                    the_content();

                                    if (get_field('witcom_review_full_review', $postId)) { ?>

                                            <?php
                                        $fullReview = get_field('witcom_review_full_review', $postId);
                                        $out = strlen($fullReview) > 255 ? substr($fullReview,0,255)."..." : $fullReview;
                                        ?>
                                        <span class="witcom_review_full_review"> <?php echo $out; ?> </span>
                                    <?php }

                                    if (get_field('witcom_review_author', $postId)) { ?>
                                    <span class="witcom_review_author"> <?php the_field('witcom_review_author', $postId); ?> </span>
                                    <?php } ?>

                                </div>

                            <?php

                            endwhile;

                            wp_reset_postdata(); ?>

                        </div>
                    </div>

                    <div class="glide__arrows">
                        <button class="glide__arrow glide__arrow--left"><?php echo $witcom_post_slider_arrow_prev ?></button>
                        <button class="glide__arrow glide__arrow--right"><?php echo $witcom_post_slider_arrow_next ?></button>
                    </div>


                    <div class="glide__bullets" data-glide-el="controls[nav]">
                        <button class="glide__bullet" data-glide-dir="=0"></button>
                        <button class="glide__bullet" data-glide-dir="=1"></button>
                        <button class="glide__bullet" data-glide-dir="=2"></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
endif; ?>



    <?php
    /* ==========================================================================
       Block Specific JS
       ========================================================================== */
    ?>

    <!--<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.3.0/dist/css/glide.core.min.css">-->


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var <?php echo $blockID ?>Glide = new Glide('.<?php echo $blockID ?> .glide', {
                type: 'carousel',
                startAt: 1,
                gap: 32,
                // animationTimingFunc: ease,
                perView: <?php echo $witcom_post_slider_perview_desktop ?>,
                breakpoints: {
            <?php echo $witcom_breakpoint_md ?>:
            {
                perView: <?php echo $witcom_post_slider_perview_mobile ?>,
                gap: 32,
            }
        }
        })
            ;

            <?php echo $blockID ?>Glide.mount();

            const ArrowRight = document.querySelector('.<?php echo $blockID ?> .glide__arrow--right');
            ArrowRight.addEventListener('click', () => {
                <?php echo $blockID ?>Glide.go('>');
            });

            const Arrowleft = document.querySelector('.<?php echo $blockID ?> .glide__arrow--left');
            Arrowleft.addEventListener('click', () => {
                <?php echo $blockID ?>Glide.go('<');
            });


        });
    </script>

<?php
else :  // end of post type is set
    echo('no post type has been set');
endif; // end of check that posttype is set
