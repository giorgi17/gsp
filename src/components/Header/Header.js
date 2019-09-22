import React from 'react';
import logo from '../../logo.svg';
import './Header.css';
import {NavLink} from 'react-router-dom';

const header = () => (
    <header className="App-header">
        <div className="logo-container">
          <img src={logo} alt="logo" className="logo" />
        </div>
        <nav>
            <ul className="nav-links">
                <li><NavLink
                    className="nav-link"
                    to="/messages/"
                    exact>  
                    Messages
                    </NavLink>
                </li>
                <li><NavLink
                    className="nav-link"
                    to="/new-message/"
                    exact>  
                    New message
                    </NavLink>
                </li>
                <li><a className="nav-link" href="#">Contact</a></li>
            </ul>
        </nav>
        <div className="login-logout">
            <h4>Login</h4>
        </div>
      </header>
);

export default header;