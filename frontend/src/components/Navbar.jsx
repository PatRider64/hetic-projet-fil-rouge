import React, { Component } from 'react';
import "./NavbarStyles.css";
import {Link} from "react-router-dom";
import {MenuItems} from "./MenuItems";

// function Navbar() {
//   return (
//     <div>
//         <nav className='navbar'>
//             <div className='navbar-container'>
//                 <link to="/" className="navbar-logo">
//                 TRVL
//                 </link>
//             </div>
//         </nav>
      
//     </div>
//   )
// }

// export default Navbar


class Navbar extends Component {
  state = {clicked: false};
  handleClick = () => {
    this.setState({clicked: !this.state.clicked})
  }
  render(){
    return(
      <nav className='NavbarItems'>
        <h1 className='navbar-logo'>Academie</h1>
        <div className='menu-icons' onClick={this.handleClick}>
          <i className={this.state.clicked ? "fas fa-times" : "fas fa-bars"}></i>

        </div>

        <ul className={this.state.clicked ? "nav-menu active" : "nav-menu"}>
          {MenuItems.map((item, index) =>{
            return (
              <li key={index}>
              <Link className={item.cName} to={item.url}>
                
                <i>{item.title}</i> 
              </Link>
            </li>

            )
          })}

          
        </ul>
      </nav>
    )
  }
}

export default Navbar; 