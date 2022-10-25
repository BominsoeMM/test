@extends('layouts.app')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase" href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase" href="{{route('category.index')}}">Category</a></li>
            <li class="breadcrumb-item text-uppercase active" aria-current="page">Create Category</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4 class="text-uppercase text-black-50">Create Category</h4>
            <hr>
            <form method="post" action="{{route('category.store')}}">
                @csrf
                <div class="row">
                    <div class="col">
                        <input class="form-control @error('title') is-invalid @enderror()" value="{{old('title')}}" name="title" type="text">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">ADD Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection