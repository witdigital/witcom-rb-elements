<?php

    /* ==========================================================================
        * Filename: hooks.php
        * Description: Define hooks for this block
        * Reference: https://developer.wordpress.org/plugins/hooks/custom-hooks/
        * Author:  Ryan E. Mitchell
        ========================================================================== */

    function witcom_acf_glide_slider_before_grid() {
        do_action( 'witcom_acf_glide_slider_before_grid' );
    }

    function witcom_acf_glide_slider_after_grid() {
        do_action( 'witcom_acf_glide_slider_after_grid' );
    }

    function witcom_acf_glide_slider_before_coupon() {
        do_action( 'witcom_acf_glide_slider_before_coupon' );
    }

    function witcom_acf_glide_slider_inside_coupon() {
        do_action( 'witcom_acf_glide_slider_inside_coupon' );
    }

    function witcom_acf_glide_slider_after_coupon() {
        do_action( 'witcom_acf_glide_slider_after_coupon' );
    }
