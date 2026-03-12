@extends('layouts.app')

@section('title')
    Index Posts
@endsection


@section('content')
    

    <div class="text-center mb-4">
        <a href="{{route('posts.create')}}" type="button" class="btn btn-success">Create Post</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Posted By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->user ? $post->user->name : 'not found'}}</td>
                        <td>{{$post->created_at->format('Y-M-N')}}</td>
                        <td>
                            <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Edit</a>
                            <form method="POST" action="{{route('posts.destroy', $post->id)}}" style="display:inline" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                        </td>
                    </tr>     
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this post?");
    }
</script>
@endsection