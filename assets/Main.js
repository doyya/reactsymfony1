

import React from 'react'
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";

import AddUser from "./User/AddUser"
import ListeUser from "./User/ListUser"
import ListeUser1 from "./User/ListUser1"
import Sidebar from "./components/Sidebar"
import Home from "./components/Home";

function Main () {
 
    return (
  <Router>
    <div id="wrapper">
       <Sidebar />
      <div className="wrapper">
		<div className="section">
			<div className="box-area">
            <div className="Route">
          <Routes>
            <Route path="/" element={<Home />} />
                  <Route path="/users" element={ <ListeUser/> } />
                  <Route path="/users/:id" element={<ListeUser1/>} />
            <Route path="/users/add" element={<AddUser />} />
           
          </Routes>
        </div>
         
        </div>

          </div>
          </div>
      
		</div>
  </Router>
    )
  }

export default Main;
     
if (document.getElementById('app')) {
    const rootElement = document.getElementById("app");
    const root = createRoot(rootElement);
 
    root.render(
        <StrictMode>
            <Main />
        </StrictMode>
    );
}

