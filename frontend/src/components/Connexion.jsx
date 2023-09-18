import React from 'react';
import { useState, useEffect } from 'react';
import axios from 'axios';

function Connexion () {
  const [userData, setUserData] = useState({});

  useEffect(() => {

    axios.get('/login')
      .then((response) => {
        // Récupérez les données de l'utilisateur depuis la réponse
        setUserData(response.data);
      })
      .catch((error) => {
        console.error('Erreur lors de la récupération des données :', error);
      });
  }, []);

  return (
    <div>
      <h2>Données de l'utilisateur :</h2>
      <pre>{JSON.stringify(userData, null, 2)}</pre>
    

        <div className="min-h-screen flex items-center justify-center bg-gray-100">
        <div className="bg-white p-8 rounded-lg shadow-lg">
        <h2 className="text-2xl font-semibold mb-4">Connexion</h2>
        <form>
            <div className="mb-4">
            <label className="block text-gray-600">Email :</label>
            <input
                type="email"
                className="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Votre email"
            />
            </div>
            <div className="mb-4">
            <label className="block text-gray-600">Mot de passe :</label>
            <input
                type="password"
                className="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Votre mot de passe"
            />
            </div>
            <button
            type="submit"
            className="bg-[#c9c6c655] text-black px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors"
            >
            Se connecter
            </button>
        </form>
        </div>
        </div>
    </div>
    
  );
}

export default Connexion;
