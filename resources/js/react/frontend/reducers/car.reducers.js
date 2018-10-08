import {GET_ALL_CARS, GET_FEATURED_CARS} from '../actions/types'

const initialState = {
    cars: []
}

export const carReducers = (state = initialState, actions) => {
    switch (actions.type) {
        case GET_ALL_CARS:
            return ({
                ...state,
                cars: [...actions.payload]
            });
        default:
            return state;
    }
}