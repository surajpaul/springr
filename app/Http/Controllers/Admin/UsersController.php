<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $req)
    {
        $avatar_name = $req->avatar;
        $avatar = $req->file('avatar');
        if($avatar != ''){
            $avatar_name = rand() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('storage/users'), $avatar_name);
        }

        $date_of_joining = new DateTime($req->date_of_joining);
        $date_of_leaving = new DateTime($req->date_of_leaving);
        if($date_of_joining < $date_of_leaving){
            $exp = $date_of_joining->diff($date_of_leaving)->format('%y years %m months and %d days');

            $users = new User();
            $users->avatar = 'users/'.$avatar_name;
            $users->email = $req->get('email');
            $users->name = $req->get('name');
            $users->exp = $exp;
            $users->date_of_joining = $req->date_of_joining;
            $users->date_of_leaving = $req->date_of_leaving;
            $users->password = Hash::make(Str::random(8));
            $users->role_id = 2;
            $users->save();
            return redirect('/admin/users')->with('success', 'New user has been added.');
        }else{
            return redirect('/admin/users')->with('failure', 'Date of Joning must be smaller than current date.');
        }       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        $user = User::findOrFail($req->id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $req)
    {
        $avatar_name = $req->hidden_avatar;
        $avatar = $req->file('avatar');
        if($avatar != ''){
            $avatar_name = rand() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('storage/users'), $avatar_name);
        } else{}

        $date_of_joining = new DateTime($req->date_of_joining);
        $date_of_leaving = new DateTime($req->date_of_leaving);

        if($date_of_joining < $date_of_leaving){
            $exp = $date_of_joining->diff($date_of_leaving)->format('%y years %m months and %d days');
            if(isset($req->avatar)){
                $avatar_name = 'users/'.$avatar_name;
            }
            $form_data = array(
                'name' => $req->name,
                'email' => $req->email,
                'avatar' => $avatar_name,
                'exp' => $exp,
                'date_of_joining' => $req->date_of_joining,
                'date_of_leaving' => $req->date_of_leaving,
            );

            User::whereId($req->id)->update($form_data);
            return redirect('/admin/users')->with('success', 'User has been updated.');
        }else{
            return redirect('/admin/users')->with('failure', 'Date of Joning must be smaller than current date.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        if(isset($req->id)){
            $user = User::whereId($req->id)->delete();
            return redirect('/admin/users')->with('success', 'User removed successfully.');
        }
        return redirect('/admin/users')->with('failure', 'User not removed successfully.');
    }
}
