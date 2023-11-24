import React from 'react';
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

const UserList = () => {
     const [ users, setUsers ] = useState( [] );
  


 useEffect(() => {
    // Fetch user data from your API endpoint
    fetch('https://127.0.0.1:8000/api/users')
      .then((response) => response.json())
      .then((data) => setUsers(data))
      .catch((error) => console.error('Error fetching user data:', error));
  }, []);


  const handleDelete = (userId) => {
    // URL de l'API de suppression
    fetch(`https://127.0.0.1:8000/api/users/${userId}`, {
      method: 'DELETE',
    })
      .then(() => {
        setUsers(users.filter((user) => user.id !== userId));
      })
      .catch((error) =>
        console.error("Erreur lors de la suppression de l'utilisateur", error)
      );
  };

 return (

          <div className='row'>
      <h1>Liste des utilisateurs</h1>
      <table id="user" className="styled-table">
        <thead>
          <tr>
      <th>Id</th>      
			<th>Nom</th>
			<th>Prenom</th>
			<th>Email</th>
			<th>Adresse</th>
            <th>Tel</th>
            <th>BirthDate</th>
			<th>Age</th>
			<th>Action</th>

          </tr>
        </thead>
        <tbody>
          {users.map((user)=> (
            <tr key={user.id}>
         <td>{ user.id }</td>      
        <td ><Link to={`/users/${user.id}`} className="details">
                  {user.nom}{' '}
              </Link>
              </td>
        <td>{ user.prenom }</td>
        <td>{ user.email }</td>
        <td>{ user.adresse }</td>
                        <td>{ user.tel }</td>
                        <td>{ user.birthDate }</td>
                        <td>{ user.age }</td>
        <td> <a href="#" className="delete" type="button" onClick={()=>handleDelete(user.id)}>
                            Supprimer

              </a>
                
             
                  </td>
            </tr>
          ))}
        </tbody>
       </table>
   
                 </div>
                
 );
};
export default UserList;