import "./App.css";
import { useState } from "react";
import AlunnoRow from './AlunnoRow.js'

function App() {
  const [alunni, setAlunni] = useState([]);
  const [loading, setLoading] = useState(false);
  const [inserimento, setInserimento]=useState(false);
  const [eliminazione, setEliminazione]=useState(false);
  const [nome, setNome]=useState("");
  const [cognome, setCognome]=useState("");

  //asincrona
  function loadA(){
    setLoading(true);
    fetch('http://localhost:8080/alunni')
    .then(response => response.json())
    .then(data => {
      setAlunni(data)
      setLoading(false);
    });
  }

  //non asincrona (potrebbe avere dei delay)
  async function loadB(){
    setLoading(true);
    const response = await fetch('http://localhost:8080/alunni');
    const data = await response.json();
      setAlunni(data);
      setLoading(false);
  
  }

  function salvaAlunno(){
    setInserimento(false);
    fetch('http://localhost:8080/alunni', {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({nome: nome, cognome: cognome})
    })
    .then(response => response.json())
    .then(data => loadA());
  }

  function eliminaAlunno(){
    setEliminazione(false);
    fetch('http://localhost:8080/alunni', {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({nome: nome, cognome: cognome})
    })
    .then(response => response.json())
    .then(data => loadA());
  }

  function showInserimento(){
    setInserimento(!inserimento);
  }

  return (
    <>
      <table border="1">
        {
          alunni.map(alunno =>
            <AlunnoRow  alunno={alunno} />
          )
        }
      </table>
      {loading &&
        <p>Caricamento... Attendere</p>
      }
      {alunni.length === 0 && !loading &&
        <button onClick={loadA}>Carica Alunni</button>
      }
      {alunni.length>0 && !inserimento &&
        <button onClick={showInserimento}>inserisci</button>
      }
      {inserimento && 
        <div>
          <input type='text' name='cognome' placeholder='Nome' onChange={e => setNome(e.target.value)}></input><br></br>
          <input type='text' name='cognome' placeholder='Cognome' onChange={e => setCognome(e.target.value)}></input><br></br>
          <button onClick={salvaAlunno}>salva</button>
          <button onClick={showInserimento}>annulla</button>
        </div>
      }
    </>
  );
}

export default App;