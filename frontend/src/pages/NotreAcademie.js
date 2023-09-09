import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
// import MasterImg from "../assets/piano.jpg";
import Footer from "../components/Footer";

function notreAcademie () {
    return (
        <div>
            <Navbar/>
            <Hero
                cName="hero"
                MusiSaline="./assets/piano.jpg"
                title="Académie de musique classique"
                text="Profitez d'une semaine de masterclass avec les plus grands professeurs de musique classique"
                buttonText="S'inscrire à l'académie"
                url="/"
                btnClass="show"
                
            />
            <Footer/>
        </div>
    );
}

export default notreAcademie;