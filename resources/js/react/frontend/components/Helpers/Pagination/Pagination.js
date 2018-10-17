import React, { Component } from 'react';
import {NavLink, Link} from 'react-router-dom';

export default class Pagination extends Component {
    getPageLinks = () => {
        let pageLinksLi = [];
        for(let i = 1; i <= this.props.requiredPages; i++){
            pageLinksLi.push(i);
        }

        if(this.props.requiredPages > 10){
            let {page=1} = this.props.extractQuery();
            let fromPageIndex = (pageLinksLi.indexOf(+page) > 4) ? (pageLinksLi.indexOf(+page)-4) : 0;
            let tillPageIndex = ((+page+5) > this.props.requiredPages)? (this.props.requiredPages+1) : (pageLinksLi.indexOf(+page) <= 4 ? 10 :(+page+5));
            
            let pageLinksLiToBeShown = pageLinksLi.slice(fromPageIndex, tillPageIndex);
            
            return pageLinksLiToBeShown;
        }else{
            return pageLinksLi;
        }
    }

    prevLink = () => {
        let {page=1} = this.props.extractQuery();
        return (+page-1)
    }
    nextLink = () => {
        let {page=1} = this.props.extractQuery();
        return (+page+1)
    }

    render() {
        return (
            <div className="w-100">
                <hr/>
                <nav aria-label="Page navigation example">
                    <ul className="pagination pagination-sm justify-content-center custom_pagination">  
                        {(this.props.extractQuery().page && this.props.extractQuery().page > 1) &&
                            <Link to={`/cars?page=1`}>                            
                                <li className="page-item">
                                    <span className="page-link">First</span>
                                </li>
                            </Link>
                        }
                        {(this.props.extractQuery().page && this.props.extractQuery().page > 1) &&
                            <Link to={`/cars?page=${this.prevLink()}`}>                            
                                <li className="page-item">
                                    <span className="page-link"><i className="fa fa-angle-left"></i></span>
                                    <span className="sr-only">Previous</span>
                                </li>
                            </Link>
                        }
                        {this.getPageLinks().map((item, index) => (
                        <NavLink key={index} to={`/cars?page=${item}`}>
                            <li className={ (+this.props.extractQuery().page === item)? "page-item active" : "page-item" }>
                                <span className="page-link">
                                    {item}
                                </span>
                            </li>
                        </NavLink>))}
                        
                        {(this.props.extractQuery().page && this.props.extractQuery().page < this.props.requiredPages) &&
                            <Link to={`/cars?page=${this.nextLink()}`}>                            
                                <li className="page-item">
                                    <span className="page-link"><i className="fa fa-angle-right"></i></span>
                                    <span className="sr-only">Next</span>
                                </li>
                            </Link>
                        }
                        {(this.props.extractQuery().page && this.props.extractQuery().page < this.props.requiredPages) &&
                            <Link to={`/cars?page=${this.props.requiredPages}`}>                            
                                <li className="page-item">
                                    <span className="page-link">Last</span>
                                </li>
                            </Link>
                        }
                    </ul>
                </nav>
            </div>
        )
    }
}
