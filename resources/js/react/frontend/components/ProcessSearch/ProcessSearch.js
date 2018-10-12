import React, {Component} from 'react'
import {Redirect} from 'react-router-dom'

export default class ProcessSearch extends Component {

    constructor(props) {
        super(props);
        this.state = {
            carsToDisplay: [],
            filters: {}
        }
    }

    componentDidMount() {
        this.setState({
            carsToDisplay: [...this.props.location.state.cars],
            filters: {
                ...this.props.location.state.filters
            }
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

        for (let key in filterArray) {
            if (key == 'price') {
                const min = filterArray['price']['min']
                    ? filterArray['price']['min']
                    : 0;
                const max = filterArray['price']['max'];

                cars = cars.filter(car => {
                    return (min <= car.price && car.price <= max)
                });

                this.setState({
                    carsToDisplay: [...cars]
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
                }
            }}/>);
        }
        return (
            <div></div>
        )
    }
}
