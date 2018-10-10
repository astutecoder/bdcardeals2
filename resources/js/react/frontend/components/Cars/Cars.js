import React, {Component} from 'react'
import SectionHead from '../SectionHead/SectionHead';
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'

import styles from './Cars.scss'

import {Link} from 'react-router-dom';
import Search from '../Search/Search';

class Cars extends Component {
    constructor(props) {
        super(props);
        this.state = {}
    }

    componentDidMount() {
        this.is_mobile();
        window.addEventListener('resize', () => {
            this.is_mobile();
        })
        console.log(this.props.location.state, window.outerWidth, this.state);

    }
    is_mobile = () => {
        if (window.outerWidth <= 1023) {
            this.setState({is_mobile: true})
        } else {
            this.setState({is_mobile: false})
        }
    }
    render() {
        return (
            <section>
                <SectionHead title="Cars list"/>

                <div className={styles.breadcrumb__container}>
                    <ul className={styles.breadcrumb__lsit}>
                        <li className={styles.breadcrumb__item}>
                            <Link to='/'>
                                <i className="fa fa-home"></i>
                            </Link>
                        </li>
                        <li className={styles.breadcrumb__item}>Car List</li>
                    </ul>
                </div>

                {this.state.is_mobile && <div className={styles.search__mobile}>
                    <Search
                        {...this.props}
                        name="Name"
                        brand="Brand"
                        bodyType="Type"
                        model="Model"
                        carCondition="Car Condition"
                        year="Year"
                        priceRange="Price Range"
                        flexClass="d-flex flex-column flex-md-row justify-content-between align-items-md-center"/>

                </div>
}

                <div className={styles.listAndSearchContainer}>
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-8">
                                car lists
                            </div>
                            {!this.state.is_mobile && (
                                <div className=" hidden-md col-lg-4">
                                    <div className={styles.search__sidebar__head}> <h5>Search Cars</h5></div>
                                    <Search
                                        {...this.props}
                                        name="Name"
                                        brand="Brand"
                                        bodyType="Type"
                                        model="Model"
                                        carCondition="Car Condition"
                                        year="Year"
                                        priceRange="Price Range"
                                        searchClass="p-0 w-100"
                                        flexClass="d-flex flex-column
                                  justify-content-between align-items-md-center"
                                        btnContainerClass="mt-3"/>
                                </div>
                            )
}
                        </div>
                    </div>
                </div>

            </section>
        )
    }
}
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, bodyTypes: state.cars.bodyTypes, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(Cars);
