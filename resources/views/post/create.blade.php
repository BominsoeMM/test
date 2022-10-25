@extends('layouts.app')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase" href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 text-uppercase" href="{{route('post.index')}}">Post</a></li>
            <li class="breadcrumb-item text-uppercase active" aria-current="page">Post Create</li>
        </ol>
    </nav>
    <div class="card d-flex">
        <div class="card-body">
            <h4 class="text-uppercase text-black-50">Post Create</h4>
            <hr>
            <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                        <input id="title"
                               class="form-control @error('title') is-invalid @enderror()"
                               value="{{old('title')}}"
                               name="title"
                               type="text">
                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Select Category</label>
                    <select id="category"
                           class="form-select @error('category') is-invalid @enderror()"
                           name="category"
                            type="text">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}} {{$category->id == old('category') ? 'selected' : ''}}"  >{{$category->title}}</option>
                        @endforeach

                    </select>
                    @error('category')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photos" class="form-label">Select Photo</label>
                    <input id="photos"
                           multiple
                           class="form-control @error('photos') is-invalid @enderror() @error('photos.*') is-invalid @enderror()"
                           name="photos[]"
                           type="file">
                    @error('photos')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @error('photos.*')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Post Title</label>
                    <textarea id="description"
                              class="form-control @error('description') is-invalid @enderror()"
                              rows="10"
                              name="description"
                              type="text">{{old('description')}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input id="featured_image"
                               class="form-control @error('featured_image') is-invalid @enderror()"
                               name="featured_image"
                               type="file">
                        @error('featured_image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="">
                        <button class="btn btn-outline-primary">POST</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection