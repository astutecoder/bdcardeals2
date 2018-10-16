import React, { Component } from 'react'

import styles from './Footer.scss'

export default class Footer extends Component {
  render() {
    return (
      <footer className={["section-wrapper", styles.footer__container].join(' ')}>
        <div className="container">
            <div className="row">
                <div className="col-md-3">logo</div>
                <div className="col-md-3">top brand</div>
                <div className="col-md-3">category</div>
                <div className="col-md-3">address</div>
            </div>
        </div>    
      </footer>
    )
  }
}
