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
            $service_description = get_sub_field('service_description');
            $service_page_link = get_sub_field('service_page_link');

            ?>


            <a href="<?php echo $service_page_link ?> "class="witcom_services_boxes_services-item service">



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



