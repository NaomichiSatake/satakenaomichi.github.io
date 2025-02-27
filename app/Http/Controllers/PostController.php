<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $category;
    private $categoryPost;
    private $like;

    public function __construct(Post $post, Category $category, CategoryPost $categoryPost, Like $like)
    {
        $this->post = $post;
        $this->like = $like;
        $this->category = $category;
        $this->categoryPost = $categoryPost;
    }



    public function create()
    {
        $all_categories = $this->category->all();
        return view('users.posts.create', compact('all_categories'));
    }

    public function store(Request $request)
    {

        #this is to validate data
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:1048'
        ]);

        # Save the post data
        $this->post->user_id = Auth::user()->id;
        $this->post->description = $request->description;
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        # Save the categories to the category_post table
        # We only need to save the category id because the post id is automatic because
        # of the post and category_pos relationship 'hasMany'
        foreach ($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');

    }

    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('users.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if (Auth::user()->id !== $post->user->id) {
            return redirect()->back();
        }

        $all_categories = $this->category->all();

        return view('users.posts.edit', compact('post', 'all_categories'));
    }

    public function update(Request $request, $id)
    {

        $post = $this->post->findOrFail($id);
        #this is to validate data
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:1048'
        ]);

        # Save the post data
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        $post->categoryPost()->delete();
        $category_post = [];


        # Save the categories to the category_post table
        # We only need to save the category id because the post id is automatic because
        # of the post and category_pos relationship 'hasMany'
        foreach ($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }

        $post->categoryPost()->createMany($category_post);

        return redirect()->route('post.show', $id);

    }

    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);

        // Delete the post from database
        $post->forceDelete();

        return redirect()->route('index');
    }

    public function getUsersByPostId($post_id)
    {
        // 指定されたpost_idに関連付けられたユーザーを取得
        $users = Like::where('post_id', $post_id)
            ->with('user') // リレーションをロード
            ->get()
            ->pluck('user'); // userカラムのみを取得

        return $users;
    }
}
