<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers(); // Fetch the suggested users
        return view('users.home', compact('home_posts', 'suggested_users'));
    }

    private function getHomePosts()
    {
        $all_posts = $this->post->latest()->get();
        //In the case the $home_posts is empty ie will not return a Null, but empty instead

        $home_posts = [];

        foreach ($all_posts as $post) {
            // check if the logged in user is following the post creator of if the post creator is the logged in user
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post;
            }
            # code...
        }

        return $home_posts;
    }

    private function getSuggestedUsers()
    {
        // getting all the users except the logged in
        $all_users = $this->user->all()->except(Auth::user()->id);

        // create an empty array
        $suggested_users = [];

        foreach ($all_users as $user) {
            //check if the user is not followed
            if (!$user->isFollowed()) {
                // add the user that is not followed
                $suggested_users[] = $user;
            }
        }

        // return the list of suggested users
        return array_slice($suggested_users, 0, 5);
    }

    

    public function search(Request $request){
        $users = $this->user->where('name', 'like','%'. $request->search. '%')->get()->except(Auth::user()->id);
        # Same as : SELECT name FROM users WHERE name LIKE '%search%';

        return view('users.search')->with('users',$users)->with('search',$request->search);
    }




}
