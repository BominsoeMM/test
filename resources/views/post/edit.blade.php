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
            <form method="post" action="{{route('post.update',$post->id)}}" id="postUpdateForm" enctype="multipart/form-data">
                @csrf
                @method('put')
            </form>
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input id="title"
                           class="form-control @error('title') is-invalid @enderror()"
                           value="{{old('title',$post->title)}}"
                           name="title"
                           form="postUpdateForm"
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
                            form="postUpdateForm"
                            type="text">
                        @foreach(\App\Models\Category::all() as $category)
                            <option form="postUpdateForm" value="{{$category->id}} {{$category->id == old('category',$post->category) ? 'selected' : ''}}"  >{{$category->title}}</option>
                        @endforeach

                    </select>
                    @error('category')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="mb-2 d-flex">
                        @foreach($post->photos as $photo)
                            <div class="position-relative me-3">
                                <img src="{{asset('storage/'.$photo->name)}}" height="100" class="rounded" alt="">
                                <form action="{{route('photo.destroy',$photo->id)}}" class="d-inline-block" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm  position-absolute bottom-0 end-0">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        <label for="photos" class="form-label">Select Photo</label>
                        <input id="photos"
                               multiple
                               class="form-control @error('photos') is-invalid @enderror() @error('photos.*') is-invalid @enderror()"
                               name="photos[]"
                               form="postUpdateForm"
                               type="file">
                        @error('photos')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        @error('photos.*')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Post Title</label>
                    <textarea id="description"
                              class="form-control @error('description') is-invalid @enderror()"
                              rows="10"
                              name="description"
                              form="postUpdateForm"
                              type="text">{{old('description',$post->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        @isset($post->featured_image)
                            <img src="{{asset('storage/'.$post->featured_image)}}" height="70" class="rounded me-3" alt="">
                        @endisset
                        <div class="">
                            <label for="featured_image" class="form-label">Select Image</label>
                            <input id="featured_image"
                                   class="form-control @error('featured_image') is-invalid @enderror()"
                                   name="featured_image"
                                   form="postUpdateForm"
                                   type="file">
                            @error('featured_image')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <button form="postUpdateForm" class="btn btn-outline-primary">Update</button>
                    </div>
                </div>
        </div>
    </div>
@endsection