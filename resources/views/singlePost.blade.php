@extends('layouts.master')
@section('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/home-bg.jpg')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{$post->title}}</h1>
                        <span class="meta">Posted by
              <a href="#">{{$post->user->name}}</a>
              on {{date_format($post->created_at,'F d, Y')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! nl2br($post->content) !!}
                </div>
            </div>

    <!-- Post Comments -->
            <div class="comments">
                <hr>
                <h3>Comments</h3>
                @foreach($post->comments as $comment)
                    <hr>
                    <p>{{$comment->content}}</p>
                    <p><small>by {{$comment->user->name}}</small> on {{date_format($comment->created_at,'F d, Y')}}</p>
                @endforeach
                @if(Auth::check())
                    <form action="{{route('userNewComment')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" cols="30" rows="4" class="form-control" placeholder="Comment..."></textarea>
                            <input type="hidden" name="post" value="{{$post->id}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Make Comment</button>
                        </div>
                    </form>
                    @endif
            </div>
        </div>
    </article>
    <hr>
@endsection
