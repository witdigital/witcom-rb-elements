import assign from 'lodash.assign';

const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

// Enable column control on the following blocks
const enableColumnControlOnBlocks = [
  "core/list"
];

// Available column control options
const columnControlOptions = [
  {
    label: __( '1' ),
    value: '1',
  },
  {
    label: __( '2' ),
    value: '2',
  },
  {
    label: __( '3' ),
    value: '3',
  },
  {
    label: __( '4' ),
    value: '4',
  },
];

/**
 * Add column control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addColumnControlAttribute = ( settings, name ) => {
  // Do nothing if it's another block than our defined ones.
  if ( ! enableColumnControlOnBlocks.includes( name ) ) {
    return settings;
  }

  // Use Lodash's assign to gracefully handle if attributes are undefined
  settings.attributes = assign( settings.attributes, {
    column: {
      type: 'string',
      default: columnControlOptions[ 0 ].value,
    },
    mobileColumn: {
      type: 'string',
      default: columnControlOptions[ 0 ].value,
    },
  } );

  return settings;
};

addFilter( 'blocks.registerBlockType', 'extend-block-example/attribute/column', addColumnControlAttribute );

/**
 * Create HOC to add column control to inspector controls of block.
 */
const withColumnControl = createHigherOrderComponent( ( BlockEdit ) => {
  return ( props ) => {
    // Do nothing if it's another block than our defined ones.
    if ( ! enableColumnControlOnBlocks.includes( props.name ) ) {
      return (
        <BlockEdit { ...props } />
      );
    }

    const { column, mobileColumn } = props.attributes;

    // add has-column-xy class to block
    if ( column ) {
      props.attributes.className = `has-cols-${ column }`;
    }

    if ( mobileColumn ) {
      props.attributes.className = props.attributes.className+` has-cols-mobile-${ mobileColumn }` ;
    }

    return (
      <Fragment>
        <BlockEdit { ...props } />
        <InspectorControls>
          <PanelBody
            title={ __( 'My Column Control' ) }
            initialOpen={ true }
          >
            <SelectControl
              label={ __( 'Column' ) }
              value={ column }
              options={ columnControlOptions }
              onChange={ ( selectedColumnOption ) => {
                props.setAttributes( {
                  column: selectedColumnOption,
                } );
              } }
            />
            <SelectControl
              label={ __( 'Mobile Column' ) }
              value={ mobileColumn }
              options={ columnControlOptions }
              onChange={ ( selectedColumnOption ) => {
                props.setAttributes( {
                  mobileColumn: selectedColumnOption,
                } );
              } }
            />
          </PanelBody>
        </InspectorControls>
      </Fragment>
    );
  };
}, 'withColumnControl' );

addFilter( 'editor.BlockEdit', 'extend-block-example/with-column-control', withColumnControl );

/**
 * Add margin style attribute to save element of block.
 *
 * @param {object} saveElementProps Props of save element.
 * @param {Object} blockType Block type information.
 * @param {Object} attributes Attributes of block.
 *
 * @returns {object} Modified props of save element.
 */
const addColumnExtraProps = ( saveElementProps, blockType, attributes ) => {
  // Do nothing if it's another block than our defined ones.
  if ( ! enableColumnControlOnBlocks.includes( blockType.name ) ) {
    return saveElementProps;
  }

  const margins = {
    1: '1',
    2: '2',
    3: '3',
    4: '4',
  };

  if ( attributes.column in margins ) {
    // Use Lodash's assign to gracefully handle if attributes are undefined
    assign( saveElementProps, { style: { 'column-count': margins[ attributes.column ] } } );
  }

  return saveElementProps;
};

addFilter( 'blocks.getSaveContent.extraProps', 'extend-block-example/get-save-content/extra-props', addColumnExtraProps );
