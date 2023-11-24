import React from 'react';
import { Link } from 'react-router-dom'
import './Sidebar.css'

function Sidebar() {
    return (
       <aside>
  <p> React_ApiSymfony </p>
  <Link to="/users">
    <i className="fa fa-user-o" aria-hidden="true"></i>
    List User
  </Link>
  <Link to="/users/possession">
    <i className="fa fa-laptop" aria-hidden="true"></i>
    Possession
  </Link>
  <Link to="/users/add">
    <i className="fa fa-clone" aria-hidden="true"></i>
    Add User
  </Link>

 
</aside>
  )
}

export default Sidebar