@extends('layouts.master')
@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('assets/img/home-bg.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Celebrity news</h1>
                    <span class="subheading">Most Popular News Headlines</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{route('singlePost', $post->id)}}">
                    <h2 class="post-title">
                        {{$post->title}}
                    </h2>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">{{$post->user->name}}</a>
                    on {{date_format($post->created_at,'F d, Y') }} |
                    <i class="fa fa-comment" aria-hidden="true"></i> {{ $post->comments->count() }}
                </p>
            </div>
            <hr>
            @endforeach

            <!-- Pagination -->
            {{$posts->links()}}
    </div>
</div>

<hr>
@endsection
