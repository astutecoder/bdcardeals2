import React, {Component} from 'react'
import SectionHead from '../SectionHead/SectionHead';
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'
import {filterPagination} from '../../Selectors'

import styles from './Cars.scss'

import Search from '../Search/Search';
import CarListItem from '../CarListItem/CarListItem';
import Breadcrumb from '../Breadcrumb/Breadcrumb';
import Pagination from '../Helpers/Pagination/Pagination'

class Cars extends Component {
    constructor(props) {
        super(props);
        this.state = {
            carsToPaginate: []
        }
    }

    componentDidMount() {
        document.title = 'BD Car Deals:: List of Best Cars in Bangladesh';
        window.scrollTo(0, 0);
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
        
        this.isValidPageRequest();
        this.carsToPaginate();

    }

    componentDidUpdate(prevProps, prevState) {
        window.scrollTo(0,0);

        if (prevProps.cars.length != this.props.cars.length) {
            this.carsToPaginate();
            this.isValidPageRequest();
        }
    }

    componentWillUnmount() {
        this.setState({carsToPaginate: []})
    }

    carsToPaginate = () => {
        if (this.props.location.state) {
            if (this.props.location.state.hasOwnProperty('carsToDisplay')) {
                this.setState({
                    carsToPaginate: [...this.props.location.state.carsToDisplay]
                });
            }
        } else {
            this.setState({
                carsToPaginate: [...this.props.cars]
            })
        }
    }

    defaultPerpage = () => {
        return 10;
    }
    requiredPages = () => {
        return Math.ceil(this.props.cars.length / this.defaultPerpage());
    }

    isValidPageRequest() {
        let totalPages = this.requiredPages();
        let {page: currentPage} = this.extractQuery();

        if (!currentPage || totalPages < currentPage) {
            this
                .props
                .history
                .replace('/cars?page=1')
            return;
        }
    }

    extractQuery = () => {
        const query = require('query-string');
        return (query.parse(this.props.location.search));
    };

    carsToShow = () => {
        const {
            page = 1
        } = this.extractQuery();
        return filterPagination(this.defaultPerpage(), page, this.state.carsToPaginate);
    }

    showingSequenceNumber = () => {
        let {page: currentPage} = this.extractQuery();
        let firstCarInPage = ((+ currentPage - 1) * this.defaultPerpage()) + 1;
        let lastCarInPage = (+ currentPage * this.defaultPerpage());
        let totalCars = this.state.carsToPaginate.length;
        lastCarInPage = (lastCarInPage > totalCars)
            ? totalCars
            : lastCarInPage;
        return `${firstCarInPage} - ${lastCarInPage} of ${totalCars}`;
    }

    render() {
        const breadcrumb_links = [
            {
                linkname: 'Car List'
            }
        ]
        return (
            <React.Fragment>
                <SectionHead title="Cars list"/>
                <Breadcrumb links={breadcrumb_links}/>
                <section className="section-wrapper pt-3">

                    <div className={styles.listAndSearchContainer}>
                        <div className="container">
                            <div className="row">
                                <div className="col-lg-8">
                                    {!!this.state.carsToPaginate.length && (
                                        <span>
                                            <strong className="text-danger">showing cars: 
                                            </strong>
                                            {this.showingSequenceNumber()}
                                        </span>
                                    )}
                                    {(this.carsToShow().length < 1)
                                        ? <h3 className="text-danger">Sorry! No cars match with search</h3>
                                        : this.carsToShow().map(car => (<CarListItem key={car.id} car={car} cars={[...this.props.cars]} baseURL={this.props.baseURL} />))
}
                                    {(this.state.carsToPaginate.length > this.defaultPerpage()) && (<Pagination
                                        {...this.props}
                                        perpage={this.defaultPerpage()}
                                        requiredPages={this.requiredPages()}
                                        extractQuery={() => this.extractQuery()}/>)
}
                                </div>

                                <div className="hidden-md col-lg-4">
                                    <div className={styles.search__sidebar__head}>
                                        <h5>Search Cars</h5>
                                    </div>
                                    <Search
                                        { ...this.props }
                                        name="Name"
                                        brand="Brand"
                                        bodyType="Type"
                                        model="Model"
                                        carCondition="Status"
                                        year="Year"
                                        priceRange="Price Range"
                                        searchClass="p-0 w-100"
                                        btnContainerClass="mt-3"
                                        flexClass="d-flex flex-column justify-content-between align-items-md-center"/>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </React.Fragment>
        )
    }
}
const mapPropsToState = (state) => ({
    cars: state.cars.cars, 
    brands: state.cars.brands, 
    bodyTypes: state.cars.bodyTypes, 
    baseURL: state.cars.baseURL,
    sliders: state.sliders.sliders, 
})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(Cars);
