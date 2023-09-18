import React from "react";
import "./ProfesseursStyles.css";

const Professeurs = () => {
    

    return (
        <div className="bg-[#161C3D]">
            <h1 className="md:text-4xl sm:text-3xl text-2xl font-bold py-2 text-white">
            Une programmation 2023 composée de professeurs d’exception
            </h1>

            

            <div className="profList">
            <div class="violin">
                <img src="https://www.salineacademy.com/wp-content/uploads/2023/06/Miriam-Fried-Violin-Masterclass-1.jpg" class="imgProf"/>
                <span>Miriam Fried <br/><font color="#BB29BB">Professeur de violon au New England Conservatory à Boston.</font></span>
                <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                En savoir plus
                </button>
            </div>
            <div class="violin">
                <img src="https://www.salineacademy.com/wp-content/uploads/2023/06/Martin-Beaver-Violin-Masterclass-1.jpg" class="imgProf"/>
                <span>Martin Beaver <br/><font color="#BB29BB">Professeur de violon et de musique de chambre au Colburn Conservatory of Music et à la Colburn Music Academy à Los Angeles.</font></span><br/>
                <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                En savoir plus
                </button>
            </div>
            <div class="violin">
                <img src="https://www.salineacademy.com/wp-content/uploads/2023/06/Augustin-Dumay-Violin-Masterclass-1.jpg" class="imgProf"/>
                <span>Augustin Dumay <br/><font color="#BB29BB">Professeur en résidence à la Chapelle Musicale Reine Elisabeth.</font></span>
                <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                En savoir plus
                </button>
            </div>
            <div class="violin">
                <img src="https://www.salineacademy.com/wp-content/uploads/2023/06/Barnabas-Kelemen-Violin-Masterclass-1.jpg" class="imgProf"/>
                <span>Barnabás Kelemen <br/><font color="#BB29BB">Professeur à l'Académie Liszt de Budapest et à l'Université de Cologne.</font></span>
                <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                En savoir plus
                </button>
            </div>
            <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto py-3 text-white">
                Plus de professeurs
            </button>
            </div>
        </div>
    );
};

export default Professeurs;