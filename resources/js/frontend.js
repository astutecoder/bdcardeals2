import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'
import {BrowserRouter, Route, Switch, Redirect} from 'react-router-dom'

import store from './react/frontend/store/store'
import Header from './react/frontend/components/Header/Header';
import BCDHome from './react/frontend/components/BCDHome/BCDHome';
import Cars from './react/frontend/components/Cars/Cars';
import ProcessSearch from './react/frontend/components/ProcessSearch/ProcessSearch';
import CarDetails from './react/frontend/components/CarDetails/CarDetails';

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
                    headerContainer.style.boxShadow = '2px 5px 5px rgba(0,0,0,0.25)';
                } else {
                    headerContainer.style.position = 'absolute';
                    headerContainer.style.backgroundColor = 'rgba(255,255,255,.75)';
                    headerContainer.style.boxShadow = 'none';
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
                                <Route path='/cars' exact component={Cars}/>
                                <Route path='/process-search' exact component={ProcessSearch}/>
                                {/* <Route path='/cars/:car/:id' component={CarDetails}/> */}
                                <Route path='/cars/:car/:id' render={(props)=>(
                                    <CarDetails key={props.match.params.id} {...props} />
                                )}/>
                                <Redirect to='/' />
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
