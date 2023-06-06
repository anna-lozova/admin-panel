<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{

    /**
     * @return Collection
     * Get all users
     */
    public function show(): Collection
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return mixed
     * Show 1 user by id
     */
    public function getById(int $id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param UserUpdateRequest $request
     * @return void
     */
    public function update(int $id, UserUpdateRequest $request): void
    {
        $user = User::where('id', $id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->image = $request->image;
        $user->role = $request->role;
        $user->save()->validated();
    }

    /**
     * @param int $id
     * @return void
     * Delete without restoring 1 user by id
     */
    public function delete(int $id): void
    {
        $users = User::all();

        $users->find($id)->limit(1)->delete();
    }

    public function create(UserCreateRequest $request): void
    {
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'image' => $request->image,
            'role' => $request->role,
        ])->validated();
    }
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);

        User::create([
            'first_name' => $user->user['given_name'],
            'last_name' => $user->user['family_name'],
            'email' => $user->user['email'],
            'image' => $user->user['picture'],
            'role'=>'guest'
        ]);
        return 'User was '.$user->user['email'].' created';
    }

}
