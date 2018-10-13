import React, {Component} from 'react'
import {connect} from 'react-redux'
import {getSingleCar} from '../../actions/actions'
import ImageGallery from 'react-image-gallery'

import SectionHead from '../SectionHead/SectionHead';
import Breadcrumb from '../Breadcrumb/Breadcrumb'
import ExtraDetails from './ExtraDetails/ExtraDetails';
import CarIconDetails from './CarIconDetails/CarIconDetails';
import CarTableDetails from './CarTableDetails/CarTableDetails';

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
        window.scrollTo(0, 0);
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
                                <div className="col-lg-8">
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

                                    <div className="row">
                                        <div className="col-md-12">
                                            <hr/>
                                            <div className="my-carousel">
                                                {!!this.state.images
                                                    ? (<ImageGallery
                                                        items={this.state.images}
                                                        autoPlay={true}
                                                        lazyLoad={true}
                                                        slideInterval={5000}
                                                        disableSwipe={true}
                                                        showFullscreenButton={false}
                                                        showPlayButton={false}/>)
                                                    : (<ImageGallery
                                                        items={[{
                                                            original: '/images/no_car_photo.png'
                                                        }
                                                    ]}
                                                        showThumbnails={false}
                                                        disableSwipe={true}
                                                        showFullscreenButton={false}
                                                        showPlayButton={false}/>)
}
                                            </div>
                                        </div>
                                    </div>
                                    {/* end of image slider row*/}

                                    <CarIconDetails car={car}/> {(car.features || car.safety || car.comfort) && (<ExtraDetails car={car}/>)
}
                                </div>{/* end of left col */}
                                <div className="col-lg-4">
                                    <CarTableDetails car={car} />
                                </div>{/* end of right col */}
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