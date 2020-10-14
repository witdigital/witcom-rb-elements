<?php
    /* ==========================================================================
        * Filename: index.php
        * Description: Define ACF Block and include necessary functions
        * Reference: https://www.advancedcustomfields.com/resources/acf_register_block_type/
        * Author: Ryan E. Mitchell

        [Table of contents]

        1. Includes and Dependencies
        2. Register Block

    ========================================================================== */

/* ===========================  Includes and Dependencies  ========================== */

//    ACF Fields for this block
    include_once 'lib/acf-fields.php';

//   Hooks for this block
    include_once 'lib/hooks.php';

//  Global dynamic styles for this block
//   todo evaluate if block global styles are necessary
/* include_once 'lib/enqueue-dynamic-styles.php'; */

/* ==========================================================================
  Register Block
  ========================================================================== */

    /**
     *  Register Coupon Grid Block
     *  ACF/witcom-coupon-grid
     *
     */
    function witcom_services_boxes_register_blocks() {

        if ( ! function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        acf_register_block_type( array(
            'name'            => 'witcom-services-boxes',
            'title'           => __( 'WitCom Services Boxes' ),
            'render_template' => plugin_dir_path( __FILE__ ) . 'views/render_template.php',
            'enqueue_assets'  => function () {
                /* == Enqueue Scripts disabled - Styles and JS are part of /views/render_template.php to allow for ACF fields == */
                /* ==  To enable use the SCSS and JS in [block-name]/assets and set up to process in /webpack.mix.js == */
//            wp_enqueue_script( 'witcom-coupon-grid-script', plugin_dir_url( __FILE__ ). 'dist/block-scripts.js', array('jquery'), '', true );
//            wp_enqueue_style( 'witcom-coupon-grid-styles', plugin_dir_url( __FILE__ ) . 'dist/block-styles.css' );
            },
            'category'        => 'wit-blocks',
            'icon'            => array(
                'background' => '#0e8f94',
                'foreground' => '#ffffff',
                'src'        => 'layout',
            ),
            'align'           => 'wide',
            'mode'            => 'edit',
            'keywords'        => array( 'profile', 'user', 'author' ),
            'supports'        => array(
                'mode'     => true,
                'align'     => array( 'wide', 'full', 'center' ),
                'multiple' => true,
            )
        ) );
    }

    add_action( 'acf/init', 'witcom_services_boxes_register_blocks' );
