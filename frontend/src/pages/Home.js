import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import Phrases from "../components/Phrases";
import Footer from "../components/Footer";
import EnSavoirPlus from "../components/EnSavoirPlus";
import Offres from "../components/Offres";
import Newsletter from "../components/Newsletter";


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
            <Phrases/>
            <EnSavoirPlus/>
            <Offres/>
            <Newsletter/>
            <Footer/>
            
             


        </div>

    );
}

export default Home;