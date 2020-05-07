<?php
    /*
    Plugin Name: WitCom Plugin Starter
    Plugin URI: https://witdelivers.com
    Description: Starter plugin for use with witdigital/wit-commander-plugin
    Version: 0.0.1
    Author: Wit Digital
    Author URI: https://witdelivers.come
    Text Domain: witcom
    */

/* ==========================================================================
    [Table of contents]

    1. Load dependencies
    2. Load up plugin app files
    3. Plugin update checker
    4. Check that Wit Commander is Active
    5. Helper Functions
   ========================================================================== */

    // If this file is called directly, die. //
    if (! defined('WPINC')) {
        die;
    }

/* ==========================================================================
    Load dependencies
========================================================================== */

//  Composer Autoload
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once( __DIR__ . '/vendor/autoload.php' );
    }

/* ==========================================================================
   Load up plugin app files
   ========================================================================== */
    array_map(function ($file) use ($witcom_error) {

        if (file_exists(plugin_dir_path(__FILE__) . 'app/' . $file . '.php')) {
            require_once(plugin_dir_path(__FILE__) . 'app/' . $file . '.php');
        } else {
            $witcom_error(
                __($file . '.php not found', 'witsage'),
                __('Resource not found.', 'witsage')
            );
        }
    }, [ 'witcom-setup', 'witcom-app' ]);

/*  ==========================================================================
    Plugin update checker
    Reference: https://github.com/YahnisElsts/plugin-update-checker
    ========================================================================== */

    $witcomUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/ryanemitchell/wit-commander-test/',
        __FILE__, //Full path to the main plugin file or functions.php.
        'witcom-starter'
    );

    $witcomUpdateChecker->setBranch('master');
    $witcomUpdateChecker->setAuthentication('f6c9d5d85636f2c030a9896d5a38e946da31818f');

/* ==========================================================================
   Check that Wit Commander is Active
   ========================================================================== */
    /**
     *  Display admin notice that Wit Commander is required with Plugin Name
     */
    function witcom_starter_self_deactivate_notice()
    {
        global $wp_version;
        $plugin = plugin_basename( __FILE__ );
        $plugin_data = get_plugin_data( __FILE__, false );
        $plugin_name = $plugin_data['Name'];
        ?>
        <div class="notice notice-error">
            The <?php echo $plugin_name ?> plugin requires the Wit Commander plugin to be installed and active. It have been deactivated.<br>
            Please activate Wit Commander and try to activate <?php echo $plugin_name ?> again.
            <br />Back to the WordPress <a href='/wp-admin/plugins.php?plugin_status=all'>Plugins page</a>.
        </div>
        <?php
    }

    /**
     *  Check if Wit Commander Plugin is active
     *  if Not deactivate and show notice in admin
     *
     *  @see self_deactivate_notice
     */

    function witcom_starter_require_wit_commander() {
        $plugin = plugin_basename( __FILE__ );

        if (!class_exists('WitCommander')) {
            if( is_plugin_active($plugin) ) {
                add_action('admin_notices', 'witcom_starter_self_deactivate_notice');
                deactivate_plugins( $plugin );
            }
        }
    }

    add_action('admin_init', 'witcom_starter_require_wit_commander');



    /* ==========================================================================
       Helper Functions
       ========================================================================== */

    /**
     * Helper function for prettying up errors
     *
     * @param string $message
     * @param string $subtitle
     * @param string $title
     */

    $witcom_error = function ($message, $subtitle = '', $title = '') {
        $title   = $title ?: __('WitCom &rsaquo; Error', 'witcom');
        $footer  = '';
        $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
        wp_die($message, $title);
    };
