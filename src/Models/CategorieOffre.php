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
    public function findCategories() {
        $query = "SELECT categorie.id as id, categorie_name as name FROM categorie
        join offrecategorie on offrecategorie.categorie_id = id
        join offre on offre.id = offrecategorie.offre_id";        
  
        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categories = [];
        
        if (!$rows) {
            return null;
        } else {
            foreach ($rows as $row) {
                $categories[] = new Categorie($row['id'], $row["name"]);
            }
            return $categories;
        }
     }
}


