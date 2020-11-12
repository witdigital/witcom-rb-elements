/* ==========================================================================
    * Filename: webpack.mix.js
    * Description: Laravel Mix Configuration
    * Reference: https://laravel-mix.com/docs/5.0/basic-example , https://github.com/pixelcollective/laravel-mix-wp-blocks
    * Author: Ryan E. Mitchell

   [Table of contents]

   * Includes
   * Variables

    1. ACF Block Assets
    2. Plugin Assets
      * JS and CSS
    3. Mix options and Webpack config
    *
    * todo setup postcss and looking other options
    *  https://laravel-mix.com/extensions/postcss-config
    ========================================================================== */

/* ===  Includes  ==== */
require('laravel-mix-purgecss');
require('laravel-mix-copy-watched');
require("@tinypixelco/laravel-mix-wp-blocks");

/* ===  Variables  ==== */
let mix = require('laravel-mix');

mix.webpackConfig({
  externals: {
    'react': 'React',
    'react-dom': 'ReactDOM'
  }
});

/* ==========================================================================
    ACF Block Assets
    Used for blocks that do not use variables from PHP in styles or scripts.
    From blockName/assets write to blockName/dist.
    include in your block by enqueue_assets in blocks index.php
   ========================================================================== */
/*
mix.sass('app/acf-blocks/[blockName]/assets/styles/block-styles.scss', 'app/acf-blocks/[blockName]/dist/')
  .options({
    processCssUrls: false,
    postCss: [  ],
  });

mix.js('app/acf-blocks/[blockName]/assets/scripts/block-scripts.js', 'app/acf-blocks/[blockName]/dist/');

 */

/* ==========================================================================
    Plugin Assets
   ========================================================================== */

// mix.js('src/assets/scripts/app.js', 'dist/');
// Use Block when using JS blocks
mix.block('src/assets/scripts/app.js', 'dist/');
// todo See why mix.block writes undefined.asset.php and undefined.js

mix.sass('src/assets/styles/app.scss', 'dist/')
  .options({
    processCssUrls: false,
    postCss: [  ],
  });

/* ==========================================================================
    Mix options and Webpack config
   ========================================================================== */

mix.options({
  purifyCss: false,
});


mix.setPublicPath('dist');


