import React, {Component} from 'react'
import {connect} from 'react-redux'
import {getAllCars, setSlider, getAllBrands, getAllBodyTypes} from '../../actions/actions'

import Slider from '../Slider/Slider'
import Search from '../Search/Search'
import CarBoxed from '../CarBoxed/CarBoxed';
import SubSectionHead from '../Helpers/SubSectionHead/SubSectionHead';

class BCDHome extends Component {

    componentWillMount() {
        window.scrollTo(0,0);
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

                <div className="container">
                    <div className="row">
                        <SubSectionHead title='featured cars' />
                        <div className="col-md-12">
                            <CarBoxed filter={{is_featured: 1}} cars={[...this.props.cars]} />
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands, bodyTypes: state.cars.bodyTypes, sliders: state.sliders.sliders})
export default connect(mapPropsToState, {getAllCars, setSlider, getAllBrands, getAllBodyTypes})(BCDHome);
