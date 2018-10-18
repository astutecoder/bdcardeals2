import {GET_ALL_CARS, GET_SINGLE_CAR, SET_SLIDERS, GET_ALL_BRANDS, GET_ALL_BODYTYPES} from './types'
import Axios from 'axios'

// export const BaseURL = '/projects/bdcardeals/';
export const BaseURL = '/';

export const getAllCars = () => (dispatch) => {
    Axios
        .get(`${BaseURL}api/v1/all-cars`, {
        headers: {
            Accept: 'application/json'
        }
    })
        .then(response => (dispatch({type: GET_ALL_CARS, payload: response.data})))
        .catch(error => console.dir(error));
}

export const getSingleCar = (id) => (dispatch) => {
    Axios
        .get(`${BaseURL}api/v1/get-car/${id}`)
        .then(response => {
            dispatch({
                type: GET_SINGLE_CAR,
                payload: response.data
            })
        })
        .catch(err => (dispatch({
            type: GET_SINGLE_CAR,
            payload: {error: 'Sorry! No match found'}
        })))
}

// SLIDER
export const setSlider = () => (dispatch, getState) => {
    let slider = [],
        carArray = getState().cars.cars;
    carArray.map((item => {
        if (/*item.is_featured &&*/!!item.albums) {
            let slideItem = {
                id: item.id,
                title: item.title,
                subtitle: item.subtitle,
                albums: {
                    folder_name: item.albums.folder_name
                },
                brands: {
                    brand_name: item.brands.brand_name
                },
                model_no: item.model_no,
                year: item.year,
                price: item.price
            };
            item
                .photos
                .map(photo => {
                    if (!!photo.is_featured) {
                        slideItem = {
                            ...slideItem,
                            photos: {
                                file_name: photo.file_name
                            }
                        }
                    }
                })
            slider.push(slideItem)
        }
    }));
    dispatch({type: SET_SLIDERS, payload: slider});
}

// BRANDS
export const getAllBrands = () => (dispatch) => {
    Axios
        .get(`${BaseURL}api/v1/all-brands`, {
        headers: {
            Accept: 'application/json'
        }
    })
        .then(response => (dispatch({type: GET_ALL_BRANDS, payload: response.data})))
        .catch(err => console.dir(err));
}

// BODY TYPES
export const getAllBodyTypes = () => (dispatch) => {
    Axios
        .get(`${BaseURL}api/v1/all-body-types`, {
        headers: {
            Accept: 'application/json'
        }
    })
        .then(response => (dispatch({type: GET_ALL_BODYTYPES, payload: response.data})))
        .catch(err => console.dir(err));
}