import React from "react"
import "./FooterStyles.css"

function Footer () {
    return (
        <div className="footer">
            <div className="top">
                 <div>
                    <a href="/">Politique de gestion des cookies</a>
                    <a href="/">Panneau de gestion des cookies</a>
                    <a href="/">Politique de confidentialité</a>
            </div>
            <div>
                    <a href="/">CGV</a>
                    <a href="/">CGU</a>
                    <a href="/">Plan du site</a>
             </div>


            <div className="bottom">
                <p></p>
                <a href="/">
                    <i className="fa-brands fa-facebook-square"></i>
                    <a href="/">
                    <i className="fa-brands fa-instagram-square"></i>
                </a>
                <a href="/">
                    <i className="fa-brands fa-twitter-square"></i>
                </a>
                </a>
            <div className="bottom2">
                <p>© 2022 Musicampus - Tous droits réservés</p>
            </div>
            </div>


            </div>

        </div>

    )
}

export default Footer