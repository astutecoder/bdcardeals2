import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'

import store from './react/frontend/store/store'

import bootstrap from './bootstrap'
import $ from 'jquery';
window.jQuery = $;
window.$ = $;
global.jQuery = $;

import FrontEndRoutes from './react/frontend/frontend.routes';

export default class FrontEnd extends Component {
    componentDidMount(){
        $(document).ready(function () {
            function preload(){
                $(".preloader").animate({ opacity: 1 });
                var everythingLoaded = setInterval(function() {
                    if (/loaded|complete/.test(document.readyState)) {
                        clearInterval(everythingLoaded);

                        $(".preloader").animate({ opacity: 0, zIndex: -1 });
                    }
                }, 10);
            }
            preload();
        })
    }

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
