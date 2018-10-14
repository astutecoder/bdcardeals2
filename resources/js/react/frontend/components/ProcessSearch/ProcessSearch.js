import React, {Component} from 'react'
import {Redirect} from 'react-router-dom'
import uuidv1 from 'uuid/v1'

export default class ProcessSearch extends Component {

    constructor(props) {
        super(props);
        this.state = {
            carsToDisplay: [],
            filters: {},
            search_q: '',
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
            let q = (this.state.search_q.length > 1) ? '&' : '';

            if (key == 'price') {
                const min = filterArray['price']['min']
                    ? filterArray['price']['min']
                    : 0;
                const max = filterArray['price']['max'];

                cars = cars.filter(car => {
                    return (min <= car.price && car.price <= max)
                });

                this.setState({
                    carsToDisplay: [...cars],
                    search_q: this.state.search_q+''+q
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
        if(cars.length !== this.props.location.state.cars.length){
            this.setState({
                search_q: `?q=${uuidv1()}`
            })
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
                search: (this.state.search_q.length > 1) ? this.state.search_q : ''
            }}/>);
        }
        return (
            <div></div>
        )
    }
}
