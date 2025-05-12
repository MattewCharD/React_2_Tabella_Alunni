<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  
  //SELECT all -> get
  public function index(Request $request, Response $response, $args){
    sleep(3);
    $db = Db::getInstance();

    $query = "select * from alunni";
    $result = $db->query($query);
    $results = $result->fetch_all(MYSQLI_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //SELECT where --> get
  public function show(Request $request, Response $response, $args){
    $db = Db::getInstance();
    $db->query("SELECT * FROM alunni a where a.id = " . $args["id"] . "");  
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //CREATE --> post
  public function create(Request $request, Response $response, $args){
    $db = Db::getInstance();
    $body = json_decode($request->getBody()->getContents(), true);
    $nome= $body["nome"];
    $cognome = $body["cognome"];

    $result = $db->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')");

    if($db->affected_rows > 0){
      $results = ["msg" => "OK"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Content-type", "application/json")->withStatus(201);
    } 

    $results = ["msg" => "KO"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(400);
  }
  //dc
  public function createwww(Request $request, Response $response, $args){
      $db = Db::getInstance();
      $db = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
      $body = json_decode($request->getBody());
      $query = "INSERT INTO alunni (nome, cognome) VALUES (?, ?);";
      $stmt = $db->prepare($query);
      if($body->nome && $body->cognome){
        $stmt->bind_param("ss", $body->nome, $body->cognome);
        $stmt->execute();
        $response->getBody()->write('{"msg": "Created"}');
        return $response->withHeader("Content-type", "application/json")->withStatus(201);
      }
      else{
        $response->getBody()->write('{"msg": "Missing Params"}');
        return $response->withHeader("Content-type", "application/json")->withStatus(400);
      }
    }

  //fg
  public function createdddd(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $body = json_decode($request->getBody()->getContents(),true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];

    $result = $mysqli_connection->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')");
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);

  }

  //UPDATE --> put
  public function update(Request $request, Response $response, $args){
    $db = Db::getInstance();
    $body = json_decode($request->getBody()->getContents(),true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $id = $args["id"];

    $result = $db->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = '$id' ;");
    
    if($db->affected_rows > 0){
      $results = ["msg" => "OK"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Content-type", "application/json")->withStatus(201);
    } 

    $results = ["msg" => "KO"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(400);
  }
  
  //DELETE --> delete
  
  public function destroy(Request $request, Response $response, $args){
    $db = Db::getInstance();
    $id=$args["id"];
    $result = $db->query("DELETE FROM alunni WHERE id = '$id';");

    if($db->affected_rows > 0){
      $results = ["msg" => "OK"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Conent-type", "application/json")->withStatus(201);
    } 

    $results = ["msg" => "KO"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Conent-type", "application/json")->withStatus(400);
  }
}