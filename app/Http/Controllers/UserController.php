<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Phone;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = $user->roles;

        $posts = $user->posts()->paginate(5);//->get();
        if($posts)
            foreach($posts as $post){
                $comments = $post->comments()->paginate(5);//->get();
            }

        $all_comments = $user->comments()->paginate(5);//()->paginate(5) added

        return view('users.show', compact('user', 'posts', 'comments', 'roles', 'all_comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = \App\Role::lists('role', 'id');
        $countries = \App\Country::lists('name', 'id');
        return view('users.edit', compact('user', 'roles', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)//$id
    {
        $this->validate($request, ['name' => 'required|max:30',
            'email' => 'required|max:60|email|unique:users,email,'.$user->id,
            'country_id' => 'integer|max:3',
            'phone' => 'string']);

        //$user->name = $request->name;//2
        //$user->email = $request->email;//2
        //$user->country()->associate($request->country_id);//2//update a belongs to
        //$user->save();//2

        if($user->phone->user_id){
            Phone::where('user_id', $user->id)->update(['name' => $request->phone]);
        }else{
            Phone::create(['user_id' => $user->id, 'name' => $request->phone]);//1
        }

        $user->roles()->sync(!$request->input('role_list') ? [] : $request->input('role_list'));

        $user->update($request->all());//1

        return redirect('users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$fallenOne = User::find($id);
        //$fallenOne = $user->find($user->id);
        $user->roles()->detach();
        $user->phone()->delete();
        
        foreach($user->posts() as $post){
            $post->comments()->delete();
        }

        $user->posts()->delete();
        
        $user->delete();
        return redirect('users');
    }
}
