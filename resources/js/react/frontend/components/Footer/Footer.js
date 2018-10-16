import React, {Component} from 'react'

import styles from './Footer.scss'

export default class Footer extends Component {
    render() {
        return (
            <footer className={["section-wrapper", styles.footer__container].join(' ')}>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-3 d-flex justify-content-between align-items-center">
                            <div className={styles.logo}>
                                <img
                                    className={styles.logo__img}
                                    src="/images/bd_car_deals_logo_BW.png"
                                    alt="BD Car Deals Logo"/>
                            </div>
                        </div>
                        <div className="col-lg-9">
                            <div className="row">
                                <div className="col-sm-4">
                                    <div className={styles.top_brands}>
                                        <h3 className={styles.footer__title}>Top brands</h3>
                                        <ul className={styles.footer__list}>
                                            {this
                                                .props
                                                .top_brands
                                                .map(brand => (
                                                    <li
                                                        className={[styles.footer__list__item, "text-uppercase"].join(' ')}
                                                        onClick={() => this.props.handleTopMakers(brand.id)}
                                                        key={brand.id}>
                                                        {brand.brand_name}
                                                    </li>
                                                ))}
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className={styles.categories}>
                                        <h3 className={styles.footer__title}>Categories</h3>
                                        <ul className={styles.footer__list}>
                                            <li className={styles.footer__list__item}>New</li>
                                            <li className={styles.footer__list__item}>Recondition</li>
                                            <li className={styles.footer__list__item}>Second-hand</li>
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className={styles.address}>
                                        <h3 className={styles.footer__title}>Contact</h3>
                                        <div className={styles.call_us}>
                                            <span className={styles.call_us__highlighter}>Call us </span>
                                            <span>01719 403 013</span>
                                        </div>
                                        <ul className={styles.contact_details}>
                                            <li className={[styles.contact_details__item, styles.email].join(' ')}>
                                                badhontrading@gmail.com
                                            </li>
                                            <li className={[styles.contact_details__item, styles.location].join(' ')}>
                                                22/a uttara, r/a, dhaka-1230
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        )
    }
}
