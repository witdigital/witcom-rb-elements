<?php

    /* ==========================================================================
        * Filename: render_template.php
        * Description: Front end for WitCom Service Box Block
        * Author:  Ryan E. Mitchell

       [Table of contents]

        1. Includes and Dependencies
        2. Define Variables
            Get Wit Commander fields and set vars
        3. Get Posts (if a content is from a post type)
        4. Set instance specific vars
        5. Create Block Dynamic SCSS
        6. Compile SCSS
        7. Render the Frontend
        8. Block Specific JS
        ========================================================================== */


    /* ===========================  Includes and Dependencies  ========================== */

    use ScssPhp\ScssPhp\Compiler;


    /* ==========================================================================
        Define Variables
       ========================================================================== */

// Get block id and name into vars
    if( !empty($block) ) {
        //    This instances ID
        $blockID   = $block['id'];
        $blockName = $block['name'];
        // replace forward slash in block name for better compatibility
        $blockName = str_replace('/', '_', $blockName);
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'witcom-block ' . $blockName . ' ' . $blockID;
    if ( ! empty( $block['className'] ) ) {
        $className .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $className .= ' align' . $block['align'];
    }

    /* ===  Get Wit Commander fields and set vars   ==== */

//        Breakpoints
//        todo convert to plugin level class
    if ( have_rows( 'witcom_breakpoints', 'option' ) ):
        while ( have_rows( 'witcom_breakpoints', 'option' ) ): the_row();

            $witcom_breakpoint_xs = get_sub_field( 'witcom_breakpoint_xs' );
            $witcom_breakpoint_sm = get_sub_field( 'witcom_breakpoint_sm' );
            $witcom_breakpoint_md = get_sub_field( 'witcom_breakpoint_md' );
            $witcom_breakpoint_lg = get_sub_field( 'witcom_breakpoint_lg' );
            $witcom_breakpoint_xl = get_sub_field( 'witcom_breakpoint_xl' );

        endwhile;
    endif;



/* =========================== Set instance specific variables ========================== */

//todo write helper to access ACF fields outside the block loop.
if ( get_field( 'witcom_services_boxes_show_icon' ) ) {
    $witcom_services_boxes_show_icon = true;
} else {
    $witcom_services_boxes_show_icon = false;
}

if ( get_field( 'witcom_services_boxes_show_service_name' ) ) {
    $witcom_services_boxes_show_service_name = true;
} else {
    $witcom_services_boxes_show_service_name = false;
}

if ( get_field( 'witcom_services_boxes_show_description' ) ) {
    $witcom_services_boxes_show_description = true;
} else {
    $witcom_services_boxes_show_description = false;
}


if ( get_field( 'witcom_services_boxes_layout' ) ) {
    $witcom_services_boxes_layout = get_field( 'witcom_services_boxes_layout' );
} else {
    $witcom_services_boxes_layout = 'asdasd';
}


/* === Additional SCSS ==== */

        if ( get_field( 'witcom_services_boxes_additional_scss' ) ) {
            $witcom_services_boxes_additional_scss = get_field( 'witcom_services_boxes_additional_scss' );
        } else {
            $witcom_services_boxes_additional_scss = '';
        }




        /* ==========================================================================
           Render the Frontend
           ========================================================================== */
        ?>

<?php
switch ($witcom_services_boxes_layout) {
    case "style_a":
        require 'layout_style_a.php';
        break;
    case "style_b":
        require 'layout_style_b.php';
        break;
    default:
        require 'layout_style_a.php';
}

 ?>


<?php

   /* ==========================================================================
      Block Specific JS -
     todo: set up starter script targeting the elements within the block by ID

      ========================================================================== */
?>
             <!--
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        window.alert('acf-block js is working')
                    });
                </script>
                -->
