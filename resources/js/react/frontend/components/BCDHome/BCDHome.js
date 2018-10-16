import React, {Component} from 'react'
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'

import Slider from '../Slider/Slider'
import Search from '../Search/Search'
import CarBoxed from '../CarBoxed/CarBoxed';
import SubSectionHead from '../Helpers/SubSectionHead/SubSectionHead';
import NewArrive from '../NewArrive/NewArrive';

import styles from './BCDHome.scss'
import Footer from '../Footer/Footer';

class BCDHome extends Component {

    constructor(props) {
        super(props);
        this.state = {
            recentCars: [],
            brandsByAscName: []
        }
    }

    componentWillMount() {
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
        this
            .props
            .setSlider(this.props.cars);

        if (this.props.cars.length > 0) {
            this.recentCars();
        }

        if (this.props.brands.length > 0) {
            this.sortBrandsByName(this.props.brands);
        }
    }

    componentDidUpdate(prevProps) {
        if (prevProps.cars.length !== this.props.cars.length) {
            this
                .props
                .setSlider(this.props.cars);

            this.recentCars();
        }

        if (prevProps.brands.length !== this.props.brands.length) {
            this.sortBrandsByName(this.props.brands);
        }
    }

    recentCars = () => {
        const newCars = [];
        const countCars = (this.props.cars.length >= 5)
            ? 5
            : this.props.cars.length;
        for (let i = 0; i < countCars; i++) {
            newCars.push(this.props.cars[i])
        }
        this.setState({
            recentCars: [...newCars]
        })
    }

    sortBrandsByName = (brands) => {
        const brandsAsc = [...brands];
        const loopCounter = brandsAsc.length;
        const randomBrands = [];

        loop1 : for (let i = 0; i < loopCounter; i++) {
            if (randomBrands.length > 5) {
                break;
            }
            let z = i;
            let index = Math.floor(Math.random() * brandsAsc.length)

            // checking if brand name already exists in randomBrands array
            loop2 : for (let y = 0; y < randomBrands.length; y++) {
                if (randomBrands[y].brand_name === brandsAsc[index].brand_name) {
                    i = z - 1;
                    continue loop1;
                }
            }

            randomBrands.push(brandsAsc[index]);
        }

        randomBrands.sort((a, b) => {
            if (a.brand_name < b.brand_name) {
                return -1;
            } else {
                return 1;
            }
        })
        this.setState({
            brandsByAscName: [...randomBrands]
        })

    }

    handleTopMakers = (maker_id) => {
        this
            .props
            .history
            .push({
                pathname: '/process-search',
                state: {
                    filters: {
                        brands_id: maker_id
                    },
                    cars: [...this.props.cars]
                }
            })
    }

    render() {
        return (
            <div>
                <Slider sliders={this.props.sliders}/>
                <Search
                    {...this.props}
                    flexClass="d-flex flex-column flex-md-row justify-content-between align-items-md-center"/>

                <section className="section-wrapper">
                    <div className="container">
                        <div className="row">
                            <SubSectionHead title='featured cars'/>
                            <div className="col-md-12">
                                <CarBoxed
                                    filter={{
                                    is_featured: 1
                                }}
                                    cars={[...this.props.cars]}/>
                            </div>
                        </div>
                    </div>
                </section>

                {this.state.recentCars.length > 0 && (
                    <section className={["section-wrapper", styles.recent_car_container].join(' ')}>
                        <div className="container">
                            <div className="row">
                                <div className="col-md-12">
                                    <SubSectionHead title="Recent Cars"/>
                                    <NewArrive cars={this.state.recentCars} thumbImage={false}/>
                                </div>
                            </div>
                        </div>
                    </section>
                )
}

                {this.state.brandsByAscName.length > 0 && (
                    <section className={["section-wrapper", styles.top_makers].join(' ')}>
                        <div className="container">
                            <div className="row">
                                <div className="col-md-12">
                                    <SubSectionHead title="top make"/>
                                    <div className="row">
                                        {this
                                            .state
                                            .brandsByAscName
                                            .map((brand, i) => (
                                                <div className="col-md-6 text-uppercase mb-2" key={i}>
                                                    <span
                                                        className={styles.top_makers__name}
                                                        onClick={() => this.handleTopMakers(brand.id)}>{brand.brand_name}</span>
                                                </div>
                                            ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                )
}
                <Footer/>

            </div>
        )
    }
}
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, bodyTypes: state.cars.bodyTypes, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(BCDHome);
