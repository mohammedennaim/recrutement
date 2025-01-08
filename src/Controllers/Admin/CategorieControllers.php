<?php
namespace App\Controllers\Admin;
use App\Models\CategorieOffre;
class CategorieControllers{

    public function categories() {
        $categorie = new CategorieOffre();
        $categories = $categorie->fetchAllCategories();
        return $categories;
    }
    // public function ajouter() {}
    
// public function categorieOffre($name){
    //     $categorieOffre = new CategorieOffre();
    //     $categories = $categorieOffre->fetchAllCategories();
    //     $findCategorie = $categorieOffre->fetchCategorie($name);
    //     foreach ($categories as $categorie) {
    //         if($categorie->getName() == $findCategorie->getName()) {
    //             return true;
    //         }else {
    //             return false;
    //         }
    //     }
    // }
}