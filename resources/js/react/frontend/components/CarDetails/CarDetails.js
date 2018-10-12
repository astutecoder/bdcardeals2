import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import {connect} from 'react-redux'
import {getSingleCar} from '../../actions/actions'

import SectionHead from '../SectionHead/SectionHead';
import Breadcrumb from '../Breadcrumb/Breadcrumb'
import styles from './CarDetails.scss'

class CarDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            error: '',
            car: {}
        }
    }
    componentDidMount() {
        const car_id = this.props.match.params.id;

        if (!this.props.location.state) {
            this
                .props
                .getSingleCar(car_id);
        } else {
            console.log('else')
            this.setState({
                car: {
                    ...this.props.location.state.car
                }
            })
        }
    }

    componentDidUpdate(prevProps, prevState) {
        if (!!this.props.car.error && this.state.error !== this.props.car.error) {
            this.setState({error: this.props.car.error})
        }
        if (prevProps.car.id !== this.props.car.id) {
            this.setState({
                car: {
                    ...this.props.car
                }
            });
        }
    }

    render() {
        const breadcrumb_links = [
            {
                pathname: '/cars',
                linkname: 'Cars'
            }, {
                linkname: 'Car Details'
            }
        ];
        return (
            <section>
                <SectionHead title="Car Details"/>
                <Breadcrumb links={breadcrumb_links}/> {/* If no data found */}
                {this.state.error && (
                    <div className="container mt-3">
                        <div className="row">
                            <div className="col-md-12">
                                <h3 className="text-danger text-center">{this.state.error}</h3>
                            </div>
                        </div>
                    </div>
                )
}
                {/* If data retrive was  */}
                <div className="container mt-3">
                    <div className="row">
                        <div className="col-md-8">
                            details goes here
                        </div>
                        <div className="col-md-4">
                            price and sidebars
                        </div>
                    </div>
                </div>
            </section>
        )
    }
}
const mapPropsToState = (state) => ({car: state.cars.singleCar})
export default connect(mapPropsToState, {getSingleCar})(CarDetails);