import {GET_ALL_CARS, GET_FEATURED_CARS, SET_SLIDERS} from './types'
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

// SLIDER
export const setSlider = () => (dispatch, getState) => {
    let slider = [],
        carArray = getState().cars.cars;
    carArray.map((item => {
        if (/*item.is_featured &&*/ !!item.albums) {
            let slideItem = {
                id: item.id,
                title: item.title,
                subtitle: item.subtitle,
                albums: {folder_name: item.albums.folder_name},
                brands: { brand_name: item.brands.brand_name },
                model_no : item.model_no,
                year : item.year,
                price: item.price,
            };
            item.photos.map(photo => {
                if(!!photo.is_featured){
                    slideItem = {
                        ...slideItem,
                        photos: {
                            file_name: photo.file_name,
                        }
                    }
                }
            })
            slider.push(slideItem)
        }
    }));
    dispatch({
        type: SET_SLIDERS,
        payload: slider
    });
}