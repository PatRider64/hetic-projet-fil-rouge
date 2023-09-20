import "./HeroStyles.css"
import React from "react";


function Hero (props) {
    return (
        <div>
            <div className={props.cName}>
                <img alt="MusiSaline" src={props.MusiSaline}/>

                <div className="hero-text">
                    <h1>{props.title}</h1>
                    <p>{props.text}</p>
                    <a href={props.url} className=
                    {props.btnClass}>{props.buttonText}</a>
                </div>

            </div>

        </div>
    );
}

export default Hero;