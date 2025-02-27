<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show', compact('user'));
    }

    // edit profle fucntion
    public function edit()
    {
        // find the user using the auth as a parameter
        $user = $this->user->findOrFail(Auth::user()->id);

        //return the edit page fr
        return view('users.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        $request->validate([
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|min:1|max:255|unique:users,email,' . $user->id,
            'thumbnail' => '|mimes:png,jpg,jpeg,gif|max:1048',
            'introduction' => '|min:1|max:100',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        if ($request->hasFile('avatar')) {
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();
        return redirect()->route('profile.show', $user->id);
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followers',compact('user'));
    }

    public function following($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.following',compact('user'));
    }

    public function passwordUpdate(Request $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        $request->validate([
            'c_password' => 'required|min:8|max:255',
            'n_password' => 'required|min:8|max:255|confirmed',

        ]);

        $c_password = $request->c_password;
        $n_password = $request->n_password;
        $confirm_password = $request->confirm_password;

        if (Hash::check($c_password,$user->password) && $n_password === $confirm_password) {
            $user->password = Hash::make($n_password);
            $user->save();

            return redirect()->route('profile.show', $user->id);
        } else {
            return back()->withErrors(['c_password' => 'Current password is incorrect.']);
        }



    }


}
