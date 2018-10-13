import React, {Component} from 'react'
import nl2br from 'react-newline-to-break'

import styles from './ExtraDetails.scss'

export default class ExtraDetails extends Component {
    addActiveClassToTab = (e) => {
        const element = e.currentTarget;
        const prevActive = document.querySelector(`.${styles.active}`);
        
        prevActive.classList.remove(styles.active);
        element.classList.add(styles.active);
    }

    render() {
        const car = {...this.props.car}
        return (
            <div className="row">
                <div className={["col-md-12", styles.tab_panel].join(' ')}>
                    <hr/>
                    <ul
                        className={["nav nav-tabs", styles.tab_panel__list].join(' ')}
                        role="tablist">
                        {car.features && (
                            <li className="nav-item">
                                <a
                                    className={["nav-link active", styles.active].join(' ')}
                                    id="features-tab"
                                    data-toggle="tab"
                                    href="#features"
                                    role="tab"
                                    aria-controls="features"
                                    aria-selected="true"
                                    onClick={this.addActiveClassToTab}>Features</a>
                            </li>
                        )}
                        {car.safety && (
                            <li className="nav-item">
                                <a
                                    className="nav-link"
                                    id="safety-tab"
                                    data-toggle="tab"
                                    href="#safety"
                                    role="tab"
                                    aria-controls="safety"
                                    aria-selected="false"
                                    onClick={this.addActiveClassToTab}>Safety</a>
                            </li>
                        )}
                        {car.comfort && (
                            <li className="nav-item">
                                <a
                                    className="nav-link"
                                    id="comfort-tab"
                                    data-toggle="tab"
                                    href="#comfort"
                                    role="tab"
                                    aria-controls="comfort"
                                    aria-selected="false"
                                    onClick={this.addActiveClassToTab}>Comfort</a>
                            </li>
                        )}
                    </ul>
                    <div
                        className={["tab-content", styles.tab_panel__body].join(' ')}
                        id="myTabContent">
                        <div
                            className="tab-pane fade show active"
                            id="features"
                            role="tabpanel"
                            aria-labelledby="features-tab">
                            <p>{nl2br(car.features)}</p>
                        </div>
                        <div
                            className="tab-pane fade"
                            id="safety"
                            role="tabpanel"
                            aria-labelledby="safety-tab">
                            <p>{car.safety}</p>
                        </div>
                        <div
                            className="tab-pane fade"
                            id="comfort"
                            role="tabpanel"
                            aria-labelledby="comfort-tab">
                            <p>{car.comfort}</p>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
