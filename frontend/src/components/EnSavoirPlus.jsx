import React from "react";

const EnSavoirPlus = () => {

    const iconeFontawesome = "fa-regular fa-circle-check"; 


    const contenus = [
        "S'habituer aux caméras et au public",
        "Travailler dans des conditions proches des concerts et des concours",
        "Profiter de studios professionels avec un son de haute qualité et une image 4k",
        "Figurer aux côtés des plus grands maîtres sur une plateforme internationnale"
    ];


    const paragraphes = contenus.map((contenu, index) => (
        <div className="flex items-center justify-center" key={index}>
            <i className={`mr-2 text-[#BB29BB] ${iconeFontawesome}`}></i>
            <p className="text-justify">{contenu}</p>
        </div>
    ));

    return (
        <div className="mt-20">
            <h1 className="md:text-4xl sm:text-3xl text-2xl font-bold py-2">
                Des masterclass filmées et diffusées au sein du plus important
                catalogues de masterclass classiques
            </h1>
            <div className="space-y-4">
                {paragraphes}
            </div>
            <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                En savoir plus
            </button>
        </div>
    );
};

export default EnSavoirPlus;

