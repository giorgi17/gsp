import React from 'react';
import './Message.css';
import messageIcon from '../../assets/images/messageIcon.svg';
import socialMediaIcon from '../../assets/images/socialMediaIcon.svg';
import viewerIcon from '../../assets/images/viewerIcon.svg';
import eyeIcon from '../../assets/images/eyeIcon.svg';
import MessageViewModal from '../Modals/MessageViewModal/MessageViewModal';

const Message = (props) => (
    <div className="message">
        <div className="receiver">
            <img src={messageIcon} className="messageIcon" alt="receiver" />
            <span className="message-data-name">receiver: </span>{props.receiver}
        </div>

        <div className="social-media-type">
            <img src={socialMediaIcon} className="socialMediaIcon" alt="social-media-type" />
            <span className="message-data-name">social media type: </span>{props.social_media_type}
        </div>

        <div className="viewers">
            <img src={viewerIcon} className="viewerIcon" alt="viewerIcon" />
            <span className="message-data-name">viewers: </span>{props.viewers}
        </div>
        <MessageViewModal message={props.message} arrIndex={props.arrIndex}></MessageViewModal>
        <a href={"#ex" + props.arrIndex} rel="modal:open" id="viewLink" >
            <div className="view" onClick={() => props.clickHandler(props.message_id, props.arrIndex)}>
                <img src={eyeIcon} className="viewIcon" alt="viewMessage" />
                <span className="message-data-name">view</span>
            </div>
        </a>
    </div>
);

export default Message;