import React, {Component} from 'react'
import {Redirect} from 'react-router-dom'
import {connect} from 'react-redux'
import {getAllCars} from '../../actions/actions'

class ProcessSearch extends Component {

    constructor(props) {
        super(props);
        this.state = {
            carsToDisplay: []
        }
    }

    componentDidMount() {
        this
            .props
            .getAllCars()
        this.setState({
            carsToDisplay: [...this.props.cars]
        });
    }

    componentDidUpdate(prevProps, prevState) {
        if (prevState.carsToDisplay.length != this.state.carsToDisplay.length) {
            this.setState({
                carsToDisplay: [...this.props.cars]
            });
            let filters = []
            Object
                .keys(this.props.location.state.filters)
                .map((key) => {
                    return filters[key] = this.props.location.state.filters[key]
                });
            this.carsToDisplay(filters);
        }
        if(prevState.carsToDisplay.length === this.state.carsToDisplay.length){
            this.setState({redirect: true})
        }
    }

    componentWillUnmount(){
        this.setState({redirect: false})
    }

    carsToDisplay = (filterArray) => {
        let cars = [...this.props.cars];

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
                cars = cars.filter((car) => {
                    return car[key] == filterArray[key]
                });
                this.setState({
                    carsToDisplay: [...cars]
                })
            }
        }
    }

    render() {
        if(this.state.redirect){
            return(<Redirect to={{
                pathname: '/cars',
                state: {carsToDisplay: this.state.carsToDisplay}
            }} />);
        }
        return (
            <div></div>
        )
    }
}

const mapPropsToState = (state) => ({cars: state.cars.cars})

export default connect(mapPropsToState, {getAllCars})(ProcessSearch)
