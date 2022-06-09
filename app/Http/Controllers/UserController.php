<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Container\Container;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with('gifts')->orderBy('name')->get();
        $gifts = Gift::get();

        return view('users', compact(['users', 'gifts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker = Container::getInstance()->make(Generator::class);
        $user = new User();
        $user->name = $request->name;
        $user->email = $faker->unique()->safeEmail();
        $user->email_verified_at = now();
        $user->password = bcrypt($faker->word() . rand(123, 456));
        $user->remember_token = Str::random(10);
        $user->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $user=User::where('id', $user->id)->with('gifts')->first();//Вот результат который дает тот респонс который был в TЗ

        $gifts = Gift::where('user_id', $user->id)->get();//Вызывает список подарков который принадлежат этому пользователю - 
        return view('show', compact(['user', 'gifts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
