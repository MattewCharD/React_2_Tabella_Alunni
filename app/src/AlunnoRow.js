import "./AlunnoRow.css";

export default function AlunnoRow(props) {
    const alunno = props.alunno;

    const [eliminazione, setEliminazione]=useState(false);

    function eliminaAlunno(){
        setEliminazione(!eliminazione);
        //fai la fetch con medoto DELETE

    }
/*
    function showEliminazione(){
        setEliminazione(!eliminazione);
      }

    return(
        <>
            <tr>
              <td>{alunno.id}</td>
              <td>{alunno.nome}</td>
              <td>{alunno.cognome}</td>
              <td><button onClick={showEliminazione}>Delete</button></td>
            </tr>
            {eliminazione &&
                <span>Sei sicuro?</span>
                <button></button>

            }
        </>
    )*/

    function confermaEliminazione() {
        eliminaAlunno(alunno.id); // Chiama la funzione di eliminazione passata da App.js
        setEliminazione(false); // Nasconde il popup dopo l'eliminazione
    }

    return (
        <tr>
            <td>{alunno.id}</td>
            <td>{alunno.nome}</td>
            <td>{alunno.cognome}</td>
            <td>
                {eliminazione ? (
                    <div>
                        <span>Sei sicuro?</span>
                        <button onClick={confermaEliminazione}>Sì</button>
                        <button onClick={() => setEliminazione(false)}>No</button>
                    </div>
                ) : (
                    <button onClick={() => setEliminazione(true)}>Delete</button>
                )}
            </td>
        </tr>
    );

}