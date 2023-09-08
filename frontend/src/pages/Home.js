import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";

function Home () {
    return (
        <div>
            <Navbar/>
            <Hero
            cName="hero"
            MusiSaline="./assets/MusiSaline.jpeg"
            title="Académie de musique classique"
            text="Profitez d'une semaine de masterclass avec les plus grands professeurs de musique classique"
            buttonText="S'inscrire à l'académie"
            url="/"
            btnClass="show"
            />
        </div>
    );
}

export default Home;