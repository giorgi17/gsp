import React from 'react';
import './NewMessage.css';
import API from '../../utils/API';
import {Redirect} from 'react-router';

class NewMessage extends React.Component {
    constructor() {
        super();
    }
    
    state = {
        receiver: '',
        message: '',
        socialMediaType: ''
    }

    componentDidUpdate(){
        console.log("IT WAS UPDATED!");
    }
    componentDidMount() {
    
    }
    
    handleSubmit = (event) => {
        console.log("submitted");
        event.preventDefault();
        const headers = {
            'Content-Type': 'application/json'
          }
            API.post("/message/create.php", {
                    "message": this.state.message,
                    "receiver": this.state.receiver,
                    "social_media_type": this.state.socialMediaType,
                    "viewers": 0
                },{
                    headers: headers
                }).then(response => {
                    console.log(response);
                    this.props.history.push('/messages');
                }).catch( error => {
                    console.log(error);
                });
    }

    handleChange = (event) => {
        const target = event.target;
        this.setState({
            [target.name]: target.value
        });
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit} id="new-message-form">
                <label htmlFor="receiver">Receiver: </label>
                <input type="text" name="receiver" value={this.state.receiver} onChange={this.handleChange} /><br /><br /><br />

                <label htmlFor="message">Message: </label>
                <textarea name="message" value={this.state.message} onChange={this.handleChange} rows="10" cols="50" /><br /><br /><br />
               
                <label htmlFor="socialMediaType">Social Media Type: 	&nbsp;&nbsp;&nbsp;</label>
                <input type="radio" name="socialMediaType" value="facebook" onChange={this.handleChange} /> Facebook &nbsp;&nbsp;
                <input type="radio" name="socialMediaType" value="instagram" onChange={this.handleChange} /> Instagram <br /><br />
                <input type="submit" value="Submit" id="new-message-submit-button" />
            </form>
        );
    }
}

export default NewMessage;