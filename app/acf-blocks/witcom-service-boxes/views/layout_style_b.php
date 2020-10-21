<?php

/**
 * Filename: layout_style_a.php
 * Description:
 * Author:  Ryan E. Mitchell
 */

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
            $service_icon_url =  $service_icon['url'];
            $service_icon_id =  $service_icon['id'];
            $service_icon_alt =  $service_icon['alt'];
            $service_icon_path = get_attached_file( $service_icon_id );
            $service_description = get_sub_field('service_description');
            $service_page_link = get_sub_field('service_page_link');


            echo file_get_contents($service_icon);
            include $service_icon_url;
            ?>


            <a href="<?php echo $service_page_link ?> "class="witcom_services_boxes_services-item service">

                        <?php if($witcom_services_boxes_show_icon = true): ?>

                            <?php if( $service_icon ): ?>
                                <div class="service-image">

                                    <!--Check if image is an SVG and if so, inline it. -->
                                    <?php if ( $service_icon['mime_type'] =="image/svg+xml") { ?>
                                       <div class="svg-wrapper">
                                            <?php echo file_get_contents( $service_icon_path ) ; ?>
                                            </div>
                                        <?php } else { ?>
                                            <img src="<?php echo $service_icon_url; ?>" alt="<?php echo $service_icon_alt ?>" />
                                   <?php }; ?>



                                </div>

                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if($witcom_services_boxes_show_service_name = true): ?>

                            <?php if( $service_name ): ?>
                                <div class="service-name"><?php echo $service_name; ?></div>
                            <?php endif; ?>

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



