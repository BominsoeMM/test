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
           <table class="table table-bordered table-hover">
               <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Post Count</th>
                    <th>Control</th>
                    <th>Created</th>
                </tr>
               </thead>
               <tbody>
               @forelse($categories as $category)
                <tr>
                   <td>{{$category->id}}</td>
                   <td>{{$category->title}}
                       <br>
                       <kbd class="badge bg-primary">
                            {{$category->user->name}}
                        </kbd>
                   <span class="badge bg-warning">
                       {{$category->slug}}
                   </span>
                   </td>
                    <th>{{$category->posts()->count()}}</th>
                    <td>
{{--                        @can('update',$category)--}}
                        <a class="btn btn-outline-warning" href="{{route('category.edit',$category->id)}}">
                           EDIT
                        </a>
{{--                        @endcan--}}
{{--                        @can('delete',$category)--}}
                        <form method="post" class="d-inline-block" action="{{route('category.destroy',$category->id)}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger">
                               DEL
                            </button>
                        </form>
{{--                            @endcan--}}
                    </td>
                    <td>
                        <p class="small ">
                            <i class="bi bi-calendar"></i>
                            {{$category->created_at->format('d M Y')}}
                        </p>
                        <p class="small mb-0 text-black-50">
                            <i class="bi bi-clock"></i>
                            {{ $category->created_at->format("h : m A") }}
                        </p>
                    </td>
               </tr>
               @empty
               @endforelse
               </tbody>
           </table>
        </div>
    </div>
@endsection
