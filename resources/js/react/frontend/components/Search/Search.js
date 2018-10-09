import React, {Component} from 'react'
import {connect} from 'react-redux'

import {getAllCars} from '../../actions/actions'

import styles from './Search.scss'

class Search extends Component {
    componentDidMount() {
        this
            .props
            .getAllCars();
    }
    year = () => {
        let yearArr = [],
            currentYear = (new Date()).getFullYear();

        for (let i = 1990; i <= currentYear; i++){
            yearArr.push(i);
        }
        return yearArr;
    }
    render() {
        return (
            <div className={styles.Search}>
                {/* colClass controlls
                    whether seach fields and
                    search btn are in two col and not
                */}
                <div className={this.props.flexClass}>
                    <div className={styles.searchFieldContainer}>
                        {/* rowClass controlls
                    whether seach fields are in three col and not
                */}
                        <div className={this.props.flexClass}>
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
                            <div className={styles.selectbox}>
                                <select className={styles.select}>
                                    <option value="">Select Year</option>
                                    {this.year()
                                        .map(y => (
                                            <option key={y} value={y}>{y}</option>
                                        ))}
                                </select>
                            </div>
                        </div>
                        <div className={this.props.flexClass}>
                            <div className={styles.selectbox}></div>
                            <div className={styles.selectbox}></div>
                            <div className={styles.range}></div>
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
