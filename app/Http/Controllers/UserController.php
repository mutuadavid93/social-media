<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Resources\AllPostsCollection;

class UserController extends Controller
{
    public function index()
    {
        // Get all the posts where the user_id is equal to logged in user id
        // Order it by created_at in descending order
        // $posts = Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        // TIP: Try alternative syntax to retrieve from relationship of authenticated user.
        // NOTE: if the relationship method in the User model is named posts, then below works.
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->get();

        return Inertia::render("User", [
            // Reuse AllPostsCollection Resource.
            "posts" => new AllPostsCollection($posts)
        ]);
    }

    /**
     * Display the specified resource. i.e. /user/$id e.g. /user/1
     */
    public function show(string $id)
    {
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $payload = $posts->count() ? new AllPostsCollection($posts) : [];

        return Inertia::render("User", [
            "user" => User::find($id),
            "posts" => $payload
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request)
    {
        // Validate to make sure image is present
        $request->validate(["image" => "required|mimes:png,jpg,jpeg"]);
        $user = (new ImageService())->updateImage(auth()->user(), $request);
        $user->save();
    }
}
