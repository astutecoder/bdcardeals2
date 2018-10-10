import React, { Component } from 'react'
import SectionHead from '../SectionHead/SectionHead';

import styles from './Cars.scss'
import { Link } from 'react-router-dom';

export default class Cars extends Component {
  componentDidMount(){
    console.log(this.props.location.state);
  }
  render() {
    return (
      <section>
        <SectionHead title="Cars list" />
        <div className={styles.breadcrumb__container}>
          <ul className={styles.breadcrumb__lsit}>
            <li className={styles.breadcrumb__item}>
              <Link to='/'><i className="fa fa-home"></i></Link>
            </li>
            <li className={styles.breadcrumb__item}>Car List</li>
          </ul>
        </div>
        <div>Car List</div>        
      </section>
    )
  }
}
