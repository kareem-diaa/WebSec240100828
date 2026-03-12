@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input required type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea required type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="{{old('description')}}"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select required class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>

@endsection