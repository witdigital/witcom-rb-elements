<?php

    /** ==========================================================================
        * Filename: acf-fields.php
        * Description: Define ACF fields used for this block
        * Reference: https://www.advancedcustomfields.com/resources/register-fields-via-php/
        * Author:  Ryan E. Mitchell
    ========================================================================== **/
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5f6df76a2fd12',
        'title' => 'Witcom Block - Read More',
        'fields' => array(
            array(
                'key' => 'field_5f6df77645ee9',
                'label' => 'Default content',
                'name' => 'witcom_read_more_default_content',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
                'show_column' => 0,
                'show_column_weight' => 1000,
                'allow_quickedit' => 0,
                'allow_bulkedit' => 0,
            ),
            array(
                'key' => 'field_5f6df7a9fc97d',
                'label' => 'Read More content',
                'name' => 'witcom_read_more_more_content',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => 'wpautop',
                'show_column' => 0,
                'show_column_weight' => 1000,
                'allow_quickedit' => 0,
                'allow_bulkedit' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/witcom-read-more-block',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'modified' => 1601073838,
    ));

endif;
