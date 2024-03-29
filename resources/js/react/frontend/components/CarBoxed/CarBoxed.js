import React, {Component} from 'react'
import {Link} from 'react-router-dom'

import styles from './CarBoxed.scss'
import PriceBox from '../Helpers/PriceBox/PriceBox';
import CarTableHighlight from '../Helpers/CarTableHighlight/CarTableHighlight';
import SubSectionHead from '../Helpers/SubSectionHead/SubSectionHead'

import Slider from 'react-slick'

export default class CarBoxed extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showingCars: []
        }
    }

    componentDidMount() {
        this.filterCars(this.props.filter);
    }
    componentDidUpdate(prevProps) {
        if (prevProps.cars.length !== this.props.cars.length) {
            this.filterCars(this.props.filter)
        }
    }

    filterCars = (filters) => {
        let filteredCars = this
            .props
            .cars
            .filter(car => {
                if (filters.hasOwnProperty('brands_id')) {
                    return (car.brands_id === filters.brands_id && car.id !== filters.car.id)
                }
                if (filters.hasOwnProperty('is_featured')) {
                    return car.is_featured === filters.is_featured
                }
            })
        if (!filteredCars.length && filters.hasOwnProperty('brands_id')) {
            filteredCars = this
                .props
                .cars
                .filter(car => {
                    return car.year === filters.car.year && car.id !== filters.car.id
                })
        }
        this.setState({showingCars: filteredCars})
    }

    slide_prev = () => {
        this
            .slider
            .slickPrev();
    }

    slide_next = () => {
        this
            .slider
            .slickNext();
    }

    render() {
        const cars = [...this.state.showingCars];
        const title = (this.props.filter.hasOwnProperty('brands_id'))
            ? 'related cars'
            : 'featured cars'
        const options = {
            autoplay: true,
            arrows: false,
            dots: false,
            speed: 500,
            pauseOnHover: true,
            slidesToShow: (cars.length >= 3)
                ? 3
                : cars.length,
            slidesToScroll: (cars.length >= 3)
                ? 3
                : cars.length,
            infinite: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: (cars.length >= 2)
                            ? 2
                            : cars.length,
                        slidesToScroll: (cars.length >= 2)
                            ? 2
                            : cars.length,
                        initialSlide: 0
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        initialSlide: 0,
                        centerMode: true
                    }
                }, {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        initialSlide: 0
                    }
                }
            ]
        };
        return (
            <React.Fragment>
                {!!cars.length && (
                    <section className={["section-wrapper", this.props.classes].join(' ')}>
                        <div className="container">
                            <div className="row">
                                <SubSectionHead title={title}/>
                                <div className="col-md-12">
                                    <div id="carboxed" className={styles.car_box__container}>
                                        <Slider ref={c => (this.slider = c)} {...options}>
                                            {cars.map((car) => {

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
                                                    <div className={styles.car_box} key={car.id}>
                                                        <h3 className={styles.car_box__title}>
                                                            <Link
                                                                to={{
                                                                pathname: path,
                                                                state: {
                                                                    car: {
                                                                        ...car
                                                                    },
                                                                    cars: [...this.props.cars]
                                                                }
                                                            }}>
                                                                {(car.title)
                                                                    ? car.title
                                                                    : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year)}
                                                            </Link>
                                                        </h3>
                                                        <div className={styles.car_box__img_container}>
                                                            <Link
                                                                to={{
                                                                pathname: path,
                                                                state: {
                                                                    car: {
                                                                        ...car
                                                                    },
                                                                    cars: [...this.props.cars]
                                                                }
                                                            }}>
                                                                <img
                                                                    src={src}
                                                                    alt={car.title
                                                                    ? car.title
                                                                    : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year) + "'s image"}/>
                                                                <span className={styles.car_box__price}>
                                                                    <PriceBox car={car}/>
                                                                </span>
                                                            </Link>

                                                        </div>
                                                        <div className={styles.car_box__highlights}>
                                                            <CarTableHighlight car={car} list_view='hide'/>
                                                        </div>
                                                    </div>
                                                )
                                            })}
                                        </Slider>

                                        <div className={styles.slide_control}>
                                            <span className={styles.slide_control__left} onClick={this.slide_prev}>
                                                <i className="fa fa-chevron-left"></i>
                                            </span>
                                            <span className={styles.slide_control__right} onClick={this.slide_next}>
                                                <i className="fa fa-chevron-right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                )
}
            </React.Fragment>
        )
    }
}
