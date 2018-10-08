import { createStore, applyMiddleware, combineReducers } from 'redux';
import {carReducers} from '../reducers/car.reducers'
import {sliderReducers} from '../reducers/slider.reducers'
import thunk from 'redux-thunk';

const initialState = {
}
const middleware = [thunk]

const rootReducers = combineReducers({cars: carReducers, sliders: sliderReducers});

export default createStore(rootReducers, initialState, applyMiddleware(...middleware));