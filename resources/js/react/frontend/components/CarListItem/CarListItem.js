import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import styles from './CarListItem.scss'
import wNumb from 'wnumb'
import PriceBox from '../Helpers/PriceBox/PriceBox';
import CarTableHighlight from '../Helpers/CarTableHighlight/CarTableHighlight';

export default class CarListItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            img_folder_name: '',
            img_file_name: ''
        }
    }

    componentDidMount() {
        let folder_name = (this.props.car.albums)
                ? this.props.car.albums.folder_name
                : '',
            file_name = '';
        this
            .props
            .car
            .photos
            .map(photo => {
                if (photo.is_featured == 1) {
                    return file_name = photo.file_name;
                }
            });

        this.setState({img_folder_name: folder_name});
        this.setState({img_file_name: file_name});
    }

    render() {
        const cFormat = wNumb({thousand: ',', prefix: '৳'});
        const car = {
            ...this.props.car
        };
        const src = (this.state.img_folder_name)
            ? `${this.props.baseURL}storage_image/car_albums/${this.state.img_folder_name}/${this.state.img_file_name}`
            : `${this.props.baseURL}images/no_car_photo.png`;
        const path = `/cars/${car
            .brands
            .brand_name
            .split(' ')
            .join('-')}-${car
            .model_no
            .split(' ')
            .join('-')}/${car
            .id}`

        return (
            <div className={styles.carlist__item}>
                <div className="row">
                    <div className="col-sm-4">
                        <div className={styles.image_container}>
                            <Link
                                to={{
                                pathname: path,
                                state: {
                                    car: car,
                                    cars: [...this.props.cars]
                                }
                            }}>
                                <img
                                    className={styles.image_item}
                                    src={src}
                                    alt={`${car
                                    .brands
                                    .brand_name
                                    .toUpperCase()} ${car
                                    .model_no
                                    .toUpperCase()}'s image`}/>
                            </Link>

                        </div>
                    </div>
                    <div className="col-sm-8">
                        <div className="row mb-3">
                            <div className="col-md-6">
                                <div className={styles.title__container}>
                                    <h4 className={styles.title}>
                                        <Link
                                            to={{
                                            pathname: path,
                                            state: {
                                                car: car,
                                                cars: [...this.props.cars]
                                            }
                                        }}>
                                            {(car.title)
                                                ? car.title
                                                : (car.brands.brand_name + ' ' + car.model_no + ' ' + car.year)}
                                        </Link>
                                    </h4>
                                    {car.subtitle && <p className={[styles.subtitle, "text-muted"].join(' ')}>{car.subtitle}</p>
}
                                </div>
                            </div>
                            <div className="col-md-6 text-md-right">
                                <PriceBox car={car} show_negotiable={true}/>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-12">
                                <h5>Highlights</h5>
                            </div>
                            <div className="col-md-12">
                                <CarTableHighlight car={car}/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        )
    }
}
