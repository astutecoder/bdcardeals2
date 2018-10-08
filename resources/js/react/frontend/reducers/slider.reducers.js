import {SET_SLIDERS} from '../actions/types';
import {setSlider} from '../actions/actions'

const initialState = {
    sliders: []
}

export const sliderReducers = (state = initialState, actions) => {
    switch (actions.type) {
        case SET_SLIDERS:
            return ({
                ...state,
                sliders: actions.payload
            });
        default:
            return state;
    }
}