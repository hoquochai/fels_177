<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class CategoryController extends UserController
{
    protected $navName = "category";

    public function __construct()
    {
        parent::__construct($this->navName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        parent::index();
        $numberRecord = config('common.category.pagination.default_number_record_category');
        $categories = Category::paginate($numberRecord);
        return view('user.category', compact('categories'));
    }
}
