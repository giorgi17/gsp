import React from 'react';
import NewMessage from '../../containers/NewMessage/NewMessage';
import './NewMessagePage.css';

const NewMessagePage = (props) => (
    <section className="new-message">
        <NewMessage history={{...props.history}}></NewMessage>
    </section>
);

export default NewMessagePage;