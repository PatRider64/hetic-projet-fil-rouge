// import logo from './logo.svg';
import './styles.css'
import 'tailwindcss/tailwind.css';
import './App.css';
import { Routes, Route } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import Home from './pages/Home';
import Masterclass from './pages/MasterclassV';
import NotreAcademie from './pages/NotreAcademie';
import PreparerConcours from './pages/PreparerConcours';
import LogIn from './pages/LogIn';
import SignIn from './pages/SignUp';


 export default function App () {
   return (
    <div className='App'>
      <Routes>
        <Route path= "/" element={<Home/>}/>
        <Route path= "/masterclassV" element={<Masterclass/>}/>
        <Route path= "/notreAcademie" element={<NotreAcademie/>}/>
        <Route path= "/preparer" element={<PreparerConcours/>}/>
        <Route path= "connexion" element={<LogIn/>}/>
        <Route path= "/enregistrer" element={<SignIn/>}/>


      </Routes>

      

    </div>
 
  );

};

// function App() {
//   return (
//     <div className="App">
//       <header className="App-header">
//         {/* <img src={logo} className="App-logo" alt="logo" />
//         <p>
//           Edit <code>src/App.js</code> and save to reload.
//         </p>
//         <a
//           className="App-link"
//           href="https://reactjs.org"
//           target="_blank"
//           rel="noopener noreferrer"
//         >
//           Learn React
//         </a> */}
//       </header>
      
//     </div>
//   );
// };

// export default App;
  // cours, connexion, compte, à propos, page tarif > paiement, page où les instruments sont répertoriés