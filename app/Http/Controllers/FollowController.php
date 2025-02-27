<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowController extends Controller
{
    //
    private $follow;

    public function __construct(Follow $follow, User $user)
    {
        $this->follow = $follow;
        $this->user = $user;
    }

    public function store($user_id)
    {
        // the follower user 1 is following uesr 2
        $this->follow->follower_id = Auth::user()->id; // htee follower #2
        $this->follow->following_id = $user_id;  // the user being followed#3
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($user_id)
    {
        $this->follow->where('following_id', $user_id)->where('follower_id', Auth::user()->id)->delete();
        return redirect()->back();
    }



    public function show()
    {
        $pagedData = $this->getSuggestedUsersofUser();

        return view('users.profile.suggested', ['pagedData' => $pagedData]);
    }

    private function getSuggestedUsersofUser()
{
    $loggedInUserId = Auth::user()->id;

    // 未フォローのユーザーをクエリで取得し、ページネーションを適用
    return User::where('id', '!=', $loggedInUserId) // 自分以外のユーザー
        ->whereDoesntHave('followers', function ($query) use ($loggedInUserId) {
            $query->where('follower_id', $loggedInUserId); // ログイン中のユーザーがフォローしていないユーザー
        })
        ->paginate(5); // 1ページあたり5件
}

}
