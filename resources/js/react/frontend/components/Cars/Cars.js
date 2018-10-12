import React, {Component} from 'react'
import SectionHead from '../SectionHead/SectionHead';
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'

import styles from './Cars.scss'

import {Link} from 'react-router-dom';
import Search from '../Search/Search';
import CarListItem from '../CarListItem/CarListItem';
import Breadcrumb from '../Breadcrumb/Breadcrumb';

class Cars extends Component {
    constructor(props) {
        super(props);
        this.state = {
            carsToShow: []
        }
    }

    componentDidMount() {
        if (!this.props.cars.length) {
            this
                .props
                .getAllCars();
        }
        if (!this.props.brands.length) {
            this
                .props
                .getAllBrands();
        }
        if (!this.props.bodyTypes.length) {
            this
                .props
                .getAllBodyTypes();
        }

        this.is_mobile();
        window.addEventListener('resize', () => {
            this.is_mobile();
        })
        this.carsToShow();

    }

    componentDidUpdate(prevProps, prevState) {
        if (prevProps.cars.length != this.props.cars.length) {
            this.carsToShow();
        }
    }
    componentWillUnmount() {
        this.setState({carsToShow: []})
    }

    is_mobile = () => {
        if (window.outerWidth <= 1023) {
            this.setState({is_mobile: true})
        } else {
            this.setState({is_mobile: false})
        }
    }

    carsToShow = () => {
        if (this.props.location.state) {
            if (this.props.location.state.hasOwnProperty('carsToDisplay')) {
                this.setState({
                    carsToShow: [...this.props.location.state.carsToDisplay]
                });
            }
        } else {
            this.setState({
                carsToShow: [...this.props.cars]
            })
        }
    }

    render() {
        const breadcrumb_links =[
            {
                linkname: 'Car List'
            }
        ]
        return (
            <section>
                <SectionHead title="Cars list"/>

                <Breadcrumb links={breadcrumb_links} />

                {this.state.is_mobile && <div className={styles.search__mobile}>
                    <div className="container">
                        <div className="row">
                            <div className="col-md-12">
                                <Search
                                    {...this.props}
                                    name="Name"
                                    brand="Brand"
                                    bodyType="Type"
                                    model="Model"
                                    carCondition="Car Condition"
                                    year="Year"
                                    priceRange="Price Range"
                                    searchClass="mt-3 p-0 w-100"
                                    flexClass="d-flex flex-column flex-md-row justify-content-between align-items-md-center"/>

                            </div>
                        </div>
                    </div>
                </div>
}

                <div className={styles.listAndSearchContainer}>
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-8">
                                {(this.state.carsToShow.length < 1)
                                    ? <h3 className="text-danger">Sorry! No cars match with search</h3>
                                    : this.state.carsToShow.map(car => (<CarListItem key={car.id} car={car}/>))
}
                            </div>
                            {!this.state.is_mobile && (
                                <div className=" hidden-md col-lg-4">
                                    <div className={styles.search__sidebar__head}>
                                        <h5>Search Cars</h5>
                                    </div>
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
