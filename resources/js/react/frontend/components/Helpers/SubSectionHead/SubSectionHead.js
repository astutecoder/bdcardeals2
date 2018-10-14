import React, {Component} from 'react'

import styles from './SubSectionHead.scss'

export default class SubSectionHead extends Component {
    render() {
        return (
            <div className="col-md-12 mt-5">
                <h3 className={styles.subsection_head}>{this.props.title}</h3>
                <div className={styles.subsection_head_decor}></div>
            </div>
        )
    }
}
