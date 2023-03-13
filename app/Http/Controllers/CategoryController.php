<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = category::with('user')->get();
        // dd($categories);
        return view('pages.category', ['categories' => $categories]);
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
}
