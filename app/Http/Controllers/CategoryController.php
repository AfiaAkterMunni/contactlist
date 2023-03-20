<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = category::with('user')->get();
        return view('pages.category', ['categories' => $categories, 'editCategory' => null, 'edit' => false]);
    }
    public function store(StoreCategoryRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'created_by' => Auth::id()
        ];
        category::create($data);
        return redirect(url('/categories'))->with('success', 'Category Added Successfully!');
    }

    public function edit($id)
    {
        $categories = category::with('user')->get();
        $editCategory = Category::find($id);
        // dd($editCategory);
        return view('pages.category', ['categories' => $categories, 'editCategory' => $editCategory, 'edit' => true]);
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->name
        ]);
        return redirect(url('/categories'))->with('editsuccess', 'Category Updated Successfully!');
    }
}
