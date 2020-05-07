<?php
/* ==========================================================================
    * Filename: witcom-app.php
    * Description:  Main application for this plugin
    * Author:  Ryan E. Mitchell

    [Table of contents]

    1. Include Custom Post Types
    2. Include ACF Field Groups
    3. Include ACF Options Pages
    4. Include Shortcodes
    5. Include Widgets
    6. Include ACF Blocks
    7. Include Block Templates
========================================================================== */

/* ==========================================================================
    Include Custom Post Types
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "post-types/*.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include ACF Field Groups
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "acf-field-groups/*.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include ACF Options Pages
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "acf-options-pages/*.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include Shortcodes
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "shortcodes/*.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include Widgets
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "widgets/*.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include ACF Blocks
   ========================================================================== */
foreach (glob(plugin_dir_path(__FILE__) . "acf-blocks/**/index.php") as $file) {
    include_once $file;
}

/* ==========================================================================
    Include Block Templates
   ========================================================================== */

foreach (glob(plugin_dir_path(__FILE__) . "block-templates/**/index.php") as $file) {
    include_once $file;
}
