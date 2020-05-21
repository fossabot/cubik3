<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Show posts for a home page feed.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $userIds = $user->load('following')
            ->following
            ->pluck('id')
            ->all();
        $userIds[] = $user->id;
        $posts = Post::with('user:id,name,username,email')
            ->whereIn('user_id', $userIds)
            ->latest()
            ->paginate(30);
        return $posts;
    }

    /**
     * Store a new post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'min:1', 'max:8192'],
        ]);

        /** @var User $user */
        $user = Auth::user();
        $post = $user->posts()->create([
            'content' => $request->input('content'),
        ]);

        $post->load('user:id,name,username,email');
        return $post;
    }

    /**
     * Show a single post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Post $post)
    {
        $post->load('user:id,name,username,email');
        return $post;
    }

    /**
     * Show posts created by a user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showUser(User $user)
    {
        $posts = $user->posts()
            ->with('user:id,name,username,email')
            ->latest()
            ->paginate(30);
        return $posts;
    }
}
