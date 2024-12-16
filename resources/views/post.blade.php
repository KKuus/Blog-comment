@extends('partials.layout')
@section('title', 'Home page')
@section('content')
    <div class="container mx-auto">
        {{-- Post content --}}
        @include('partials.post-card', ['full' => true])

        {{-- Comments section --}}
        <h2 class="text-2xl font-bold mt-6">Comments</h2>
        @foreach($post->comments()->latest()->get() as $comment)
            <div class="card bg-base-300 shadow-xl mt-3">
                <div class="card-body">
                    <p class="text-lg">{{$comment->body}}</p>
                    <p class="text-base-content font-semibold">{{$comment->user->name}}</p>
                    <p class="text-neutral-content text-sm">{{$comment->created_at->diffForHumans()}}</p>
                </div>
            </div>
        @endforeach

        {{-- Add Comment Form --}}
        <div class="card bg-base-200 shadow-lg mt-6">
            <div class="card-body">
                <h3 class="text-xl font-bold mb-4">Add a Comment</h3>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    {{-- Post ID (hidden input) --}}
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    {{-- Comment body --}}
                    <div class="form-control mb-4">
                        <textarea 
                            name="body" 
                            class="textarea textarea-bordered w-full" 
                            placeholder="Write your comment here..." 
                            required></textarea>
                    </div>

                    {{-- Submit button --}}
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
