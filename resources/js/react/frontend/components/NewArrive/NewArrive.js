import React, {Component} from 'react'
import styles from './NewArrive.scss'

export default class NewArrive extends Component {
    componentDidMount() {
        $(document)
            .ready(function ($) {
                $('.slider-pro').sliderPro({
                    width: 670,
                    height: 415,
                    orientation: 'vertical',
                    loop: true,
                    arrows: false,
                    buttons: false,
                    thumbnailsPosition: 'left',
                    thumbnailPointer: true,
                    thumbnailWidth: 335,
                    breakpoints: {
                        800: {
                            thumbnailsPosition: 'bottom',
                            thumbnailWidth: 250,
                            thumbnailHeight: 100
                        },
                        500: {
                            thumbnailsPosition: 'bottom',
                            thumbnailWidth: 120,
                            thumbnailHeight: 80
                        }
                    }
                });
            });
    }
    render() {
        const cars = [...this.props.cars]
        return (
            <div className={["slider-pro", styles["slider-pro"]].join(' ')}>
                <div className={["sp-slides", styles["sp-slides"]].join(' ')}>{cars.map((car) => {
                        let file_name = '';
                        let folder_name = '';
                        if (car.photos.length) {
                            car
                                .photos
                                .map(photo => {
                                    if (photo.is_featured === 1) {
                                        file_name = photo.file_name;
                                        folder_name = car.albums.folder_name
                                    }
                                })
                        }
                        const src = (folder_name)
                            ? `${this.props.baseURL}storage_image/car_albums/${folder_name}/${file_name}`
                            : `${this.props.baseURL}images/no_car_photo.png`;
                        const path = `/cars/${car
                            .brands
                            .brand_name
                            .split(' ')
                            .join('-')}-${car
                            .model_no
                            .split(' ')
                            .join('-')}/${car
                            .id}`

                        return (
                            <div className={["sp-slide", styles["sp-slide"]].join(' ')} key={car.id}>
                                <img
                                    className={["sp-image", styles["sp-image"]].join(' ')}
                                    src="../src/css/images/blank.gif"
                                    data-src={src}
                                    data-retina={src}
                                    alt={car.title
                                    ? car.title
                                    : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year) + "'s image"}/>
                            </div>
                        )
                    })}
                </div>
                <div className={["sp-thumbnails", styles["sp-thumbnails"]].join(' ')}>
                    {cars.map(car => {
                        const car_status = (car.car_condition === 'used')
                            ? 'second-hand'
                            : car.car_condition;
                        let file_name = '';
                        let folder_name = '';
                        if (car.photos.length) {
                            car
                                .photos
                                .map(photo => {
                                    if (photo.is_featured === 1) {
                                        file_name = photo.file_name;
                                        folder_name = car.albums.folder_name
                                    }
                                })
                        }
                        const src = (folder_name)
                            ? `${this.props.baseURL}storage_image/car_albums/${folder_name}/${file_name}`
                            : `${this.props.baseURL}/images/no_car_photo.png`;
                        const path = `/cars/${car
                            .brands
                            .brand_name
                            .split(' ')
                            .join('-')}-${car
                            .model_no
                            .split(' ')
                            .join('-')}/${car
                            .id}`

                        return (
                            <div className={["sp-thumbnail", styles["sp-thumbnail"]].join(' ')} key={car.id}>
                                
                                {/* <div className={["sp-thumbnail-image-container", styles["sp-thumbnail-image-container"]].join(' ')}>
                                    <img
                                        className={["sp-thumbnail-image", styles["sp-thumbnail-image"]].join(' ')}
                                        src={src}/>
                                </div> */}

                                <div className={["sp-thumbnail-text", styles["sp-thumbnail-text"]].join(' ')}>
                                    <div className={["sp-thumbnail-title", styles["sp-thumbnail-title"]].join(' ')}>
                                        {(car.title)
                                            ? car.title
                                            : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year)}
                                    </div>
                                    <div className={["sp-thumbnail-description", styles["sp-thumbnail-description"]].join(' ')}>
                                        <div>
                                            Status: {car_status}
                                        </div>
                                        <div>
                                            Price: {car.price}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )
                    })}
                </div>
            </div>
        )
    }
}
