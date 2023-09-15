import React from "react";

const Newsletter = () => {
    return (
        <div className='w-full py-16 text-white bg-[#a1a1aa] px-4'>
            <div className="max-w-[1240px] mx-auto grid lg:grid-cols-3"></div>
            <div className="lg:col-span-é my-4">
                <h1 className="mdr:text-4xl sm:text-3xl text-2xl font-bold py-2">Vous voulez rester en contact ? Suivez-nous sur les réseaux sociaux et abonnez-vous à notre newsletter.</h1>
            </div>
            <div className="my-4">
                <div className="flex flex-col sm:flex-row items-center justify-between w-full">
                    <input className="p-3 flexx w-full rounded-md text-[#454545]" type="email" placeholder="Votre adesse email"/>
                    <button className="bg-[#BB29BB] text-white rounded-md font-medium w-[200px] ml-4 my-6 px-6 ">S'inscrire à la newsletter</button>
                </div>
            </div>
        </div>
    )
}


export default Newsletter