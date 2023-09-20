<div className='grid grid-cols-1 sm:grid-cold-2'>
<div>
  <img src="/assets/fille.jpg" alt="" />
  <h2>Saline Royale Academy</h2>
</div>
</div>

return (
    <div>
        <div className="min-h-screen flex items-center justify-center bg-gray-100">
            <div className="bg-white p-8 rounded-lg shadow-lg">
            <img classN src="/assets/fille.jpg" alt="" />
            <h2>Saline Royale Academy</h2>
            <h3 className="text-2xl font-semibold mb-4">Connexion</h3>
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
                {error && <p className="text-red-500 mb-4">{error}</p>} {/* Affichez l'erreur ici */}
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
      


export default Connexion;
