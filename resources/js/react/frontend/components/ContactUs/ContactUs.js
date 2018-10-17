import React, {Component} from 'react'
import Axios from 'axios'

import SectionHead from '../SectionHead/SectionHead';
import styles from './ContactUs.scss'

export default class ContactUs extends Component {

    constructor(props){
        super(props);
        this.state = {
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: '',
            errors: {}
        }
    }

    handleInput = (e) => {
        const element = e.currentTarget.id;
        const val = e.currentTarget.value;
        const newObj = {};

        newObj[element] = val;
        this.setState({
            ...newObj
        })
    }

    handleSubmit = (e) => {
        e.preventDefault();
        Axios.post('/api/v1/contact-us', {
            name: this.state.name,
            email: this.state.email,
            phone: this.state.phone,
            subject: this.state.subject,
            message: this.state.message,
        })
        .then(response => {
            this.setState({
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: '',
                errors: {}
            })
        })
        .catch(err => {
            if(err.response.status === 422){
                this.setState({errors: {
                    ...err.response.data.errors
                }})
            }
        })
    }

    render() {
        return (
            <React.Fragment>
                <SectionHead title="Contact Us"/>
                <section className="section-wrapper">
                    <div className="container">
                        <div className="row">
                            <div className="col-md-6">
                                <span className={styles.get_in_touch}>Get in Touch</span>
                                <h2 className={styles.title}>Send us message</h2>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-12">
                                <form>
                                    <div className="row">
                                        <div className="form-group col-md-6">
                                            <label htmlFor="name">Name</label>
                                            <input
                                                type="text"
                                                className={["form-control", (this.state.errors.name)? styles.has_errors: ''].join(' ')}
                                                id="name"
                                                value={this.state.name}
                                                onChange={this.handleInput}
                                                placeholder="Your name"/>
                                        </div>
                                        
                                        <div className="form-group col-md-6">
                                            <label htmlFor="email">Email</label>
                                            <input
                                                type="email"
                                                className={["form-control", (this.state.errors.email)? styles.has_errors: ''].join(' ')}
                                                id="email"
                                                value={this.state.email}
                                                onChange={this.handleInput}
                                                aria-describedby="emailHelp"
                                                placeholder="Enter email"/>
                                            <small id="emailHelp" className="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>

                                        <div className="form-group col-md-6">
                                            <label htmlFor="phone">Phone</label>
                                            <input
                                                type="text"
                                                className={["form-control", (this.state.errors.phone)? styles.has_errors: ''].join(' ')}
                                                id="phone"
                                                value={this.state.phone}
                                                onChange={this.handleInput}
                                                placeholder="phone number"/>
                                        </div>

                                        <div className="form-group col-md-6">
                                            <label htmlFor="subject">Subject</label>
                                            <input
                                                type="text"
                                                className={["form-control", (this.state.errors.subject)? styles.has_errors: ''].join(' ')}
                                                id="subject"
                                                value={this.state.subject}
                                                onChange={this.handleInput}
                                                placeholder="Subject"/>
                                        </div>

                                        <div className="form-group col-md-6">
                                            <label htmlFor="subject">Message</label>
                                            <textarea
                                                className={["form-control", (this.state.errors.message)? styles.has_errors: ''].join(' ')}
                                                id="message"
                                                value={this.state.message}
                                                onChange={this.handleInput}
                                                placeholder="Message"/>
                                        </div>
                                    </div>
                                    <button type="submit" className="btn btn-primary" onClick={this.handleSubmit}>Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </React.Fragment>
        )
    }
}
