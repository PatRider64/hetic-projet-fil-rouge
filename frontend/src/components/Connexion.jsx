import React, { useState } from 'react';
import axios from 'axios';


function Connexion() {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
  });
  const [error, setError] = useState(null); 

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    axios
      .post('/login_check', formData)
      .then((response) => {

        setError(null);
        console.log('Réponse du backend :', response.data);

        window.location.href = '/'; 
      })
      .catch((error) => {

        setError('Erreur lors de la connexion. Vérifiez vos identifiants.');
        console.error('Erreur lors de la connexion :', error);
      });
  };

  return (
    <div style={{ backgroundImage: 'url("/assets/fille.jpg")', backgroundSize: 'cover', backgroundPosition: 'center', minHeight: '100vh' }}>
      <div className="min-h-screen flex items-center justify-center bg-gray-100">
        <div className="bg-white p-8 rounded-lg shadow-lg">

          <h2 className="text-2xl font-semibold mb-4">Connexion</h2>
          <form onSubmit={handleSubmit}>
            <div className="mb-4">
              <label className="block text-gray-600">Email :</label>
              <input
                type="email"
                className="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Votre email"
                name="email"
                value={formData.email}
                onChange={handleChange}
              />
            </div>
            <div className="mb-4">
              <label className="block text-gray-600">Mot de passe :</label>
              <input
                type="password"
                className="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Votre mot de passe"
                name="password"
                value={formData.password}
                onChange={handleChange}
              />
            </div>
            {error && <p className="text-red-500 mb-4">{error}</p>} 
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

