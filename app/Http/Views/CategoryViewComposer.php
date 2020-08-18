<?php


namespace App\Http\Views;

use App\Category;

class CategoryViewComposer
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function composer($view)
    {
        return $view->with('categories', $this->category->where('active', 'OK')->get(['name', 'slug']));
    }

}
