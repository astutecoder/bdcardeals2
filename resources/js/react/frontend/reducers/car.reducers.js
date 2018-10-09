import {GET_ALL_CARS, GET_FEATURED_CARS, GET_ALL_BRANDS} from '../actions/types'

const initialState = {
    cars: [],
    brands: [],
}

export const carReducers = (state = initialState, actions) => {
    switch (actions.type) {
        case GET_ALL_CARS:
            return ({
                ...state,
                cars: [...actions.payload]
            });
        case GET_ALL_BRANDS:
            return ({
                ...state,
                brands: actions.payload
            });
        default:
            return state;
    }
}