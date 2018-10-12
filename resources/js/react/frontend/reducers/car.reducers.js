import {GET_ALL_CARS, GET_SINGLE_CAR, GET_ALL_BRANDS, GET_ALL_BODYTYPES} from '../actions/types'

const initialState = {
    cars: [],
    brands: [],
    bodyTypes: [],
    singleCar: {}
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
                brands: [...actions.payload]
            });
        case GET_ALL_BODYTYPES:
            return ({
                ...state,
                bodyTypes: [...actions.payload]
            });
        case GET_SINGLE_CAR:
            return ({
                ...state,
                singleCar: {...actions.payload}
            });
        default:
            return state;
    }
}