<?php
    /* ==========================================================================
        * Filename: witcom-setup.php
        * Description:  Enqueue styles and scripts
        * Author:  Ryan E. Mitchell
        * todo better commenting for enqueues

       [Table of contents]

        1. Enqueue Plugin Styles and Scripts
        ========================================================================== */

    /* ==========================================================================
       Enqueue Front End Plugin Styles and Scripts
       ========================================================================== */

    function witcom_rb_elements_assets() {

        wp_enqueue_script(
            'witcom-rb-elements',
            plugin_dir_url( __DIR__ ) . '/dist/app.js',
            array(  'witcom-commander' ),
            true
        );
        // Regular enqueue css
        wp_enqueue_style( 'witcom-rb-elements-styles', plugin_dir_url( __DIR__ ) . '/../dist/app.css' );
    }

//    add_action( 'wp_enqueue_scripts', 'witcom_rb_elements_assets' );

/* ==========================================================================
   Enqueue Editor Styles and Scripts
   ========================================================================== */

    /**
     * Enqueue block JavaScript and CSS for the editor
     */
    function witcom_rb_elements_block_plugin_editor_scripts() {

        // Enqueue block editor JS
        wp_enqueue_script(
            'witcom-rb-elements-editor-scripts',
            plugins_url( '../dist/app.js', __FILE__ ),
            [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
            filemtime( plugin_dir_path( __FILE__ ) . '../dist/app.js' )
        );

        // Enqueue block editor styles
        wp_enqueue_style(
            'my-block-editor-css',
            plugins_url( '../dist/app.css', __FILE__ ),
            [ 'wp-edit-blocks' ],
            filemtime( plugin_dir_path( __FILE__ ) . '../dist/app.css' )
        );

    }

// Hook the enqueue functions into the editor
//    add_action( 'enqueue_block_editor_assets', 'witcom_rb_elements_block_plugin_editor_scripts' );


