import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import NotreHistoire from "../components/NotreHistoire";
import Footer from "../components/Footer";
import Newsletter from "../components/Newsletter";

function notreAcademie () {
    return (
        <div>
            <Navbar/>
            <Hero
                cName="hero"
                MusiSaline="./assets/piano.jpg"
                title="Académie de musique classique"
                text="Apprenez et progressez aux côtés des meilleurs professeurs"
                buttonText=""
                url="/"
                btnClass="/"
                
            />
            <NotreHistoire/>
            <Newsletter/>
            <Footer/>
        </div>
    );
}

export default notreAcademie;