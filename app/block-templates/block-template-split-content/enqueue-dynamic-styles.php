<?php

    /**
     * Filename: enqueue-dynamic-styles.php
     * Description:
     * Author:  Ryan E. Mitchell
     */

    use ScssPhp\ScssPhp\Compiler;

    function get_witcom_split_content_scss(){
        //buffer php scss file
        ob_start();
        include 'block-styles-scss.php';
        $witcom_split_content_css = ob_get_clean();

        return $witcom_split_content_css;
    }

    add_action('wp_footer','witcom_split_content_dynamic_styles',100);
    add_action('admin_footer','witcom_split_content_dynamic_styles',100);

    function witcom_split_content_dynamic_styles() {

        // Only proceed if the post has is using this block
        global $post;
        if ( has_blocks( $post->post_content ) ) {
            $blocks = parse_blocks( $post->post_content );

//            var_dump($blocks);

            if ( $blocks[0]['blockName'] === 'witcom/split-content' ) {

                $witcom_split_content_scss = get_witcom_split_content_scss();
                $scss_split_content = new Compiler();

                // Option to Crunch SCSS
                if( get_field('crunch_witcom_scss','option') ):
                    $scss_split_content->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
                else:
                    $scss_split_content->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
                endif;

                echo ("<style id='witcom_split_content_styles'>");
                echo $scss_split_content->compile( $witcom_split_content_scss);
                echo ('</style>');
            }
        }

    }
