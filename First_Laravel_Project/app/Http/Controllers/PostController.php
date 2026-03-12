<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all(); 
        
        // $allPosts = [
        //     ['id' => 1, 'title' => 'PHP', 'posted_by' => 'Ahmed', 'created_at' => '2026-02-02 09:00:00'],
        //     ['id' => 2, 'title' => 'HTML', 'posted_by' => 'Mohamed', 'created_at' => '2026-02-02 10:00:00'],
        //     ['id' => 3, 'title' => 'JS', 'posted_by' => 'Kareem', 'created_at' => '2026-02-02 11:00:00'],
        //     ['id' => 4, 'title' => 'CSS', 'posted_by' => 'Omar', 'created_at' => '2026-02-02 12:00:00']
        // ];
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    public function show(Post $post) // route model binding (type hinting). Syntax: Model_class $parameter
    {
        // without the route model binding:
        // $singlePostFromDB = Post::findOrFail($postId); // findOrFail functions find the id or throws 404 error execption to the view if failed

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        // $request = request();
        // @dd($request->title, $request->all());

        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],

        ]);
        

        // 1- get the user data (select)
        $data = request()->all();  
        
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;


        // 2- store the submitted data into the database

        // WAY 1
        // $post = new Post;

        // $post->title = $title;
        // $post->description = $description;
        
        // $post->save();


        // WAY 2
        Post::create([ // needs the fillable array in Post.php
            // column name => 
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        // 3- redirection
        return to_route('posts.index');
        
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', [
            'users' => $users,
            'post'  => $post,
        ]);
    }

    public function update(Post $post)
    {   
        // 1- validate/collect request data from the user 
        $data = request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
        
        // 2- update the submitted data to database
        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);


        // 3- redirection to posts.show
        return to_route('posts.show', $post);
    }

    public function destroy(Post $post)
    {   
        $post->delete();
        
        return to_route('posts.index')
        ->with('status', "Post '{$post->title}' has been deleted.");
        
    }
    }

