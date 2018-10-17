import React, {Component} from 'react'
import styles from './Notification.scss'

export default class Notification extends Component {
    render() {
        return (
            <div
                className={[
                styles.notification,
                (this.props.slide && this.props.slide.toLowerCase() === 'in')
                    ? styles.slideIn
                    : styles.slideOut
            ].join(' ')}>
                {this.props.success && (
                    <div
                        className={[styles.notification__success, "d-flex justify-content-center align-items-center"].join(' ')}>
                        <i className="fa fa-2x fa-check"></i>
                        <span>
                            {this.props.success}
                        </span>
                    </div>
                )}
                {this.props.failed && (
                    <div
                        className={[styles.notification__failed, "d-flex justify-content-center align-items-center"].join(' ')}>
                        <i className="fa fa-2x fa-exclamation-triangle"></i>
                        <span>{this.props.failed}</span>
                    </div>
                )}
            </div>
        )
    }
}
