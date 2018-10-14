import React, {Component} from 'react'

import styles from './CarTableHighlight.scss'

export default class CarTableHighlight extends Component {
    render() {
        const car = {
            ...this.props.car
        }
        return (
            <React.Fragment>
                <div className={(this.props.list_view !== 'hide')? "d-none d-md-block row" : "row"}>
                    <div className="col-md-12">
                        <div className="table-responsive-md">
                            <table className={["table table-bordered", styles.table].join(' ')}>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span className="text-muted text-capitalize">
                                                {/* <strong>Mileage:
                                                </strong> */}
                                                {` ${car.mileage}`}</span>
                                        </td>
                                        <td>
                                            <span className="text-muted text-capitalize">
                                                {/* <strong>Model:
                                                </strong> */}
                                                {` ${car.model_no}`}</span>
                                        </td>
                                        <td>
                                            <span className="text-muted text-capitalize">
                                                {/* <strong>Transmission:
                                                </strong> */}
                                                {` ${car.transmission}`}</span>
                                        </td>
                                        <td>
                                            <span className="text-muted text-capitalize">
                                                {/* <strong>Engine:
                                                </strong> */}
                                                {` ${car.engine}`}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {(this.props.list_view != 'hide') && (
                    <div className="d-md-none d-xs-block row">
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
                )}
            </React.Fragment>
        )
    }
}
