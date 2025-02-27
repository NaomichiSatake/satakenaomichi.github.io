<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    //

    private $category;
    private $post;

    public function __construct(Category $category,Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('updated_at','desc')->paginate(10); // Correct method name: paginate
        $isolatedPostsCount = Post::doesntHave('categoryPost')->get();


        return view('admin.categories.index', compact('all_categories', 'isolatedPostsCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $this->category->name = ucwords(strtolower($request->name));

        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $category->name = ucwords(strtolower($request->name));

        $category->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->category->destroy($id);

        return redirect()->back();
    }


}
