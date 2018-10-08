import {GET_ALL_CARS, GET_FEATURED_CARS} from './types'
import Axios from 'axios';

const BaseURL = '/';

export const getAllCars = () => (dispatch) => {
    Axios
        .get(`${BaseURL}api/v1/all-cars`,{
            headers: {
                Accept: 'application/json'
            }
        })
        .then(response => (dispatch({
            type: GET_ALL_CARS,
            payload: response.data    
        })))
        .catch(error => console.dir(error));
}

export const getFeaturedCars = () => (dispatch) => {}