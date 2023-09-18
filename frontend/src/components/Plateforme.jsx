import React from "react";

const Plateforme = () => {
    //icon
    const iconCheck = "fa-regular fa-circle-check"; 

    // contenus
    const avantages = [
        "Vidéos multi angles pour se concentrer sur le doigté, les mouvements du professeur, la performance de l'élève...",
        "Des partitions annotées avec les conseils du professeur et prêtes à être téléchargées",
        "Des centaines de masterclasses, concerts et interviews",
        "Des vidéos disponibles en qualité HD sur mobile, ordinateur et tablette."
    ];

    // listing
    const checkList = avantages.map((avantages, index) => (
        <div className="flex items-center justify-center" key={index}>
            <i className={`mr-2 ${iconCheck}`}></i>
            <p className="text-justify">{avantages}</p>
        </div>
    ));

    return (
        <div className="text-white bg-[#525877]">
            <h1 className="md:text-4xl sm:text-3xl text-2xl font-bold py-2">
            Une plateforme pensée pour se concentrer sur l'apprentissage
            </h1>
            <div className="space-y-4">
                {checkList}
            </div>
        </div>
    );
};

export default Plateforme;