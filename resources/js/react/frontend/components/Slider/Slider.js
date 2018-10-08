import React, {Component} from 'react'
import {connect} from 'react-redux'

import {getAllCars} from '../../actions/actions'

class Slider extends Component {
    constructor(props) {
        super(props);
        this.state = {
            slider: []
        }
    }

    componentDidMount() {
        this
            .props
            .getAllCars();
    }
    componentDidUpdate(prevProps, prevState) {
        if (prevProps.cars.length !== this.props.cars.length) {
            console.log(this.props.cars);
            this.slider();
        }
        if (prevState.slider.length !== this.state.slider.length) {
            console.log(this.state.slider);
        }
    }

    slider = () => {
        let slider = [];
        this
            .props
            .cars
            .map((item) => {
                // console.log('item', !!item.albums);
                if (/*item.is_featured &&*/ !!item.albums) {
                    slider.push(item)
                }
            });
        this.setState({slider: slider});
    }

    render() {
        return (
            <div
                id="carouselExampleControls"
                className="carousel slide"
                data-ride="carousel">
                <div className="carousel-inner">
                    {this
                        .state
                        .slider
                        .map((item, index) => {
                            return (
                                <div
                                    key={index}
                                    className={(index == 0)
                                    ? "carousel-item active"
                                    : "carousel-item"}>
                                    <img
                                        className="d-block w-100"
                                        src={'/storage/car_albums/' + item.albums.folder_name + '/' + item.photos[0].file_name}
                                        alt="First slide"/>
                                </div>
                            )
                        })}
                </div>
                <a
                    className="carousel-control-prev"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="prev">
                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span className="sr-only">Previous</span>
                </a>
                <a
                    className="carousel-control-next"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="next">
                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                    <span className="sr-only">Next</span>
                </a>
            </div>
        )
    }
}

const mapPropsToState = (state) => ({cars: state.cars})
export default connect(mapPropsToState, {getAllCars})(Slider);
