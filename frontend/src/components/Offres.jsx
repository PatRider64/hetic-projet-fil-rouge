import React from "react";


const Offres = () => {
    return (
        <div className="w-full py-[10rem] px-20 bg-white">
            <div className="max-w-[1240px] mx-auto grid md:grid-cols-2 gap-8">
                <div className="max-w-[1240px] mx-auto grid md:grid-cols-3 gap-8">
                    <div className="w-[300px] shadow-xl flex flex-col p-4 rounded-lg hover:scale-105 duration">
                        <i class="fa-solid fa-user 'w-20 mx-auto mt-[-3rem]  "></i>
                        <h2 className="text-2xl font-bold text-center py-8">Frais pédagogiques</h2>
                        <p className="text-center font-medium">582€</p>
                        <h2 className="text-xl font-bold text-center py-8">Demi-pension</h2>
                        <p className="text-center font-medium">150€</p>


                    
                        <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium mt-6 mx-auto px-6 py-3 text-white">S'inscrire</button>
                    </div>
                </div>

                <div className="max-w-[1240px] mx-auto grid md:grid-cols-3 gap-8">
                    <div className="w-[300px] shadow-xl flex flex-col p-4 rounded-lg hover:scale-105 duration">
                        <i class="fa-solid fa-user 'w-20 mx-auto mt-[-3rem]  "></i>
                        <h2 className="text-2xl font-bold text-center py-8">Frais d'hébergement et restauration</h2>
                        <h2 className="text-xl font-bold text-center py-8">Pension complète - chambre single</h2>
                        <p className="text-center font-medium">897€</p>
                        <h2 className="text-xl font-bold text-center py-8">Pension complète - chambre double</h2>
                        <p className="text-center font-medium">697€</p>
                        <h2 className="text-xl font-bold text-center py-8">Pension complète - dortoirs</h2>
                        <p className="text-center font-medium">520€</p>



                   
                        <button className="bg-[#BB29BB] w-[200px] rounded-md font-medium my-6 mx-auto px-6 py-3 text-white">S'inscrire</button>
                    </div>
                </div>
            </div>
        </div>
    )
}


export default Offres