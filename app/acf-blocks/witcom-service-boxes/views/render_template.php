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


/* === Additional SCSS ==== */

        if ( get_field( 'witcom_services_boxes_additional_scss' ) ) {
            $witcom_services_boxes_additional_scss = get_field( 'witcom_services_boxes_additional_scss' );
        } else {
            $witcom_services_boxes_additional_scss = '';
        }

        /* ==========================================================================
           Create Block Dynamic SCSS
                **** There is no prefixing, limit use of cutting edge properties.
                **** Reference https://caniuse.com/ when necessary.
           ========================================================================== */

        $witcom_services_boxes_grid_scss = /** @lang SCSS */
            "

            .$blockID {
            
            
                   .services-wrapper {
                      align-content: center;
          
                   @media only screen and (min-width: ${witcom_breakpoint_md}px){
                             display: flex;
                            flex-wrap: wrap;
                             grid-gap: 30px;
                            justify-content: center;  text-align: center;
                            justify-items: center;
                       }
                  
                   .service {
                       display: flex;
                       flex-direction: column;  
                       width: 100vw;
                       position: relative;
                       left: calc(-50vw + 50%);
                       background: var(--color-grey);
                       box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
                       padding: 32px;
                       text-decoration: none;
                       margin-bottom: 32px;
                       
                        @media only screen and (min-width: ${witcom_breakpoint_md}px){
                            width: calc(33% - 16px);
                            margin-bottom: 0;
                            left: auto;
                         }
                         
                         &:hover,
                         &:active {
                         
                         background: var(--color-secondary);
                         transition: background-color .2s ease-in-out;
                         
                         .service-header {
                         
                          img,
                          .service-name {
                            filter: brightness(100);
                            transition-property: -moz-filter, -ms-filter, -o-filter, -webkit-filter, filter;
                            transition-duration: .1s;
                            transition-timing-function: ease-in-out;
                          }
                         }
                         .content {
                            filter: brightness(100);
                            transition-property: -moz-filter, -ms-filter, -o-filter, -webkit-filter, filter;
                            transition-duration: .1s;
                            transition-timing-function: ease-in-out;
                         }
                         }
                       
                       
                       .service-header {
                           width: 100%;
                           display: flex;
                           justify-content: center;
                           align-items: center;
                            
                            img {
                               filter: brightness(1);
                               height: 39px;
                               width: 53px;
                               margin-right: 16px;
                                
                               @media only screen and (min-width: ${witcom_breakpoint_md}px){
                                  height: 62px;
                                  width: 69px;
                               }
                     
                             }
                            
                         
                       
                           .service-name {
                              filter: brightness(1);
                              font-size: 36px;
                              font-weight: bold;
                              color: rgba(29, 31, 79, 1);
                              line-height: 80px;
                            
                              @media only screen and (min-width: ${witcom_breakpoint_md}px){
                                font-size: 42px;
                              }
                         
                           }
                       }
                       
                       .content {
                          filter: brightness(1);
                          text-align: center;
                       }
                   }
                       
                   } /* End of .services-wrapper */
          
                /* Bring in additional SCSS from this instance */
               $witcom_services_boxes_additional_scss

            } /* End of .$blockID */

       ";  // end scss


        /* ==========================================================================
           Compile SCSS
           ========================================================================== */

        $scss = new Compiler();

        // Option to Crunch SCSS
        if ( get_field( 'crunch_witcom_scss', 'option' ) ):
            $scss->setFormatter( 'ScssPhp\ScssPhp\Formatter\Crunched' );
        else:
            $scss->setFormatter( 'ScssPhp\ScssPhp\Formatter\Expanded' );
        endif;


        $compiledCssCode = $scss->compile( $witcom_services_boxes_grid_scss );

        echo( "<style id='witcom-services-boxes-$blockID'>\r\n" );
        echo $compiledCssCode;
        echo( '</style>' );


        /* ==========================================================================
           Render the Frontend
           ========================================================================== */
        ?>

        <div class="<?php echo esc_attr( $className ); ?>">

            <div class="inner-wrapper">

                <div class="services">

<?php if( have_rows('witcom_services_boxes_services') ): ?>

	<div class="witcom_services_boxes_services-wrapper services-wrapper">

	<?php while( have_rows('witcom_services_boxes_services') ): the_row();

		// vars
		$service_name = get_sub_field('service_name');
        $service_icon = get_sub_field('service_icon');
        $service_description = get_sub_field('service_description');
        $service_page_link = get_sub_field('service_page_link');

        ?>


		<a href="<?php echo $service_page_link ?> "class="witcom_services_boxes_services-item service">

            <?php if( ($witcom_services_boxes_show_icon = true)|| ($witcom_services_boxes_show_service_name = true)): ?>
                <div class="service-header">

                    <?php if($witcom_services_boxes_show_icon = true): ?>

                        <?php if( $service_icon ): ?>
                            <div class="service-image">
                                <img src="<?php echo $service_icon['url']; ?>" />
                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if($witcom_services_boxes_show_service_name = true): ?>

                        <?php if( $service_name ): ?>
                            <div class="service-name"><?php echo $service_name; ?></div>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($witcom_services_boxes_show_description = true): ?>
                <div class="content">

                    <?php if( $service_description ): ?>
                        <?php echo $service_description; ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
		</a>

	<?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
    <?php
    endif;

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
