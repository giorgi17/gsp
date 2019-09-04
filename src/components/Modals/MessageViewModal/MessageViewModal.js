import React from 'react';
import './MessageViewModal.css';

const messageViewModal = (props) => {
    return (
        <div id={"ex" + props.arrIndex} className="modal">
            <div id="viewMessageBox">
                <p>{props.message}</p>
            </div>
            <a href="#" rel="modal:close" id="messageViewClose">Close</a>
        </div>
    );
}

export default messageViewModal;