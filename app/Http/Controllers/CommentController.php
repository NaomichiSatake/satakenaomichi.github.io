<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    private $comment;
    private $post;
    private $user;

    public function __construct(Comment $comment, Post $post, User $user)
    {
        $this->comment = $comment;

        $this->post = $post;

        $this->user = $user;
    }

    public function store(Request $request, $post_id)
    {
        $request->validate(
            [
                'body' . $post_id => 'required|min:1|max:150',
            ],
            [
                'body' . $post_id.'required' => 'You cannnot submit an empty comment.',
                'body' . $post_id.'.max' => 'You cannnot must not have more than 150 characters.'
            ]
        );

        $this->comment->post_id = $post_id;
        $this->comment->body = $request->input('body' . $post_id);
        $this->comment->user_id = Auth::user()->id;

        $this->comment->save();
        return redirect()->back();

    }

    public function destroy($id){
        $this->comment->destroy($id);

        return redirect()->back();
    }

}
