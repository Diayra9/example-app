<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /*** Fungsi untuk menyimpan category dari form blade ***/
    public function saveCategory(Request $request)
    {
        $input = $request->input();

        $category = new Category();
        $category->category =  $request->category;
        $category->save();

        return redirect('list-category');
    }

    /*** Fungsi untuk membaca list wallet dari form blade ***/
    public function listCategory(Request $request)
    {
        $categories = Category::get();

        return view('list-category', compact('categories'));
    }

    /*** Fungsi untuk menghapus list wallet dari form blade ***/
    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);
        // dd($category);
        $category->delete();

        return redirect('list-category');
    }

    /*** Fungsi untuk mengedit list category dari form blade ***/
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);

        return view('edit-category', compact('category'));
    }

    /*** Fungsi untuk mengupdate category dari form blade ***/
    public function updateCategory(Request $request, $id)
    {
        $input = $request->input();

        $category = Category::find($id);
        $category->category =  $request->category;
        $category->save();

        return redirect('list-category');

        // $request->status == 0 && $category->status != 0
    }
}