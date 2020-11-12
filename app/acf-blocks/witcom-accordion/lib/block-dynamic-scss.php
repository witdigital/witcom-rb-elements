<?php
    /* ==========================================================================
        * Filename: block-dynamic-styles-scss.php
        * Description: SCSS with variables from custom fields
        * Reference:
        * Author:  Ryan E. Mitchell
        * todo documentation for block-dynamic-styles-scss
     ========================================================================== */

    /**
     *  Return dynamic SCSS
     *
     *  @return block_dynamic_scss
     */
    function blockDynamicSCSS() {
        /* ===  Define Vars  ==== */
        if ( have_rows( 'witcom_breakpoints', 'option' ) ):
            while ( have_rows( 'witcom_breakpoints', 'option' ) ): the_row();

            // Get sub field values.
                $witcom_breakpoint_xs = get_sub_field( 'witcom_breakpoint_xs' );
                $witcom_breakpoint_sm = get_sub_field( 'witcom_breakpoint_sm' );
                $witcom_breakpoint_md = get_sub_field( 'witcom_breakpoint_md' );
                $witcom_breakpoint_lg = get_sub_field( 'witcom_breakpoint_lg' );
                $witcom_breakpoint_xl = get_sub_field( 'witcom_breakpoint_xl' );

            endwhile;
        endif;

        /* ===  Create SCSS  ==== */
        $block_dynamic_scss = /** @lang SCSS */
            "

.witcom-block {

background-color: red;

 @media only screen and (max-width:${witcom_breakpoint_md}px) {
  background-color: blue;
  }

} // end .witcom-block

";

        return $block_dynamic_scss;
    }
