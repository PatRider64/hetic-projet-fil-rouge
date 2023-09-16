import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import Footer from "../components/Footer";
import Newsletter from "../components/Newsletter";

function preparerC () {
    return (
        <div>
            <Navbar/>
            <Hero
                cName="hero"
                MusiSaline="./assets/monsieur.jpg"
                title="Vous préparez un concours ? Vous cherchez des informations sur une oeuvre, un compositeur, un jury ? Vous souhaitez connaitre les académies près de chez vous ?"
                text="Développez votre carrière grâce à un ensemble de ressources : concours, académies, institutions, musiciens... réunis en seul endroit par la Saline royale Academy. "

                
            />
            <Newsletter/>
            <Footer/>
        </div>
    )
}

export default preparerC;