<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Fetch all subcategories for a given category recursively.
     *
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAllSubcategories($categoryId)
    {
        
        $categories= Category::find($categoryId);

        

        

        return $categories;
    }
}