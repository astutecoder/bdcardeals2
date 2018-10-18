import React, {Component} from 'react'

import styles from './SectionHead.scss'

export default class SectionHead extends Component {
    componentDidMount() {
        this.findTopMargin();
    }
    findTopMargin = () => {
        setTimeout(function () {
            const header = document.querySelector('header');
            const sectionHead = document.querySelector(`.${styles.sectionhead__container}`);
            const headerHeight = header.offsetHeight;
            
            sectionHead.style.marginTop = (headerHeight < 81) ? '81px' : headerHeight+ 'px';
        }, 100);

    }
    render() {
        return (
            <div className={styles.sectionhead__container}>
                <h3 className={styles.sectionhead__title}>{this.props.title}</h3>
            </div>
        )
    }
}
