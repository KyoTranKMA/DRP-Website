<?php

namespace App\Controllers;
use App\Operations\RecipeReadOperation;
class PaginationController {
    public function getPagingRecipe($page = 1)
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page <= 0) {
            $page = 1;
        }
        $limit = 15;
        $offset = ($page - 1) * $limit;
        $recipes = RecipeReadOperation::getPaging($limit, $offset);
        // Return Recipes as JSON to Ajax request 
        echo json_encode($recipes);
    }
}
?>
