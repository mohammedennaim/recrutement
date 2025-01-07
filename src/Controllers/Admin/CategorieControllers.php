<?php
namespace App\Controllers\Admin;
use App\Models\CategorieOffre;
class CategorieControllers{

    public function categories() {
        $categorie = new CategorieOffre();
        $categories = $categorie->findCategories();
        return $categories;
    }
}