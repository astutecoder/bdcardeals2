import React, {Component} from 'react'
import {BrowserRouter, Route, Switch, Redirect} from 'react-router-dom'
import {connect} from 'react-redux';
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from './actions/actions'

import Header from './components/Header/Header';
import BCDHome from './components/BCDHome/BCDHome';
import Cars from './components/Cars/Cars';
import ProcessSearch from './components/ProcessSearch/ProcessSearch';
import CarDetails from './components/CarDetails/CarDetails';
import Footer from './components/Footer/Footer'
import ContactUs from './components/ContactUs/ContactUs';

class FrontEndRoutes extends Component {
    constructor(props) {
        super(props);
        this.state = {
            recentCars: [],
            brandsByAscName: []
        }
    }
    componentDidMount() {
        const headerContainer = document.querySelector('header');
        setTimeout(() => {
            const headerHeight = headerContainer.offsetHeight;

            window.addEventListener('scroll', () => {
                let scrollY = window.scrollY;
                if (scrollY > headerHeight) {
                    headerContainer.style.position = 'sticky';
                    headerContainer.style.backgroundColor = 'white';
                    headerContainer.style.boxShadow = '2px 5px 5px rgba(0,0,0,0.25)';
                } else {
                    headerContainer.style.position = 'absolute';
                    headerContainer.style.backgroundColor = 'rgba(255,255,255,.75)';
                    headerContainer.style.boxShadow = 'none';
                }
            })
        }, 0);

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
            <BrowserRouter>
                <div>
                    <Header/>
                    <Switch>
                        <Route
                            path='/'
                            exact
                            render={(props) => (<BCDHome
                            {...props}
                            recentCars={[...this.state.recentCars]}
                            brandsByAscName={[...this.state.brandsByAscName]}/>)}/>
                        <Route path='/cars' exact component={Cars}/>
                        <Route path='/process-search' exact component={ProcessSearch}/> {/* <Route path='/cars/:car/:id' component={CarDetails}/> */}
                        <Route
                            path='/cars/:car/:id'
                            render={(props) => (<CarDetails key={props.match.params.id} {...props}/>)}/>
                        <Route path='/contact-us'  component={ContactUs}/>
                        <Redirect to='/'/>
                    </Switch>
                    <Route
                        render={(props) => (<Footer
                        {...props}
                        sortBrandsByName={(e) => this.sortBrandsByName(e)}
                        top_brands={this.state.brandsByAscName}/>)}/>
                </div>
            </BrowserRouter>
        )
    }
}

const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, bodyTypes: state.cars.bodyTypes, sliders: state.sliders.sliders})

export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(FrontEndRoutes);
