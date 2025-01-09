<?php
namespace App\Models;
use App\Config\Database;
use App\Classes\Categorie;
use PDO;

class CategorieOffre
{
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
     }
    public function fetchAllCategories() {
        // $query = "SELECT categorie.id as id, categorie_name as name FROM categorie
        // join offrecategorie on offrecategorie.categorie_id = id
        // join offre on offre.id = offrecategorie.offre_id";        
  
        $query = "SELECT categorie.id as id, categorie_name as name, status FROM categorie";        

        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categories = [];
        
        if (!$rows) {
            return null;
        } else {
            foreach ($rows as $row) {
                $categories[] = new Categorie($row['id'], $row["name"],$row["status"]);
            }
            return $categories;
        }
     }
     
     public function findByName($name) {
         $stmt = $this->conn->prepare("SELECT * FROM categorie WHERE categorie_name = :name");
         $stmt->bindParam(':name', $name);
         $stmt->execute(); 
     
         // Return the category data or false if not found
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //  return $result; 
     }
     
     
     public function ajouterCategorie($name){
        $query = "INSERT INTO categorie (categorie_name) VALUES (:name);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name',$name);
        $stmt->execute();
        // var_dump("categorie_name")
     }
//      public function DeleteRecor($lD=null, $table="categorie"){
// if ($ID
// Squery_string sprintfCDELETE FROM (Stable) WHERE
// // execute database query
// Sresult :
// if (Sresult){
// echo "Record Deleted successfully!";}

}


