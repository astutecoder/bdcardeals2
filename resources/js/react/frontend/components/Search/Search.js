import React, {Component} from 'react'
import {connect} from 'react-redux'
import noUiSlider from 'nouislider'

import {getAllCars} from '../../actions/actions'

import styles from './Search.scss'

class Search extends Component {
    componentDidMount() {
        this
            .props
            .getAllCars();
        this.slideRange();
    }
    componentDidUpdate() {}
    year = () => {
        let yearArr = [],
            currentYear = (new Date()).getFullYear();

        for (let i = 1990; i <= currentYear; i++) {
            yearArr.push(i);
        }
        return yearArr;
    }
    slideRange = () => {
        const slider = $('#price_range')[0];
        let minSpan = document.querySelectorAll('#min'),
            maxSpan = document.querySelectorAll('#max');

        noUiSlider.create(slider, {
            start: [
                1500000, 16000000
            ],
            connect: true,
            range: {
                'min': 50000,
                'max': 30000000
            },
            step: 10000
        });
        slider
            .noUiSlider
            .on('update', (values, handle) => {
                if (handle) {
                    maxSpan[0].textContent = ` - ৳ ${Math.floor(values[handle])}`;
                } else {
                    minSpan[0].textContent = ` ৳ ${Math.floor(values[handle])}`;
                }
            })
    }
    render() {
        return (
            <div className={styles.Search}>
                <div className={this.props.flexClass}>
                    <div className={styles.searchFieldContainer}>
                        <div className={this.props.flexClass}>
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Type</option>
                                    {this
                                        .props
                                        .bodyTypes
                                        .map(bodyType => (
                                            <option key={bodyType.id} value={bodyType.id}>{bodyType.body_type}</option>
                                        ))}
                                </select>
                            </div>
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Brand</option>
                                    {this
                                        .props
                                        .brands
                                        .map(brand => (
                                            <option key={brand.id} value={brand.id}>{brand.brand_name}</option>
                                        ))}
                                </select>
                            </div>
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Model</option>
                                    {this
                                        .props
                                        .cars
                                        .map(car => (
                                            <option key={car.id} value={car.id}>{car.brands.brand_name + ' ' + car.model_no}</option>
                                        ))}
                                </select>
                            </div>
                        </div>
                        <div className={this.props.flexClass}>
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Condition</option>
                                    {this
                                        .props
                                        .cars
                                        .map(car => (
                                            <option key={car.id} value={car.id}>{car.brands.brand_name + ' ' + car.model_no}</option>
                                        ))}
                                </select>
                            </div>
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Year</option>
                                    {this
                                        .year()
                                        .map(y => (
                                            <option key={y} value={y}>{y}</option>
                                        ))}
                                </select>
                            </div>
                            <div className={styles.range}>
                                <div id="price_range" data-toggle="tooltip" data-placement="top" title="Price Range" tabIndex="0"></div>
                                <div className={styles.price_range__info}>
                                    {/* <div className={styles.price_range__label}>Price Range:
                                    </div> */}
                                    <span id="min" className={styles.price_range__min}></span>
                                    <span id="max" className={styles.price_range__max}></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button className="btn btn-lg btn-danger rounded-0">Search</button>
                    </div>
                </div>
            </div>
        )
    }
}

const mapPropstoState = (state) => ({cars: state.cars.cars})

export default connect(mapPropstoState, {getAllCars})(Search);
