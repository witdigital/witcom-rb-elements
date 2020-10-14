import  '@wordpress/components';
import  '@wordpress/block-library';
import { withState } from '@wordpress/compose';
//
// //Graph QL Stuff
//
import '@wordpress/element';
// import ApolloClient from 'apollo-boost';
// import { ApolloProvider } from '@apollo/react-hooks';
//
// var full = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
// window.alert(full);
//
// const client = new ApolloClient({
//   uri: full+'/graphql',
// });
//
// import { gql } from "apollo-boost";
//
// client
//   .query({
//     query: gql`
//       {
// designOptions {
//     witcom_design_options {
//       witcomButtons {
//         fieldGroupName
//         witcomButtonDefaultBackgroundColor
//         witcomButtonHoverBackgroundColor
//         witcomButtonName
//       }
//     }
//   }
// }
//     `
//   })
//   .then(result => window.alert(result));
//
//




//End Graph QL stuff

/* ==========================================================================
   Add custom attribute
   registerBlockType
   ========================================================================== */
wp.hooks.addFilter(
  'blocks.registerBlockType',
  'witCom/ButtonStyle',
  settings => {
    if(settings.name === 'core/button') {
      settings.attributes = {
        ...settings.attributes,
        witComButtonStyle: {
          type: 'string',
          default: 'default',
        },
      };
    }
    return settings;
  }
);

/* ==========================================================================
   Add inspector controls
   BlockEdit
   ========================================================================== */

wp.hooks.addFilter(
  'editor.BlockEdit',
  'witCom/ButtonStyle',
  wp.compose.createHigherOrderComponent(
    BlockEdit => props => {
      if(props.name === 'core/button') {
        // return (
        //   <wp.element.Fragment>
        //     <BlockEdit {...props} />
        //
        //       <wp.blockEditor.InspectorControls>
        //         {/*<wp.components.PanelBody title='Wit Com Styling'>*/}
        //         {/*  <wp.components.TextControl*/}
        //         {/*    label='Button Style'*/}
        //         {/*    value={props.attributes.witComButtonStyle}*/}
        //         {/*    onChange={nextRel => props.setAttributes({witComButtonStyle: nextRel})}*/}
        //         {/*  />*/}
        //         {/*</wp.components.PanelBody>*/}
        //       </wp.blockEditor.InspectorControls>
        //     )}
        //   </wp.element.Fragment>
        // );
      }
      return <BlockEdit {...props} />;
    },
    'withWitComButtonStyle'
  )
);



