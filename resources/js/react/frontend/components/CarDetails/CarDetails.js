import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import {connect} from 'react-redux'
import {getSingleCar} from '../../actions/actions'

import SectionHead from '../SectionHead/SectionHead';
import Breadcrumb from '../Breadcrumb/Breadcrumb'
import styles from './CarDetails.scss'

import Carousel from 'react-image-carousel'

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
        if (this.state.car.id && this.state.car.photos.length > 0 && !this.state.images) {
            let images = [];
            for (let i = 0; i < this.state.car.photos.length; i++) {
                const url = `/storage/car_albums/${this.state.car.albums.folder_name}/${this.state.car.photos[i].file_name}`;
                images.push({original: url, thumbnail: url});
            }
            this.setState({images});
        }
    }

    render() {
        const car = {
            ...this.state.car
        };
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
                {this.state.car.id
                    ? (
                        <div className="container mt-5">
                            <div className="row">
                                <div className="col-md-8">
                                    {/* title row */}
                                    <div className="row">
                                        <div className="col-md-12">
                                            <h2 className={styles.title}>
                                                {car.title
                                                    ? car.title
                                                    : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year)}
                                            </h2>
                                            <h5>{car.subtitle}</h5>
                                        </div>
                                    </div>

                                    {/* image slider row */}
                                    {!!this.state.images && (
                                        <div className="row">
                                            <div className="col-md-12">
                                                <div className="my-carousel">
                                                    <ImageGallery items={this.state.images}/>
                                                </div>
                                            </div>
                                        </div>
                                    )
}
                                </div>
                                <div className="col-md-4">
                                    price and sidebars
                                </div>
                            </div>
                        </div>
                    )
                    : (
                        <div className="container mt-5">
                            <div className="row">
                                <div className="col-md-12">
                                    <h3 className="text-danger text-center">{this.state.error}</h3>
                                </div>
                            </div>
                        </div>
                    )
}
            </section>
        )
    }
}
const mapPropsToState = (state) => ({car: state.cars.singleCar})
export default connect(mapPropsToState, {getSingleCar})(CarDetails);