/* ==========================================================================
    * Filename: app.js
    * Description: JavaScript for the plugin
    * Author:  Ryan E. Mitchell

    [Table of contents]

    1. Include Global Dependencies
    2. Import Blocks and Block Templates
    3. Global JS
    ========================================================================== */

/* ==========================================================================
    Include Global Dependencies
   ========================================================================== */
/* import { export1 } from "module-name"; */
import '@wordpress/element';
import '@wordpress/blocks';
import '@wordpress/i18n'
import '@wordpress/components'
import '@wordpress/editor'
import 'jquery';

/* ==========================================================================
    Import Blocks and Block Templates
   ========================================================================== */
//Block Templates
/* import '../../../app/js-blocks/[block-name]/index.js]' */

// Block Templates
/* import '../../../app/block-templates/[block-templete-name]/index.js]' */

/* ==========================================================================
    Global JS
   ========================================================================== */
document.addEventListener("DOMContentLoaded", function() {
  window.alert('witcom-starter plugin JS loaded')
});


