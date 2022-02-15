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
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $this->authorize('show user');
        $users = UserListResource::collection(User::search()->paginate(10));
        return inertia('Users/Index', [
            "users" => fn () =>  $users
        ]);
    }
    public function create()
    {
        $this->authorize('create user');
        return inertia('Users/Create', [
            'roles' => Role::all()
        ]);
    }
    public function store(Request $request, CreateNewUser $newUser)
    {
        $this->authorize('create user');
        $newUser->create($request->all());
        return redirect()->route('users.index');
    }
    public function edit(User $user, Request $request)
    {
        $this->authorize('update user');
        return inertia('Users/Edit', [
            "editAbleUser" => fn () => $user,
            'sessions' => UserService::sessions($user, $request)->all(),
        ]);
    }
    public function update(Request $request, User $user, StatefulGuard $guard)
    {
        $this->authorize('update user');
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
    public function destroy(Request $request, User $user)
    {
        $this->authorize('destroy user');
        $this->middleware(['password.confirm']);
        DeleteUser::delete($user, $request->all());
        return redirect()->route('users.index');
    }
}
