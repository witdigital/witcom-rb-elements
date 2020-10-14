<?php

/* ==========================================================================
    * Filename: enqueue-dynamic-styles.php
    * Description: Compile dynamic SCSS and write to front end and admin when the block exists.
    * Reference: https://scssphp.github.io/scssphp/docs/
    * Author:  Ryan E. Mitchell
    ========================================================================== */

/* ===========================  Includes and Dependencies  ========================== */

    use ScssPhp\ScssPhp\Compiler;

//    Include SCSS - creates the dynamic SCSS
    include 'block-dynamic-scss.php';

    /**
     *  Compile dynamic SCSS and write to front end and admin when the block exists.
     *
     *  @see blockDynamicSCSS()
     */
    function witcom_witcom_accordion_grid_dynamic_styles() {

        // Check that block is being used on current post.

        global $post;
        if ( has_blocks( $post->post_content ) ) {
            $blocks = parse_blocks( $post->post_content );

            // Only render if the post has is using this block
            // todo move checking if block exists to fire this function rather than being in it.
            if ( $blocks[0]['blockName'] === 'acf/witcom-coupon-grid' ) {

                $blockDynamicSCSS = blockDynamicSCSS();
                $scss = new Compiler();

                // Option to Crunch SCSS
                if( get_field('crunch_witcom_scss','option') ):
                    $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
                else:
                    $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
                endif;

                echo ("<style id='witcom_witcom_accordion_grid_styles'>");
                echo $scss->compile( $blockDynamicSCSS);
                echo ('</style>');
            }
        }

    }

    add_action('wp_footer','witcom_witcom_accordion_grid_dynamic_styles',100);
    add_action('admin_footer','witcom_witcom_accordion_grid_dynamic_styles',100);
