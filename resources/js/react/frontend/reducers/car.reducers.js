import {GET_ALL_CARS, GET_FEATURED_CARS, GET_ALL_BRANDS, GET_ALL_BODYTYPES} from '../actions/types'

const initialState = {
    cars: [],
    brands: [],
    bodyTypes: [],
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
        case GET_ALL_BODYTYPES:
            return ({
                ...state,
                bodyTypes: actions.payload
            });
        default:
            return state;
    }
}