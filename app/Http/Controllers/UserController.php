<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show a user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        $user->makeHidden(['email', 'email_verified_at', 'created_at', 'updated_at']);
        return $user;
    }

    /**
     * Follow a user.
     *
     * @return array
     */
    public function follow(User $user)
    {
        /** @var User $me */
        $me = Auth::user();
        $me->following()->attach($user->id);
        return [
            'id' => $user->id,
            'following' => true,
        ];
    }

    /**
     * Un-follow a user.
     *
     * @return array
     */
    public function unfollow(User $user)
    {
        /** @var User $me */
        $me = Auth::user();
        $me->following()->detach($user->id);
        return [
            'id' => $user->id,
            'following' => false,
        ];
    }

    /**
     * Get a paginated list of the users the given user is following.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function following(User $user)
    {
        // TODO: limit to publicly showable fields
        return $user->following()->paginate(30);
    }

    /**
     * Get a paginated list of the users following the given user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function followers(User $user)
    {
        // TODO: limit to publicly showable fields
        return $user->followers()->paginate(30);
    }
}
