<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $all_users = $this->user->withTrashed()->latest()->paginate(5); // Correct method name: paginate

        return view('admin.users.index', compact('all_users'));
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }
    public function activate($id)
    {
        // only Trashed to make sure only the deactivated users will be searched
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $all_users = $this->user->withTrashed()->latest()->where('name', 'like', '%' . $request->search . '%')
            ->where('id', '!=', Auth::user()->id) // 現在ログイン中のユーザーを除外
            ->paginate(5);
        # Same as : SELECT name FROM users WHERE name LIKE '%search%';

        return view('admin.users.index')->with('all_users', $all_users)->with('search', $request->search);
    }
}
