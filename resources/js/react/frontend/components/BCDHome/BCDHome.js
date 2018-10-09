import React, {Component} from 'react'
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands} from '../../actions/actions'

import Slider from '../Slider/Slider'
import Search from '../Search/Search'

class BCDHome extends Component {

    componentWillMount() {
        this
            .props
            .getAllCars();
        this
            .props
            .getAllBrands();
    }
    componentDidUpdate(prevProps) {
        if (prevProps.cars.length !== this.props.cars.length) {
            console.log(this.props.cars);
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
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands})(BCDHome);
