import { Component } from '@wordpress/element';
const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, InnerBlocks } = wp.blockEditor;
const { ToggleControl, PanelBody, PanelRow, CheckboxControl, SelectControl, ColorPicker } = wp.components;
const { withInstanceId } = wp.compose;

// import { registerBlockType } from '@wordpress/blocks';
import Welcome from '../../js-components/sample-js-component.js';


const BLOCKS_TEMPLATE = [
  [ 'core/columns', { columns: 2 , className: 'witcom-split-content' }, [
    [ 'core/column', {width: 80, className: 'content-column'}, [
      [ 'core/heading', { placeholder: 'Enter heading...', level: '2', className: 'header'} ],
      [ 'core/paragraph', { placeholder: 'Enter content... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            className: 'content'} ],
        [ 'core/button', { placeholder: 'Enter Button Title'} ],

    ] ],
    [ 'core/column', {width: 20, className: 'image-column'}, [
      [ 'core/image', { url: 'https://via.placeholder.com/150', className: 'image'} ],

    ] ],



  ]
  ]
];

// inner HTML Example...
function createMarkup() {
  return {
    __html: "<h1>This is example for dangerouslySetInnerHTML attribute.</h1>"
  };
}

registerBlockType( 'witcom/split-content', {
  title: 'Split Content',
  icon: {
    // Specifying a background color to appear with the icon e.g.: in the inserter.
    background: '#0e8f94',
    // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
    foreground: '#ffffff',
    // Specifying an icon for the block
    src: 'welcome-widgets-menus',
  } ,
  category: 'wit-blocks',
  keywords: ['template', 'wit'],
  supports: { },
  attributes: {
    id: {
      type: 'string'
    },
    className: {
      type: 'string',
      default: 'bacon'
    },
    myRichHeading: {
      type: 'string',
    },
    myRichText: {
      type: 'string',
      source: 'html',
      selector: 'p'
    },
    toggle: {
      type: 'boolean',
      default: true
    },
    favoriteAnimal: {
      type: 'string',
      default: 'dogs'
    },
    favoriteColor: {
      type: 'string',
      default: '#DDDDDD'
    },
    activateLasers: {
      type: 'boolean',
      default: false
    },
    tempcss: {
      type: 'string',
      default: false
    }
  },
  edit: ( props ) => {
    const { attributes, setAttributes } = props
    return (
      <div>
        <InspectorControls>
          <PanelBody
            title="Most awesome settings ever"
            initialOpen={true}
          >
            <PanelRow>
              <ToggleControl
                label="Toggle me"
                checked={attributes.toggle}
                onChange={(newval) => setAttributes({ toggle: newval })}
              />
            </PanelRow>
            <PanelRow>
              <SelectControl
                label="What's your favorite animal?"
                value={attributes.favoriteAnimal}
                options={[
                  {label: "Dogs", value: 'dogs'},
                  {label: "Cats", value: 'cats'},
                  {label: "Something else", value: 'weird_one'},
                ]}
                onChange={(newval) => setAttributes({ favoriteAnimal: newval })}
              />
            </PanelRow>
            <PanelRow>
              <ColorPicker
                color={attributes.favoriteColor}
                onChangeComplete={(newval) => setAttributes({ favoriteColor: newval.hex })}
                disableAlpha
              />
            </PanelRow>
            <PanelRow>
              <CheckboxControl
                label="Activate lasers?"
                checked={attributes.activateLasers}
                onChange={(newval) => setAttributes({ activateLasers: newval })}
              />
            </PanelRow>
          </PanelBody>
        </InspectorControls>

        <RichText
          tagName="id"
          placeholder="Assign an ID to the block here"
          value={attributes.favoriteAnimal}
          onChange={(newtext) => setAttributes({ myRichHeading: newtext })}
        />

        <RichText
          tagName="h2"
          placeholder="Write your heading here"
          value={attributes.favoriteAnimal}
          onChange={(newtext) => setAttributes({ myRichHeading: newtext })}
        />
        <RichText
          tagName="p"
          placeholder="Write your paragraph here"
          value={attributes.myRichText}
          onChange={(newtext) => setAttributes({ myRichText: newtext })}
        />

      <div className={ attributes.className }>
        <InnerBlocks
          template={ BLOCKS_TEMPLATE }
          templateLock="all"
        />
      </div>
      </div>
    );
  },
  save: ( props ) => {
    const { attributes } = props;
    const bacon = attributes.favoriteAnimal;
    return (
      <div>
        <RichText.Content
          tagName="h2"
          value={attributes.favoriteAnimal}
        />
        <RichText.Content
          tagName="p"
          value={attributes.myRichText}
        />
      <div className={ attributes.className }>
        <InnerBlocks.Content />
      </div>

        <div dangerouslySetInnerHTML={bacon} />;

      </div>

    );
  },
} );
