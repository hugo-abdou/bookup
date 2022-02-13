<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Facades\{
    App\Actions\Jetstream\DeleteUser,
    App\Actions\Fortify\UpdateUserProfileInformation,
    App\Actions\Fortify\UpdateUserPassword,
    App\Services\UserService
};
use App\Http\Resources\UserListResource;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserListResource::collection(User::search()->paginate(10));

        return inertia('Users/Index', [
            "users" => fn () =>  $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateNewUser $newUser)
    {
        $newUser->create($request->all());
        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        return inertia('Users/Edit', [
            "editAbleUser" => fn () => $user,
            'sessions' => UserService::sessions($user, $request)->all(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, StatefulGuard $guard)
    {
        switch ($request->action) {
            case 'destroy_photo':
                $user->deleteProfilePhoto();
                break;
            case 'update_password':
                UpdateUserPassword::update($user, $request->all());
                break;
            case 'destroy_sessions':
                UserService::destroy($request, $user, $guard);
                break;

            default:
                UpdateUserProfileInformation::update($user, $request->all());
                break;
        }
        return back(303);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        DeleteUser::delete($user, $request->all());
        return redirect()->route('users');
    }
}
