import { useState } from "react";
import React from "react";
import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import Phrases from "../components/Phrases";
import Footer from "../components/Footer";
import EnSavoirPlus from "../components/EnSavoirPlus";
import Offres from "../components/Offres";
import Newsletter from "../components/Newsletter";


function Home () {
    const [list, setList] = useState([
        {
            question: 'Qui sont les professeurs de nos académies ?',
            answer: 'Ensemble, nos professeurs ont remporté 54 grands prix, participé à 45 concours musicaux et enseignent dans le monde entier. Ils partagent leurs connaissances, leurs conseils et leurs techniques pour vous aider à améliorer et à développer vos compétences dans le cadre de leurs masterclasses et de leurs interviews.',
            active: 1
        },
        {
            question: 'Peut-on faire une demande de bourse ?',
            answer: 'Afin de faciliter l’accès à nos académies, des bourses pourront être attribuées aux futurs étudiants qui en font la demande. Leur profil sera étudié par nos équipes. Les critères tels que le projet global et la motivation sont pris en compte. '
        },
        {
            question: "J'ai un régime particulier. Comment faire ?",
            answer: "Nous proposons plusieurs options de menus différents, pour s'adapter à toujs les goûts."
        },
        {
            question: 'La gare est-elle proche de la Saline Royale ?',
            answer: "Oui, la gare d'Arc-et-Senans se situe à 200m de la Saline Academy"
        },
        {
            question: "J'ai perdu mes identifiants, que faire ?",
            answer: "En cas d'oubli/perte de votre adresse e-mail de connexion, nous vous invitons à nous contacter via notre formulaire de contact ou les réseaux sociaux, nous essaierons ainsi au mieux de vous aider à le retrouver. N'hésitez pas à nous préciser les noms et prénoms pouvant être associés à votre compte."
        },
        
    ]);
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