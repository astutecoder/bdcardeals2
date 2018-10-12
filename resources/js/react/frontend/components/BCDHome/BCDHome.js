import React, {Component} from 'react'
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'

import Slider from '../Slider/Slider'
import Search from '../Search/Search'

class BCDHome extends Component {

    componentWillMount() {
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
    }
    componentDidUpdate(prevProps) {
        if (prevProps.cars.length !== this.props.cars.length) {
            this
                .props
                .setSlider(this.props.cars);
        }
    }
    render() {
        return (
            <div>
                <Slider sliders={this.props.sliders}/>
                <Search
                    {...this.props}
                    flexClass="d-flex flex-column flex-md-row justify-content-between align-items-md-center"/>
            </div>
        )
    }
}
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, bodyTypes: state.cars.bodyTypes, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(BCDHome);
