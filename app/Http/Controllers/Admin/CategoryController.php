<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use File;
use DB;
use Exception;

class CategoryController extends Controller
{
    protected $navName = 'category';

    /**
     * UserController constructor.
     */
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
        $sortStyle = config('common.sort.sort_descending');
        $categories = Category::orderBy('id', $sortStyle)->paginate($numberRecord);
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $config = config('common.category.path');
        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            try {
                $image->move(public_path() . $config['image_url'], $fileName);
            } catch (Exception $e) {
                $message = trans('category/messages.errors.image_upload_failed');
                return redirect()->route('category.create')->with('message', $message);
            }
        } else {
            $fileName = $config['default_name_image'];
        }

        $input = $request->only('name', 'introduction');
        $input['image'] = $fileName;
        Category::firstOrCreate($input);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.detail', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest $request
     * @param  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $pathImage = config('common.category.path.image_url');
        $uploadFail = trans('category/messages.errors.image_upload_failed');
        if ($request->hasFile('image')) {
            $imageOld = public_path() . $pathImage . $category->image;
            if ($category->image != config('common.category.path.default_name_image') && File::exists($imageOld)) {
                try {
                    unlink($imageOld);
                } catch (Exception $e) {
                    return redirect()->route('category.edit', ['id' => $id])->with('message', $uploadFail);
                }
            }

            $image = $request->image;
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            try {
                $image->move(public_path() . $pathImage, $fileName);
            } catch (Exception $e) {
                return redirect()->route('category.edit', ['id' => $id])->with('message', $uploadFail);
            }
        } else {
            $fileName = $category->image;
        }

        $input = $request->only('name', 'introduction');
        $input['image'] = $fileName;
        $category->update($input);
        $message = trans('category/messages.success.update_category_success');
        return redirect()->route('category.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        try {
            DB::beginTransaction();
            $pathImage = config('common.category.path.image_url');
            $imageDefault = config('common.category.path.default_name_image');
            $fileName = public_path() . $pathImage . $category->image;
            if ($category->image != $imageDefault && File::exists($fileName)) {
                try {
                    unlink($fileName);
                } catch (Exception $e) {
                    DB::rollBack();
                    $message = trans('category/messages.errors.delete_category_fail');
                    return redirect()->route('user.index')->with('message', $message);
                }
            }

            $category->lessons()->delete();
            $category->words()->delete();
            $category->delete();
            DB::commit();
            $message = trans('category/messages.success.delete_category_success');
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('category/messages.errors.delete_category_fail');
        }

        return redirect()->route('category.index')->with('message', $message);
    }
}
