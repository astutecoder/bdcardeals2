import React, {Component} from 'react'
import {connect} from 'react-redux'
import noUiSlider from 'nouislider'

import {getAllCars} from '../../actions/actions'

import styles from './Search.scss'
import {Redirect} from 'react-router-dom';
import wNumb from 'wnumb'

export default class Search extends Component {

    constructor(props) {
        super(props);
        this.state = {
            redirect: false,
            show_make: true,
            filters: {},
            uniqueModel:[],
        }
    }

    componentDidMount() {
        this.findUniqueModel(this.props.cars);
        this.slideRange();
        
        if (this.props.location.state) {
            this.setState({
                filters: {
                    ...this.props.location.state.filters
                }
            });

            if(this.props.location.state.filters && this.props.location.state.filters.brands_id){
                this.handleModelOnBrandChange(null, this.props.location.state.filters.brands_id);
            }

            if(this.props.location.state.filters.hasOwnProperty('name')){
                this.setState({
                    show_make: false,
                })
                const makeEl = document.querySelector(`.${styles.s_make}`);
                const nameEl = document.querySelector(`.${styles.s_name}`);
                
                makeEl.classList.remove(styles.active);
                nameEl.classList.add(styles.active);
            }
        }
    }

    componentDidUpdate(prevProps, prevState) {
        if (this.state.show_make && prevState.show_make !== this.state.show_make) {
            this.slideRange();
        }
        if(prevProps.cars.length !== this.props.cars.length){
            this.findUniqueModel(this.props.cars);
        }
    }

    componentWillUnmount(){
        this.setState({
            filters:{},
            uniqueModel: []
        })
    }

    findUniqueModel = (cars) => {
        let models = [] ;
        cars.filter(car => {
            let model_name = car.brands.brand_name.toLowerCase() +' '+car.model_no.toLowerCase();
            if(models.indexOf(model_name) === -1) {
                models.push(model_name);
                return true;
            } else {
                return false;
            }
        });

        this.setState({
            uniqueModel: models
        })
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
        const cFormat = wNumb({thousand: ',', prefix: '৳'});
        const slider = $('#price_range')[0];
        let minSpan = document.querySelectorAll('#min'),
            maxSpan = document.querySelectorAll('#max'),
            initMinVal = (!!this.props.location.search && !!this.props.location.state)
                ? (this.props.location.state.filters.price && this.props.location.state.filters.price.min
                    ? this.props.location.state.filters.price.min
                    : 1500000)
                : 1500000,
            initMaxVal = (!!this.props.location.search && !!this.props.location.state)
                ? (this.props.location.state.filters.price && this.props.location.state.filters.price.max
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
        slider.noUiSlider.on('update', (values, handle) => {
            if (handle) {
                maxSpan[0].textContent = ` - ${cFormat.to(Math.floor(values[handle]))}`;
            } else {
                minSpan[0].textContent = ` ${cFormat.to(Math.floor(values[handle]))}`;
            }
        })
        slider
            .noUiSlider
            .on('slide', (values, handle) => {
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

    handleModelOnBrandChange = (event, brandID = '') => {
        let brands_id = (!!event) ? event.currentTarget.value : brandID;
        let cars_of_brand = (!!brands_id) ? this.props.cars.filter(car => car.brands_id == brands_id) : [...this.props.cars];
        
        this.findUniqueModel(cars_of_brand);
    }

    handleSearch = () => {
        this.setState({redirect: true})
    }

    clearSearch = () => {
        this.setState({filters: {}, redirect: true})
    }

    isSearched = () => {
        const query = require('query-string');
        const search_str = (query.parse(this.props.location.search));
        if(!!search_str.q){
            return true;
        }
        return false;
    }

    render() {
        const {redirect} = this.state;
        if (redirect) {
            return (<Redirect
                to={{
                pathname: '/process-search',
                state: {
                    filters: {
                        ...this.state.filters
                    },
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
                            <option value="used">second-hand</option>
                        </select>
                    </div>
                    <div className={styles.selectbox}>
                        <label>
                            <strong>{this.props.brand}</strong>
                        </label>
                        <select
                            className={styles.select}
                            name="brands_id"
                            onChange={(e) => {this.handleSelectType(e); this.handleModelOnBrandChange(e)} }
                            value={this.state.filters.brands_id}>
                            <option value="">Select Brand</option>
                            {this
                                .props
                                .brands.sort((a, b) => {
                                    if(a.brand_name.toLowerCase() < b.brand_name.toLowerCase()){
                                        return -1;
                                    }else if(a.brand_name.toLowerCase() > b.brand_name.toLowerCase()) {
                                        return 1;
                                    }
                                    return 0;
                                })
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
                            name="model_no"
                            onChange={this.handleSelectType}
                            value={this.state.filters.model_no}>
                            <option value="">Select Model</option>
                            {this
                                .state
                                .uniqueModel.sort()
                                .map((model, i) => (
                                    <option key={i} value={model}>{model.toUpperCase()}</option>
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
                                .bodyTypes.sort((a, b) => {
                                    if(a.body_type.toLowerCase() < b.body_type.toLowerCase()){
                                        return -1;
                                    }else if(a.body_type.toLowerCase() > b.body_type.toLowerCase()) {
                                        return 1;
                                    }
                                    return 0;
                                })
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
                    onChange={this.handleSelectType}
                    value={(this.state.filters && this.state.filters.name)? this.state.filters.name : ''}
                    name="name"
                    type='text'
                    placeholder='Brand / Model / Year / Status / Mileage'/>
            </div>
        );
        return (
            <div className={[styles.Search, this.props.searchClass].join(' ')}>
                <div className={styles.searchTab__container}>
                    <ul className={styles.searchTab}>
                        <li
                            className={[styles.searchTab__item, styles.s_make, styles.active].join(' ')}
                            onClick={this.showSearch}>Search By Make</li>
                        <li className={[styles.searchTab__item, styles.s_name].join(' ')} onClick={this.showSearch}>Search By Name</li>
                    </ul>
                </div>
                <div className={[this.props.flexClass, styles.searchContainer].join(' ')}>
                    {this.state.show_make
                        ? searchByMake()
                        : searchByName()}
                    <div className={this.props.btnContainerClass}>
                        <button className="btn btn-lg btn-danger rounded-0" onClick={this.handleSearch}>Search</button>
                        {this.isSearched() && (
                            <button
                                className="btn btn-lg btn-success rounded-0 ml-3"
                                onClick={this.clearSearch}>Clear</button>
                        )}
                    </div>
                </div>
            </div>
        )
    }
}

// const mapPropstoState = (state) => ({cars: state.cars.cars}) export default
// connect(mapPropstoState, {getAllCars})(Search);