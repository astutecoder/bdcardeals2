import {GET_ALL_CARS, GET_FEATURED_CARS} from '../actions/types'

const initialState = {
    cars: []
}

export const carReducers = (initialState, actions) => {
    switch (actions.type) {
        case GET_ALL_CARS:
            return ({
                ...initialState,
                cars: [...actions.payload]
            });
        default:
            return initialState;
    }
}