import { Component } from '@wordpress/element';
import ApolloClient from 'apollo-boost';
import { ApolloProvider } from '@apollo/react-hooks';

var full = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
// window.alert(full);

const client = new ApolloClient({
  uri: full+'/graphql',
});

import { gql } from "apollo-boost";

client
  .query({
    query: gql`
      {
forDevelopers {
    developerFields {
      witcomBreakpoints {
        fieldGroupName
        witcomBreakpointLg
        witcomBreakpointMd
        witcomBreakpointSm
        witcomBreakpointXl
        witcomBreakpointXs
      }
    }
  }
}
    `
  })
  .then(result => console.log(result));

const App = () => (
  <ApolloProvider client={client}>
    <div>
      <h2>My first Apollo app 🚀</h2>
    </div>
  </ApolloProvider>
);

class Welcome extends Component {
  render() {
    return (<h1>Hello, {this.props.name}</h1>);
  }
}
export default Welcome;
