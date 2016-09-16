<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class CategoryController extends Controller
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
        $numberRecord = config('common.category.pagination.default_number_record_category');
        $categories = Category::paginate($numberRecord);
        return view('user.category', compact('categories'));
    }
}
