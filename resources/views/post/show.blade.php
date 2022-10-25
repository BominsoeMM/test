@extends('layouts.app')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
         aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase"
                                           href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase"
                                           href="{{route('post.index')}}">POst</a></li>
            <li class="breadcrumb-item text-uppercase active" aria-current="page">POst Detail</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>{{$post->title}}</h4>
            <div class="">
                <span class="badge bg-dark">
                    <i class="bi bi-person-circle"></i>
                    {{ $post->user->name }}
                </span>
                <span class="badge bg-dark">
                    <i class="bi bi-tag"></i>
                    {{ $post->category->title }}
                </span>
                <span class="badge bg-dark">
                        <i class="bi bi-calendar"></i>
                        {{$post->created_at->format('d M Y')}}
                </span>
                <span class="badge bg-dark">
<i class="bi bi-clock"></i>
                                {{ $post->created_at->format("h : m A") }}
                </span>
            </div>
            <hr>
            <div class="mb-3 text-center">
                @isset($post->featured_image)
                    <img src="{{asset('storage/'.$post->featured_image)}}" class="w-50 mt-3 rounded" alt="">
                @endisset
            </div>
            <p>
                {{$post->description}}
            </p>
            <div class="mb-3  d-flex">
                @foreach($post->photos as $photo)
                    <div class="me-3">
                        <img src="{{asset('storage/'.$photo->name)}}" height="200" class="rounded text-center" alt="">
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-primary" href="{{route('post.index',$post->id)}}">
                  All Post
                </a>
                <a class="btn btn-primary" href="{{route('post.create')}}">
                    Create Post
                </a>
            </div>
        </div>
    </div>
@endsection