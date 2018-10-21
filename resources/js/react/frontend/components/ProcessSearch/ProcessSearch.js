import React, {Component} from 'react'
import {Redirect} from 'react-router-dom'
import uuidv1 from 'uuid/v1'

export default class ProcessSearch extends Component {

    constructor(props) {
        super(props);
        this.state = {
            carsToDisplay: [],
            filters: {},
            search_q: '?page=1'
        }
    }

    componentDidMount() {
        this.setState({
            carsToDisplay: [...this.props.location.state.cars],
            filters: {
                ...this.props.location.state.filters
            },
        });
    }

    componentDidUpdate(prevProps, prevState) {
        if (prevState.carsToDisplay.length != this.state.carsToDisplay.length) {
            this.setState({
                carsToDisplay: [...this.props.location.state.cars]
            });
            let filters = []
            Object
                .keys(this.props.location.state.filters)
                .map((key) => {
                    return filters[key] = this.props.location.state.filters[key]
                });
            this.carsToDisplay(filters);
        }
        if (prevState.carsToDisplay.length === this.state.carsToDisplay.length) {
            this.setState({redirect: true})
        }
    }

    componentWillUnmount() {
        this.setState({redirect: false})
    }

    carsToDisplay = (filterArray) => {
        let cars = [...this.props.location.state.cars];

        // if search by name
        if (filterArray.hasOwnProperty('name')) {
            cars = cars.filter(car => {
                let status = car.car_condition === 'used' ? 'second-hand' : car.car_condition;
                let title = car.brands.brand_name+' '+car.model_no+' '+car.year+' '+car.title+' '+car.subtitle+' '+car.mileage+' '+car.engine+' '+status
                
                return (title.toLowerCase().includes(filterArray['name'].toLowerCase()))
            })

            this.setState({
                carsToDisplay: [...cars]
            })

        } else if(filterArray.hasOwnProperty('model_no')){
            cars = cars.filter(car => {
                let model = car.brands.brand_name+' '+car.model_no
                
                return (model.toLowerCase().includes(filterArray['model_no'].toLowerCase()))
            })

            this.setState({
                carsToDisplay: [...cars]
            })

        } else {
            // if search by make
            for (let key in filterArray) {

                if (key == 'price') {
                    const min = filterArray['price']['min']
                        ? filterArray['price']['min']
                        : 0;
                    const max = filterArray['price']['max'] ? filterArray['price']['max'] : Infinity;

                    cars = cars.filter(car => {
                        return (min <= car.price && car.price <= max)
                    });

                    this.setState({
                        carsToDisplay: [...cars],
                        // search_q: this.state.search_q + '' + q
                    })
                } else {
                    if (!!filterArray[key]) {
                        cars = cars.filter((car) => {
                            return car[key] == filterArray[key]
                        });
                    }
                    this.setState({
                        carsToDisplay: [...cars]
                    })
                }
            }
        }
        if (cars.length !== this.props.location.state.cars.length) {
            this.setState({search_q: `?page=1&q=${uuidv1()}`})
        }
    }

    render() {
        if (this.state.redirect) {
            return (<Redirect
                to={{
                pathname: '/cars',
                state: {
                    carsToDisplay: [...this.state.carsToDisplay],
                    filters: {
                        ...this.state.filters
                    }
                },
                search: this.state.search_q
            }}/>);
        }
        return (
            <div></div>
        )
    }
}
