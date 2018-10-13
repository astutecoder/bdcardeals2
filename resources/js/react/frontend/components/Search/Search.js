import React, {Component} from 'react'
import {connect} from 'react-redux'
import noUiSlider from 'nouislider'

import {getAllCars} from '../../actions/actions'

import styles from './Search.scss'
import {Redirect} from 'react-router-dom';
import wNumb from 'wnumb'

class Search extends Component {

    constructor(props) {
        super(props);
        this.state = {
            redirect: false,
            show_make: true,
            filters: {}
        }
    }

    componentDidMount() {
        // this
        //     .props
        //     .getAllCars();
        this.slideRange();
        if (this.props.location.state) {
            this.setState({
                filters: {
                    ...this.props.location.state.filters
                }
            });
        }
    }

    componentDidUpdate(prevProps, prevState) {
        if (this.state.show_make && prevState.show_make !== this.state.show_make) {
            console.log('slide happening');
            this.slideRange();
        }
    }

    year = () => {
        let yearArr = [],
            currentYear = (new Date()).getFullYear();

        for (let i = 1990; i <= currentYear; i++) {
            yearArr.push(i);
        }
        return yearArr;
    }
    slideRange = () => {
        const cFormat = wNumb({thousand:',', prefix: '৳'});
        const slider = $('#price_range')[0];
        let minSpan = document.querySelectorAll('#min'),
            maxSpan = document.querySelectorAll('#max'),
            initMinVal = (!!this.props.location.state)
                ? (this.props.location.state.filters.price.min
                    ? this.props.location.state.filters.price.min
                    : 0)
                : 1500000,
            initMaxVal = (!!this.props.location.state)
                ? (this.props.location.state.filters.price.max
                    ? this.props.location.state.filters.price.max
                    : 4600000)
                : 5600000;

        noUiSlider.create(slider, {
            start: [
                initMinVal, initMaxVal
            ],
            connect: true,
            range: {
                'min': 50000,
                'max': 30000000
            },
            step: 100000
        });
        slider
            .noUiSlider
            .on('update', (values, handle) => {
                if (handle) {
                    maxSpan[0].textContent = ` - ${cFormat.to(Math.floor(values[handle]))}`;
                    this.setState({
                        filters: {
                            ...this.state.filters,
                            price: {
                                ...this.state.filters.price,
                                max: Math.floor(values[handle])
                            }
                        }
                    });
                } else {
                    minSpan[0].textContent = ` ${cFormat.to(Math.floor(values[handle]))}`;
                    this.setState({
                        filters: {
                            ...this.state.filters,
                            price: {
                                ...this.state.filters.price,
                                min: Math.floor(values[handle])
                            }
                        }
                    });
                }
            })
    }

    showSearch = (e) => {
        const parent = e.currentTarget.parentNode,
            element = e.currentTarget,
            activeEl = parent.querySelector(`.${styles.active}`);

        if (element.classList !== activeEl.classList) {
            activeEl
                .classList
                .remove(styles.active);
            element
                .classList
                .add(styles.active);
            this.setState({
                show_make: !this.state.show_make,
                filters: {}
            })
        }
    }

    handleSelectType = (e) => {
        const name = e.currentTarget.name,
            value = e.currentTarget.value,
            newObj = {};

        newObj[name] = value;

        this.setState({
            filters: {
                ...this.state.filters,
                ...newObj
            }
        });
    }

    handleSearch = () => {
        this.setState({redirect: true})
    }

    render() {
        const {redirect} = this.state;
        if (redirect) {
            return (<Redirect
                to={{
                pathname: '/process-search',
                state: {
                    filters: {...this.state.filters},
                    cars: [...this.props.cars]
                }
            }}/>);
        }
        const searchByMake = () => (
            <div className={styles.searchFieldContainer}>
                <div className={this.props.flexClass}>
                    <div className={styles.selectbox}>
                        <label>
                            <strong>{this.props.carCondition}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="car_condition"
                            onChange={this.handleSelectType}
                            value={this.state.filters.car_condition}>
                            <option value="">Select Status</option>
                            <option value="new">new</option>
                            <option value="recondition">recondition</option>
                            <option value="used">second hand</option>
                        </select>
                    </div>
                    <div className={styles.selectbox}>
                        <label>
                            <strong>{this.props.brand}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="brands_id"
                            onChange={this.handleSelectType}
                            value={this.state.filters.brands_id}>
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
                        <label>
                            <strong>{this.props.model}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="id"
                            onChange={this.handleSelectType}
                            value={this.state.filters.id}>
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
                        <label>
                            <strong>{this.props.bodyType}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="body_types_id"
                            onChange={this.handleSelectType}
                            value={this.state.filters.body_types_id}>
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
                        <label>
                            <strong>{this.props.year}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="year"
                            onChange={this.handleSelectType}
                            value={this.state.filters.year}>
                            <option value="">Select Year</option>
                            {this
                                .year()
                                .map(y => (
                                    <option key={y} value={y}>{y}</option>
                                ))}
                        </select>
                    </div>
                    <div className={styles.range}>
                        <label>
                            <strong>{this.props.priceRange}</strong>
                        </label>
                        <div
                            id="price_range"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Price Range"></div>
                        <div className={styles.price_range__info}>
                            {/* <div className={styles.price_range__label}>Price Range:
                    </div> */}
                            <span id="min" className={styles.price_range__min}></span>
                            <span id="max" className={styles.price_range__max}></span>
                        </div>
                    </div>
                </div>
            </div>
        );
        const searchByName = () => (
            <div className={styles.searchFieldContainer}>
                <label>
                    <strong>{this.props.name}</strong>
                </label>
                <input
                    className={styles.search__name}
                    value={this.state.filters.name}
                    name="name"
                    type='text'
                    placeholder='type a name'/>
            </div>
        );
        return (
            <div className={[styles.Search, this.props.searchClass].join(' ')}>
                <div className={styles.searchTab__container}>
                    <ul className={styles.searchTab}>
                        <li
                            className={[styles.searchTab__item, styles.active].join(' ')}
                            onClick={this.showSearch}>Search By Make</li>
                        <li className={styles.searchTab__item} onClick={this.showSearch}>Search By Name</li>
                    </ul>
                </div>
                <div className={[this.props.flexClass, styles.searchContainer].join(' ')}>
                    {this.state.show_make
                        ? searchByMake()
                        : searchByName()}
                    <div className={this.props.btnContainerClass}>
                        <button className="btn btn-lg btn-danger rounded-0" onClick={this.handleSearch}>Search</button>
                    </div>
                </div>
            </div>
        )
    }
}

const mapPropstoState = (state) => ({cars: state.cars.cars})

export default connect(mapPropstoState, {getAllCars})(Search);
