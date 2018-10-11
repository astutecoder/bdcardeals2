import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'
import {BrowserRouter, Route, Switch} from 'react-router-dom'

import store from './react/frontend/store/store'
import Header from './react/frontend/components/Header/Header';
import BCDHome from './react/frontend/components/BCDHome/BCDHome';
import Cars from './react/frontend/components/Cars/Cars';
import ProcessSearch from './react/frontend/components/ProcessSearch/ProcessSearch';

import bootstrap from './bootstrap'

export default class FrontEnd extends Component {
    componentDidMount() {
        const headerContainer = document.querySelector('header');
        setTimeout(() => {
            const headerHeight = headerContainer.offsetHeight;

            window.addEventListener('scroll', () => {
                let scrollY = window.scrollY;
                if (scrollY > headerHeight) {
                    headerContainer.style.position = 'sticky';
                    headerContainer.style.backgroundColor = 'white';
                } else {
                    headerContainer.style.position = 'absolute';
                    headerContainer.style.backgroundColor = 'rgba(255,255,255,.75)';
                }
            })
        }, 0);
    }
    render() {
        return (
            <Provider store={store}>
                <div>
                    <BrowserRouter>
                        <div>
                            <Header/>
                            <Switch>
                                <Route path='/' exact component={BCDHome}/>
                                <Route path='/cars' component={Cars}/>
                                <Route path='/process-search' component={ProcessSearch}/>
                            </Switch>
                        </div>
                    </BrowserRouter>
                </div>
            </Provider>
        )
    }
}

ReactDOM.render(
    <FrontEnd/>, document.getElementById('bcd-app'));
