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





    /* ==========================================================================
        Define Variables
       ========================================================================== */

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

   ?>

        <div class="<?php echo esc_attr( $className ); ?> wit-readmore"  style="margin: 2em 0;">

            <div class="inner-wrapper">

                <div class="default-content"> <!-- Start of .default-content -->
                    <?php if( get_field('witcom_read_more_default_content') ): ?>
                    	<?php the_field('witcom_read_more_default_content'); ?>
                    <?php endif; ?>
                    <span class="wit-read-more" style="font-weight:bold;">Read More ></span>
                </div> <!-- End of .default-content -->
                <div class="more-content" style="display: none; margin-top: 1em;"> <!-- Start of .more-content -->
                    <?php if( get_field('witcom_read_more_more_content') ): ?>
                        <?php the_field('witcom_read_more_more_content'); ?>
                    <?php endif; ?>
                </div> <!-- End of .more-content -->


            </div >

        </div>

<?php
   /* ==========================================================================
      Block Specific JS
      ========================================================================== */
?>

                <script>
                    jQuery(document).ready(function ($) {

                        $.fn.toggleText = function(t1, t2){
                            if (this.text() == t1) this.text(t2);
                            else                   this.text(t1);
                            return this;
                        };


                        $( ".wit-read-more" ).click(function() {
                            $(this).toggleText('Read More >', 'Read Less v');
                            $( ".more-content" ).slideToggle( "slow" );
                        });




                    });
                </script>

