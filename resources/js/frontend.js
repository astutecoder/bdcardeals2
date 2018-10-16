import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'

import store from './react/frontend/store/store'

import bootstrap from './bootstrap'
import FrontEndRoutes from './react/frontend/frontend.routes';

export default class FrontEnd extends Component {

    render() {
        return (
            <Provider store={store}>
                <FrontEndRoutes/>
            </Provider>
        )
    }
}

ReactDOM.render(
    <FrontEnd/>, document.getElementById('bcd-app'));
