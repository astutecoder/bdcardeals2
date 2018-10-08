import { createStore, applyMiddleware } from 'redux';
import {carReducers} from '../reducers/car.reducers'
import thunk from 'redux-thunk';

const initialState = {
    cars: {}
}
const middleware = [thunk]

export default createStore(carReducers, initialState, applyMiddleware(...middleware));