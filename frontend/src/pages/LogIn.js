import React from "react";
import Navbar from "../components/Navbar";
import Connexion from "../components/Connexion";
import Footer from "../components/Footer";

function logIn () {
    return (
        <div>
            <Navbar/>
            <h1 >logIn</h1>
            <Connexion/>             
            <Footer/>
        </div>
    )
}

export default logIn;