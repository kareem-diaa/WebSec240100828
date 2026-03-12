@extends('layouts.app')

@section('title')
    Edit Post
@endsection

@section('content')

    <form method="POST" action="{{route('posts.update', $post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input required type="text" value="{{$post->title}}" class="form-control" id="exampleFormControlInput1" name="title">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea required type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$post->description}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select required class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option @if($user->id == $post->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                @endforeach 
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection