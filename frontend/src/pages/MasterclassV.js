import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import Plateforme from "../components/Plateforme";
import Footer from "../components/Footer";
import Professeurs from "../components/Professeurs";

function masterClassV () {
    return (
        <div>
            <Navbar/>
            <Hero
                cName=".hero-mid"
                MusiSaline="./assets/piano2.jpg"
                title="Académie de musique classique"
                text="Profitez d'une semaine de masterclass avec les plus grands professeurs de musique classique"
                buttonText="S'inscrire à l'académie"
                url="/"
                btnClass="show"
            />
            <Plateforme/>
            <Professeurs/>
            <Footer/>

        </div>
    )
}

export default masterClassV;