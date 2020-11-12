<?php

    /* ==========================================================================
        * Filename: hooks.php
        * Description: Define hooks for this block
        * Reference: https://developer.wordpress.org/plugins/hooks/custom-hooks/
        * Author:  Ryan E. Mitchell
        ========================================================================== */

    function witcom_services_boxes_grid_before_grid() {
        do_action( 'witcom_services_boxes_grid_before_grid' );
    }

    function witcom_services_boxes_grid_after_grid() {
        do_action( 'witcom_services_boxes_grid_after_grid' );
    }

    function witcom_services_boxes_grid_before_coupon() {
        do_action( 'witcom_services_boxes_grid_before_coupon' );
    }

    function witcom_services_boxes_grid_inside_coupon() {
        do_action( 'witcom_services_boxes_grid_inside_coupon' );
    }

    function witcom_services_boxes_grid_after_coupon() {
        do_action( 'witcom_services_boxes_grid_after_coupon' );
    }
