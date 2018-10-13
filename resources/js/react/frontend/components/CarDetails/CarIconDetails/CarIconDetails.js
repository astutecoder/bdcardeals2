import React, {Component} from 'react'
import Octicon, {getIconByName} from '@githubprimer/octicons-react'

import styles from './CarIconDetails.scss'

export default class CarIconDetails extends Component {
    render() {
       const car = {...this.props.car}
        return (
            <div className="row">
                <div className="col-md-12">
                    <hr/>
                    <div className={styles.icon_info__container}>
                        <div className={["d-flex flex-column", styles.icon_info__wrap].join(' ')}>
                            <div className={styles.icon_info__head}>Status</div>
                            <div className={styles.icon_info__details}>
                                <span className={styles['icon_info__details-icon']}>
                                    {/* <i className="fa fa-car"></i> */}
                                    <i><Octicon icon={getIconByName('pulse')} verticalAlign='middle' size='small'/></i>
                                </span>
                                <span>{(car.car_condition)? car.car_condition : 'N/A'}</span>
                            </div>
                        </div>

                        <div className={["d-flex flex-column", styles.icon_info__wrap].join(' ')}>
                            <div className={styles.icon_info__head}>Mileage</div>
                            <div className={styles.icon_info__details}>
                                <span className={styles['icon_info__details-icon']}>
                                    {/* <i className="fa fa-dashboard"></i> */}
                                    <i><Octicon icon={getIconByName('dashboard')} verticalAlign='middle' size='small'/></i>
                                </span>
                                <span>{(car.mileage)? car.mileage : 'N/A'}</span>
                            </div>
                        </div>

                        <div className={["d-flex flex-column", styles.icon_info__wrap].join(' ')}>
                            <div className={styles.icon_info__head}>Transmission</div>
                            <div className={styles.icon_info__details}>
                                <span className={styles['icon_info__details-icon']}>
                                    {/* <i className="fa fa-unsorted"></i> */}
                                    <i><Octicon icon={getIconByName('settings')} verticalAlign='middle' size='small'/></i>
                                </span>
                                <span>{(car.transmission)? car.transmission : 'N/A'}</span>
                            </div>
                        </div>

                        <div className={["d-flex flex-column", styles.icon_info__wrap].join(' ')}>
                            <div className={styles.icon_info__head}>Fuel</div>
                            <div className={styles.icon_info__details}>
                                <span className={styles['icon_info__details-icon']}>
                                    {/* <i className="glyphicon glyphicon-fire"></i> */}
                                    <i><Octicon icon={getIconByName('flame')} verticalAlign='middle' size='small'/></i>
                                </span>
                                <span>{(car.fuel_types[0].fuel_type)? car.fuel_types[0].fuel_type : 'N/A'}</span>
                            </div>
                        </div>

                        <div className={["d-flex flex-column", styles.icon_info__wrap].join(' ')}>
                            <div className={styles.icon_info__head}>Year</div>
                            <div className={styles.icon_info__details}>
                                <span className={styles['icon_info__details-icon']}>
                                    {/* <i className="fa fa-flag"></i> */}
                                    <i><Octicon icon={getIconByName('calendar')} verticalAlign='middle' size='small'/></i>
                                </span>
                                <span>{(car.year)? car.year : 'N/A'}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
