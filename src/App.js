import React from 'react';
import Header from './components/Header/Header';
import './App.css';
import {Route} from 'react-router-dom';
import AllMessagesPage from './pages/AllMessagesPage/AllMessagesPage';
import NewMessagePage from './pages/NewMessagePage/NewMessagePage';


function App() {
  return (
    <div className="App">
      
      {/* <NavLink
        to="/go/"
        exact>  
          <h1 href="">go</h1>
        </NavLink> */}
        <Header />
        <main>
          <Route path="/messages/" component={AllMessagesPage} />
          <Route path="/new-message/" component={NewMessagePage} />
        </main>
    </div>
  );
}

export default App;
