import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

import styles from './Edit.scss';

export default class AlbumEdit extends Component {
    constructor(props) {
        super(props);
        this.state = {
            modal: {
                show: false,
                item: ''
            },
            car_id: '',
            cover_image: {
                id: '',
                album_id: '',
                folder_name: '',
                file_name: '',
            },
            images: [], //except featured
        }
    }

    componentDidMount() {
        this.setState({
            car_id: this.getCarId()
        });
        // console.log('did mount',this.state)
    }

    componentDidUpdate(prevProps, prevState) {
        if ((prevState.images.length !== this.state.images.length)
            ||
            prevState.car_id !== this.state.car_id
            ||
            prevState.cover_image.id !== this.state.cover_image.id
        ) {
            this.getAllPhotos(this.state.car_id)
        }
        if (prevState !== this.state) {
            console.log(this.state);
        }
    }

    getCarId = () => {
        const path = window.location.pathname;
        return path.slice().split('/').pop();
    }

    getAllPhotos = (car_id) => {
        axios.get('/api/v1/album/all-photos/' + car_id)
            .then(response => {
                this.setState({
                    images: [...response.data]
                }); // setState() for album and images;

                for (let key = 0; key < response.data.length; key++) {
                    if (response.data[key]["is_featured"] !== 1) {
                        continue;
                    }
                    this.setState({
                        cover_image: {
                            ...this.state.cover_image,
                            id: response.data[key].id,
                            album_id: response.data[key].albums.id,
                            folder_name: response.data[key].albums.folder_name,
                            file_name: response.data[key].file_name
                        }
                    });
                    break;
                }
            })
            .catch(error => console.dir(error));
    }

    openModal = (image_id = null) => {
        this.setState({
            modal: {
                ...this.state.modal,
                show: !this.state.modal.show,
                item: image_id
            }
        });
    }

    handleAddImage = () => {
        const files = $('#file')[0].files,
            formData = new FormData();
        console.log('files', files);
        for(let i = 0; i < files.length; i++){
            formData.append('image-'+i, files[i])
        }
        formData.append('car_id', this.state.car_id);
        formData.append('album_id', this.state.cover_image.album_id);
        formData.append('folder_name', this.state.cover_image.folder_name);
        formData.append('total_image', files.length);

        axios.post('/api/v1/album/append-image', formData, {
            headers:{
                Authorization: 'Bearer 03ArWRckJh22ltDgRl6tPdjSpRDMeQHC9pozMWJOay2VwG6Wa3qeQyPPcqCN'
            }
        })
            .then(response => {
                if (response.data){
                    this.getAllPhotos(this.state.car_id)
                }
            })
            .catch(error => console.dir(error));

    }
    handleSelectImages = () => {
        $('#file').click();
    }

    handleDeleteImage = (image_id) => {
        axios.post('/api/v1/album/delete-image', {image_id, folder_name: this.state.cover_image.folder_name}, {
            headers: {
                Authorization: 'Bearer 03ArWRckJh22ltDgRl6tPdjSpRDMeQHC9pozMWJOay2VwG6Wa3qeQyPPcqCN'
            }
        })
            .then(response => {
                if (response.data) {
                    this.openModal();
                    this.getAllPhotos();
                }
            })
            .catch(error => console.dir(error))
    }
    handleMakeCoverImage = (image_id, car_id) => {
        axios.post('/api/v1/album/change-cover', {image_id, car_id}, {
            headers: {
                'Authorization': 'Bearer 03ArWRckJh22ltDgRl6tPdjSpRDMeQHC9pozMWJOay2VwG6Wa3qeQyPPcqCN',
            }
        })
            .then(response => {
                if (response.data) {
                    this.getAllPhotos(car_id);
                }
            })
            .catch(error => console.dir(error))
    }

    render() {
        return (
            <div>
                <div className="row">
                    <div className="col-md-12">
                        <h4 className="title">Cover Image</h4>
                        <div className={styles["Cover-image"]}>
                            {!!(this.state.cover_image.id) ?
                                <img
                                    src={`/storage/car_albums/${this.state.cover_image.folder_name}/${this.state.cover_image.file_name}`}
                                    alt={this.state.cover_image.file_name}/>
                                : ''
                            }
                        </div>
                    </div>
                </div>

                <hr className="seperator"/>

                <div className="row">
                    <div className="col-xs-6">
                        <h4 className="title mt-md mb-md">All Images</h4>
                    </div>
                    <div className="col-xs-6">
                        <a id="addToTable" className="btn btn-success pull-right" onClick={this.handleSelectImages}>
                            Add <i className="fa fa-plus"></i>
                        </a>
                        <form action="" encType="multipart/form-data">
                            <input type="file" id="file" className={styles.file} multiple onChange={this.handleAddImage} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-12">
                        <div className={styles["Card-columns"]}>
                            {this.state.images.map((image, index) => {
                                if (image.is_featured == 1) {
                                    return
                                }
                                return (
                                    <div className={styles["Card-container"]} key={index}>
                                        <div className={styles.Card}>
                                            <div className={styles["Card-img-top"]}>
                                                <img
                                                    src={`/storage/car_albums/${image.albums.folder_name}/${image.file_name}`}
                                                    alt=""/>
                                            </div>

                                            <div className={styles["Card-action"]}>
                                                <a className='text-info'
                                                   onClick={() => this.handleMakeCoverImage(image.id, image.cars_id)}>Make
                                                    Cover</a>
                                                <a className='text-danger'
                                                   onClick={() => this.openModal(image.id)}>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                )
                            })}
                        </div>
                    </div>
                </div>

                {this.state.modal.show &&

                <div className="mfp-wrap mfp-auto-cursor mfp-ready" tabIndex="-1" style={{"overflow": "hidden auto"}}>
                    <div className="mfp-container mfp-inline-holder">
                        <div className="mfp-content">
                            <div id="modalPrimary" className="modal-block modal-block-primary">
                                <section className="panel">
                                    <header className="panel-heading">
                                        <h2 className="panel-title">Are you sure?</h2>
                                    </header>
                                    <div className="panel-body">
                                        <div className="modal-wrapper">
                                            <div className="modal-icon">
                                                <i className="fa fa-question-circle"></i>
                                            </div>
                                            <div className="modal-text">
                                                <h4>Primary</h4>
                                                <p>Are you sure that you want to delete this image?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <footer className="panel-footer">
                                        <div className="row">
                                            <div className="col-md-12 text-right">
                                                <button className="btn btn-primary modal-confirm"
                                                        onClick={() => this.handleDeleteImage(this.state.modal.item)}>
                                                    Confirm
                                                </button>
                                                <button className="btn btn-default modal-dismiss"
                                                        onClick={() => this.openModal()}>Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </footer>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                }

            </div>
        );
    }
}
ReactDOM.render(<AlbumEdit/>, document.getElementById("album_edit"));
