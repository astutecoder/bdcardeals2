import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import styles from './CarListItem.scss'

export default class CarListItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            img_folder_name: '',
            img_file_name: ''
        }
    }

    componentDidMount() {
        let folder_name = (this.props.car.albums) ? this.props.car.albums.folder_name : '',
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
        const car = {
            ...this.props.car
        };
        const src = (this.state.img_folder_name) ? `/storage/car_albums/${this.state.img_folder_name}/${this.state.img_file_name}` : '/images/no_car_photo.png';
        const path = `cars/${car.brands.brand_name.split(' ').join('-')}-${car.model_no.split(' ').join('-')}/${car.id}`

        return (
            <div className={styles.carlist__item}>
                <div className="row">
                    <div className="col-sm-4">
                        <div className={styles.image_container}>
                            <img
                            className={styles.image_item}
                            src={src}
                            alt={`${car
                            .brands
                            .brand_name
                            .toUpperCase()} ${car
                            .model_no
                            .toUpperCase()}'s image`}/>
                        </div>
                    </div>
                    <div className="col-sm-8">
                        <div className="row mb-3">
                            <div className="col-md-6">
                                <div className={styles.title__container}>
                                    <h4 className={styles.title}>
                                        <Link to={{
                                            pathname: path,
                                            state:{ car: car}
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
                                <span className={styles.btn__price}>
                                    <strong className={styles.btn__price__main_price}>
                                        ৳{car.price}</strong>
                                    {!!car.offer_price && <small className={styles.btn__price__offer_price}>
                                        ৳{car.offer_price}</small>
}
                                    {!!car.is_negotiable_price && <span className={styles.btn__price__is_negotiable}>Negotiable Price</span>}
                                </span>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-12">
                                <h5>Highlights</h5>
                            </div>

                            <div className="d-none d-md-block">
                                <div className="col-md-12">
                                    <div className="table-responsive-md">
                                        <table className="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span className="text-muted text-capitalize">
                                                            <strong>Mileage:
                                                            </strong>
                                                            {` ${car.mileage}`}</span>
                                                    </td>
                                                    <td>
                                                        <span className="text-muted text-capitalize">
                                                            <strong>Model:
                                                            </strong>
                                                            {` ${car.model_no}`}</span>
                                                    </td>
                                                    <td>
                                                        <span className="text-muted text-capitalize">
                                                            <strong>Transmission:
                                                            </strong>
                                                            {` ${car.transmission}`}</span>
                                                    </td>
                                                    <td>
                                                        <span className="text-muted text-capitalize">
                                                            <strong>Engine:
                                                            </strong>
                                                            {` ${car.engine}`}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div className="col-sm-12 d-md-none d-xs-block ">
                                <div className="row">
                                    <div className="col-sm-12">
                                        <span className="text-muted">Mileage: {car.mileage}</span>
                                    </div>
                                    <div className="col-sm-12">
                                        <span className="text-muted">Model: {car.model_no}</span>
                                    </div>
                                    <div className="col-sm-12">
                                        <span className="text-muted">Transmission: {car.transmission}</span>
                                    </div>
                                    <div className="col-sm-12">
                                        <span className="text-muted">Engine: {car.engine}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        )
    }
}
