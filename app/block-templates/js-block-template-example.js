import { Component } from '@wordpress/element';
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.blockEditor;


// import { registerBlockType } from '@wordpress/blocks';
// import Welcome from '../js-components/sample-js-component.js';



const BLOCKS_TEMPLATE = [
  [ 'core/image', {} ],
  [ 'core/paragraph', { placeholder: 'Image Details' } ],
  [ 'core/shortcode', {text: '[show_bacon]'} ],
];

var name = "freddy";


registerBlockType( 'myplugin/template', {
  title: 'My Template Block',
  category: 'wit-blocks',
  edit: ( { className } ) => {
    return (
      <div className={ className }>
        <InnerBlocks
          template={ BLOCKS_TEMPLATE }
          templateLock="all"
        />
        <Welcome name={name}/>
      </div>
    );
  },
  save: ( { className } ) => {
    return (
      <div className={ className }>
        <InnerBlocks.Content />
      </div>

    );
  },
} );
