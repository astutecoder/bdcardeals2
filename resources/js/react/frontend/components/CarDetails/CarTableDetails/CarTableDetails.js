import React, {Component} from 'react'

import styles from './CarTableDetails.scss'
import wNumb from 'wnumb'

export default class CarTableDetails extends Component {
    render() {
        const cFormat = wNumb({thousand: ',', prefix: '৳'});
        const car = {
            ...this.props.car
        }
        return (
            <div className="row">
                <div className="col-md-12">
                    <div className={styles.price_wrap}>
                        <span className={styles.price__main}>{cFormat.to(car.price)}</span>
                        {car.offer_price && (
                            <span className={styles.price__offer}>{cFormat.to(car.offer_price)}</span>
                        )}
                    </div>
                    <div className={styles.car_info}>
                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Status</span>
                            <span className={styles.car_info__data}>{car.car_condition}</span>
                        </div>
                        
                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Type</span>
                            <span className={styles.car_info__data}>{car.body_types.body_type}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Year</span>
                            <span className={styles.car_info__data}>{car.year}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Mileage</span>
                            <span className={styles.car_info__data}>{car.mileage}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Engine</span>
                            <span className={styles.car_info__data}>{car.engine}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Transmission</span>
                            <span className={styles.car_info__data}>{car.transmission}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Fuel</span>
                            <span className={styles.car_info__data}>{car.fuel_types[0].fuel_type}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>{car.colors.length > 1
                                    ? 'Colors'
                                    : 'Color'}</span>
                            <span className={styles.car_info__data}>{car
                                    .colors
                                    .map((color, i) => {
                                        if (car.colors.length !== (i + 1)) {
                                            return (
                                                <span key={i}>{`${color.color_name}, `}</span>
                                            )
                                        } else {
                                            return (
                                                <span key={i}>{color.color_name}</span>
                                            )
                                        }
                                    })}</span>
                        </div>

                        {car.doors && (
                            <div className={styles.car_info__item}>
                                <span className={styles.car_info__title}>Doors</span>
                                <span className={styles.car_info__data}>{car.doors}</span>
                            </div>
                        )}

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>Negotiable</span>
                            <span className={styles.car_info__data}>{car.is_negotiable_price
                                    ? 'Yes'
                                    : 'No'}</span>
                        </div>

                        <div className={styles.car_info__item}>
                            <span className={styles.car_info__title}>SCODE#</span>
                            <span className={styles.car_info__data}>{car
                                    .sources
                                    .source_code
                                    .toUpperCase()}</span>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
