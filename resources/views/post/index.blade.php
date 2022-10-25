@extends('layouts.app')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase" href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active text-uppercase" aria-current="page">Category</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Manage Category</h4>
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                   @if(request('keyword'))
                    <span class="">Search By : ' {{request('keyword')}} '</span>
                    <a href="{{route('post.index')}}"><i class="bi bi-x-circle-fill"></i></a>
                    @endif
                </div>
                <form method="get" action="{{route('post.index')}}">
                    <div class="input-group">
                        <input class="form-control" placeholder="search anything" type="text" name="keyword">
                        <button class="btn btn-outline-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Control</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}
                            <br>
                            <span class="badge bg-warning">
                            {{$post->category->title}}
                        </span>
                            <span class="badge bg-primary">
                            {{$post->user->name}}
                        </span>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{route('post.show',$post->id)}}">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a class="btn btn-outline-warning" href="{{route('post.edit',$post->id)}}">
                                <i class="bi bi-pen-fill"></i>
                            </a>
                            <form method="post" class="d-inline-block" action="{{route('post.destroy',$post->id)}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger">
                                    <i class="bi bi-trash2"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <p class="small ">
                                <i class="bi bi-calendar"></i>
                                {{$post->created_at->format('d M Y')}}
                            </p>
                            <p class="small mb-0 text-black-50">
                                <i class="bi bi-clock"></i>
                                {{ $post->created_at->format("h : m A") }}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">There is no post</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="">
                {{$posts->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
@endsection
