
<!-- ----- debut ModelVin -->
<?php
require_once 'Model.php';

class ModelProjet {

 private $producteur_id, $vin_id, $quantite,$cru,$nom;

 // pas possible d'avoir 2 constructeurs
 public function __construct($producteur_id = NULL, $vin_id = NULL, $quantite = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($producteur_id)) {
   $this->producteur_id = $producteur_id;
   $this->vin_id = $vin_id;
   $this->quantite = $quantite;
  }
 }

 function setProducteur_vin($producteur_id) {
  $this->producteur_id = $producteur_id;
 }

 function setVin_id($vin_id) {
  $this->vin_id = $vin_id;
 }

 function setQuantite($quantite) {
  $this->quantite = $quantite;
 }
 
 function setCru($cru) {
     $this->cru =$cru;
 }
 
 function setNom($nom) {
     $this->nom=$nom;
 }

 function getProducteur_id() {
  return $this->producteur_id;
 }

 function getVin_id() {
  return $this->vin_id;
 }

 function getQuantite() {
  return $this->quantite;
 }
 
 function getCru() {
     return $this->cru;
 }
 
 function getNom() {
     $this->nom;
 }
 
 // Persistance .......


 public static function view() {
  printf("<tr><td>%d</td><td>%d</td><td>%d</td></tr>", $this->getProducteur_vin(), $this->getVin_id(), $this->getQuantite());
 }

// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from vin";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
  public static function getAllNom() {
  try {
   $database = Model::getInstance();
   $query = "select nom from producteur";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

  public static function getOneNom() {
  try {
   $database = Model::getInstance();
   $query = "select cru,quantite from recolte,vin where vin_id=vin.id group by cru";
   $statement = $database->prepare($query);
   $statement->execute();
   //$results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $statement;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVin");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from recolte";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
  public static function getAllProducteur() {
  try {
   $database = Model::getInstance();
   $query = "select nom,COUNT(cru) as nombreDeCru,SUM(quantite) AS somme from recolte,vin,producteur where producteur_id=producteur.id AND vin_id=vin.id group by nom";
   $statement = $database->prepare($query);
   $statement->execute();
   //$results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
   return $statement;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from vin where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVin");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($cru, $annee, $degre) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from vin";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into vin value (:id, :cru, :annee, :degre)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'cru' => $cru,
     'annee' => $annee,
     'degre' => $degre
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update() {
  echo ("ModelVin : update() TODO ....");
  return null;
 }

 public static function delete($id) {
  echo ("ModelVin : delete() TODO ....");
  
  try {
   $database = Model::getInstance();
   $query="delete from vin where id=$id";
   
   $database->exec($query);
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}
?>
<!-- ----- fin ModelVin -->
