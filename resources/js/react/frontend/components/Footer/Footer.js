import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import {connect} from 'react-redux'
import {getAllCars, getAllBrands} from '../../actions/actions'

import styles from './Footer.scss'

class Footer extends Component {

    componentWillMount() {
        window.scrollTo(0, 0);
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
        if (this.props.brands.length > 0) {
            this
                .props
                .sortBrandsByName(this.props.brands);
        }
    }

    componentDidUpdate(prevProps) {
        if (prevProps.brands.length !== this.props.brands.length) {
            this
                .props
                .sortBrandsByName(this.props.brands);
        }
    }

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
                                                        className={styles.footer__list__item}
                                                        key={brand.id}>
                                                        <Link
                                                            to={{
                                                            pathname: '/process-search',
                                                            state: {
                                                                filters: {
                                                                    brands_id: brand.id
                                                                },
                                                                cars: [...this.props.cars]
                                                            }
                                                        }}>{brand.brand_name.toUpperCase()}</Link>
                                                    </li>
                                                ))}
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className={styles.categories}>
                                        <h3 className={styles.footer__title}>Categories</h3>
                                        <ul className={styles.footer__list}>
                                            <li className={styles.footer__list__item}>
                                                <Link
                                                    to={{
                                                    pathname: '/process-search',
                                                    state: {
                                                        filters: {
                                                            car_condition: 'new'
                                                        },
                                                        cars: [...this.props.cars]
                                                    }
                                                }}>
                                                    New
                                                </Link>
                                            </li>
                                            <li className={styles.footer__list__item}>
                                                <Link
                                                    to={{
                                                    pathname: '/process-search',
                                                    state: {
                                                        filters: {
                                                            car_condition: 'recondition'
                                                        },
                                                        cars: [...this.props.cars]
                                                    }
                                                }}>
                                                    Recondition
                                                </Link>
                                            </li>
                                            <li className={styles.footer__list__item}>
                                                <Link
                                                    to={{
                                                    pathname: '/process-search',
                                                    state: {
                                                        filters: {
                                                            car_condition: 'used'
                                                        },
                                                        cars: [...this.props.cars]
                                                    }
                                                }}>
                                                    Second-hand
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className={styles.address}>
                                        <h3 className={styles.footer__title}>Contact</h3>
                                        <div className={styles.call_us}>
                                            <span className={styles.call_us__highlighter}>Call us</span>
                                            <span>01719 403 013</span>
                                        </div>
                                        <ul className={styles.contact_details}>
                                            <li className={[styles.contact_details__item, styles.email].join(' ')}>
                                                badhontrading@gmail.com
                                            </li>
                                            <li className={[styles.contact_details__item, styles.location].join(' ')}>
                                                22/A Uttara, R/A, <br />
                                                Dhaka-1230
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
const mapPropsToState = (state) => ({cars: state.cars.cars, brands: state.cars.brands});
export default connect(mapPropsToState, {getAllCars, getAllBrands})(Footer);