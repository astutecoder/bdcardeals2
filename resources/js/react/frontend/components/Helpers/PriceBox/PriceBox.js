import React, {Component} from 'react'
import wNumb from 'wnumb'

import styles from './PriceBox.scss'

export default class PriceBox extends Component {
    render() {
        const cFormat = wNumb({thousand:',', prefix: '৳'});
        const car = {...this.props.car};
        return (
            <span className={styles.btn__price}>
                <strong className={styles.btn__price__main_price}>
                    {cFormat.to(car.price)}</strong>
                {!!car.offer_price && <small className={styles.btn__price__offer_price}>
                    {cFormat.to(car.offer_price)}</small>
}
                {(this.props.show_negotiable && !!car.is_negotiable_price) && <span className={styles.btn__price__is_negotiable}>Negotiable Price</span>}
            </span>
        )
    }
}
