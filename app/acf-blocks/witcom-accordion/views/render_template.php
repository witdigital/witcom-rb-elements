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
    $className = $blockName .' witcom-block ' . $blockName . ' ' . $blockID;
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

    /* ===========================  Fonts  ========================== */

    if ( get_field( 'witcom_body_font', 'option' ) ) {
        $witcom_body_font = get_field( 'witcom_body_font', 'option' );
    } else {
        $witcom_body_font = 'Georgia, serif;';
    }

    if ( get_field( 'witcom_header_font', 'option' ) ) {
        $witcom_header_font = get_field( 'witcom_header_font', 'option' );
    } else {
        $witcom_header_font = 'Georgia, serif;';
    }


        /* =========================== Additional SCSS   ========================== */

        $witcom_button_radius = get_field( 'witcom_button_radius', 'option' );

        if ( get_field( 'witcom_accordion_additional_scss' ) ) {
            $witcom_accordion_additional_scss = get_field( 'witcom_accordion_additional_scss' );
        } else {
            $witcom_accordion_additional_scss = '';
        }


        /* ==========================================================================
           Create Block Dynamic SCSS
           ========================================================================== */

        $witcom_witcom_accordion_grid_scss = /** @lang SCSS */
            "

            .$blockID {
            
            .active {
                .toggle {
                 &:before {
                    display: none;
                  }
                }
           
            }
            
            .accordion-item {
                    border: 1px solid var(--color-dark-grey);
                    margin-bottom: 1em;
            
                    .header {
                    background: var(--color-secondary);
                    color: var(--color-white);
                    display: flex;
                    justify-content: space-between; 
                    align-items: center;
                    font-size: 36px;
                    padding: 8px 16px;
                    
                    .toggle {
                    
                      position: relative;
                      width: 32px;
                      height: 32px;
                      margin-right: 1em;
                                      
                       &:before,
                       &:after {
                  position: absolute;
      // z-index: -1;
        background: var(--color-white);
      content: '';
    }

    &:before {
      top: 15%;
      left: 62%;
      width: 10%;
      height: 70%;
      margin-left: -15%;
    }

    &:after {
      top: 60%;
      left: 15%;
      width: 70%;
      height: 10%;
      margin-top: -15%;
    }

    &:hover {
      &:before,
      &:after {
        background: var(--color-primary);
      }
    }
                    }
                    }
                    
                    .content {
                      background: var(--color-grey);
                      padding: 16px 32px;
                    }
            }


               $witcom_accordion_additional_scss

            } /* End of .$blockID */

       ";  // end $witcom_split_content_scss


        /* ==========================================================================
           Compile SCSS
            todo evaluate if autoprefixer is needed.

           ========================================================================== */

        $scss = new Compiler();

        // Option to Crunch SCSS
        if ( get_field( 'crunch_witcom_scss', 'option' ) ):
            $scss->setFormatter( 'ScssPhp\ScssPhp\Formatter\Crunched' );
        else:
            $scss->setFormatter( 'ScssPhp\ScssPhp\Formatter\Expanded' );
        endif;


        $compiledCssCode = $scss->compile( $witcom_witcom_accordion_grid_scss );

        echo( "<style id='witcom-accordian-$blockID'>\r\n" );
        echo $compiledCssCode;
        echo( '</style>' );


        /* ==========================================================================
           Render the Frontend
           ========================================================================== */
        ?>

        <div class="<?php echo esc_attr( $className ); ?>">

            <div class="inner-wrapper">

                    <?php if( have_rows('witcom_accordion_accordion_items') ): ?>
                        <div class="accordion-wrapper">


                            	<?php while( have_rows('witcom_accordion_accordion_items') ): the_row();

                            		// vars
                            		$name = get_sub_field('name');
                                    $content = get_sub_field('content');
                            		?>

                                    <div class="accordion-item">
                                        <div class="header">
                                            <span class="name">
                                                <?php if( $name ): echo $name; endif; ?>

                                            </span>
                                            <apan class="toggle">

                                            </apan>
                                        </div>


                                        <div class="content" style="display:none">

                                            <?php if( $content ): echo $content; endif; ?>

                                        </div>
                                    </div>

                            	<?php endwhile; ?>

                    </div>










                            <?php endif; ?>

            </div>
        </div>












    <?php


   /* ==========================================================================
      Block Specific JS
      ========================================================================== */
?>

                <script>
                    jQuery(document).ready(function ($) {
                        $( ".header" ).click(function() {
                            $(this).siblings('.content').slideToggle( "slow") ;
                            $(this).parent( ".accordion-item" ).toggleClass( "active" );
                        });
                    });
                </script>

