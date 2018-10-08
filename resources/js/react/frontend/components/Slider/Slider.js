import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import {connect} from 'react-redux'

import styles from './Slider.scss'
import {getAllCars, setSlider} from '../../actions/actions'

class Slider extends Component {
    constructor(props) {
        super(props);
        this.state = {
            slider: []
        }
    }

    componentWillMount() {
        this
            .props
            .getAllCars();
    }
    componentDidUpdate(prevProps, prevState) {
        if (prevProps.cars.length !== this.props.cars.length) {
            console.log(this.props.cars);
            this
                .props
                .setSlider(this.props.cars);
        }
        // if (prevState.slider.length !== this.state.slider.length) {
        // console.log(this.state.slider); }
    }

    // slider = () => {     let slider = [];     this         .props         .cars
    //     .map((item) => {             // console.log('item', !!item.albums);
    //   if (/*item.is_featured &&*/ !!item.albums) { slider.push(item)
    // }         });     this.setState({slider: slider}); }

    render() {
        return (
            <div
                id="carouselExampleControls"
                className="carousel slide"
                data-ride="carousel">
                <div className={["carousel-inner", styles.slider].join(' ')}>
                    {this
                        .props
                        .sliders
                        .map((item, index) => {
                            return (
                                <div
                                    key={index}
                                    className={(index == 0)
                                    ? ["carousel-item active", styles.slider__imgItem].join(' ')
                                    : ["carousel-item", styles.slider__imgItem].join(' ')}>
                                    <img
                                        className="d-block w-100"
                                        src={'/storage/car_albums/' + item.albums.folder_name + '/' + item.photos.file_name}
                                        alt="First slide"/>

                                    <div className={styles.slider__infoContainer}>
                                        <div className={styles.slider__title}>
                                            <h3>{item.title
                                                    ? item.title
                                                    : (item.brands.brand_name + ' ' + item.model_no + ' ' + item.year)}</h3>
                                                    <span className={styles.slider__title_preText}>{item.model_no +' '+ item.year}</span>
                                        </div>
                                        <div className={styles.slider__subtitle}>
                                            {item.subtitle}
                                        </div>
                                        <div className={styles.slider__btn_container}>
                                            <button className={[styles.slider__btn, styles.slider__btn__amount].join(' ')}>
                                                <span className={styles.slider__btn__currencySymbol}>৳
                                                </span>{item.price}</button>
                                            <button className={[styles.slider__btn, styles.slider__btn__details].join(' ')}>
                                                Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            )
                        })}
                </div>
                <a
                    className="carousel-control-prev"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="prev">
                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span className="sr-only">Previous</span>
                </a>
                <a
                    className="carousel-control-next"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="next">
                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                    <span className="sr-only">Next</span>
                </a>
            </div>
        )
    }
}

const mapPropsToState = (state) => ({cars: state.cars.cars, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider})(Slider);
