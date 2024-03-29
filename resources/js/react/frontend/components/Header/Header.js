import React, {Component} from 'react'
import {NavLink} from 'react-router-dom'

import styles from './Header.scss'

export default class Header extends Component {
    render() {
        return (
            <header className={styles.headerContainer}>
                <div className={styles.header}>
                    <div className={styles.header__logo}>
                        <NavLink to='/'>
                            <img src={`${this.props.baseURL}images/bd_car_deals_logo.png`} alt="BD Car Deals Logo"/>
                        </NavLink>
                    </div>
                    <nav className={styles.header__navContainer}>
                        <ul className={styles.header__nav}>
                            <li className={styles.header__nav__listItem}>
                                <NavLink to='/' exact activeClassName={styles.active}>Home</NavLink>
                            </li>
                            <li className={styles.header__nav__listItem}>
                                <NavLink to='/cars' activeClassName={styles.active}>Cars</NavLink>
                            </li>
                            <li className={styles.header__nav__listItem}>
                                <NavLink to='/contact-us' activeClassName={styles.active}>Contact Us</NavLink>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
        )
    }
}
