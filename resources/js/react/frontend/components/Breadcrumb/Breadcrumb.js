import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import styles from './Breadcrumb.scss'

export default class Breadcrumb extends Component {
    render() {
        return (
            <div className={styles.breadcrumb__container}>
                <ul className={styles.breadcrumb__lsit}>
                    <li className={styles.breadcrumb__item}>
                        <Link to='/'>
                            <i className="fa fa-home"></i>
                        </Link>
                    </li>
                    {this
                        .props
                        .links
                        .map((link, i) => 
                            (
                                <li className={styles.breadcrumb__item} key={i}>
                                    {link.pathname
                                        ? (
                                            <Link
                                                to={{
                                                pathname: link.pathname
                                            }}>
                                                {link.linkname}
                                            </Link>
                                        )
                                        : (link.linkname)
}
                                </li>
                            )
                        )}
                </ul>
            </div>
        )
    }
}
