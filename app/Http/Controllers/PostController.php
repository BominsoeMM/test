<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Info;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->orWhere("title", "like", "%$keyword%")->orWhere("description", "like", "%$keyword%");
        })
            ->when(Auth::user(), function ($q) {
                return $q->where('user_id', Auth::id());
            })
            ->latest('id')->with(['category', 'user'])->paginate(10)->withQueryString();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $posts = new Post();
            $posts->title = $request->title;
            $posts->slug = Str::slug($request->title);
            $posts->description = $request->description;
            $posts->excerpt = Str::words($request->description, 50, " .....");
            $posts->user_id = Auth::id();
            $posts->category_id = $request->category;
            if ($request->hasFile('featured_image')) {
                $newName = uniqid() . 'featured_image.' . $request->file('featured_image')->extension();
                $request->file('featured_image')->storeAs('public', $newName);
                $posts->featured_image = $newName;
            }
            $posts->save();
            foreach ($request->photos as $photo) {
                $newName = uniqid() . 'photos.' . $photo->extension();
                $photo->storeAs('public', $newName);
                $photo = new Photo();
                $photo->post_id = $posts->id;
                $photo->name = $newName;
                $photo->save();
            }
            DB::commit();
            return redirect()->route('post.index')->with('toast', Info::showToast('success', ' Post Created Successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('post.index')->with('toast', Info::showToast('error', ' Post Created Fail.'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        DB::beginTransaction();
        try {
            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->description = $request->description;
            $post->excerpt = Str::words($request->description, 50, " .....");
            $post->user_id = Auth::id();
            $post->category_id = $request->category;

            if ($request->hasFile('featured_image')) {
                Storage::delete('public/' . $post->featured_image);
                $newName = uniqid() . 'featured_image.' . $request->file('featured_image')->extension();
                $request->file('featured_image')->storeAs('public', $newName);
                $post->featured_image = $newName;
            }
            $post->update();
            foreach ($request->photos as $photo) {
                $newName = uniqid() . 'photos.' . $photo->extension();
                $photo->storeAs('public', $newName);
                $photo = new Photo();
                $photo->post_id = $post->id;
                $photo->name = $newName;
                $photo->save();
            }
            DB::commit();
            return redirect()->route('post.index')->with('toast', Info::showToast('success', ' Post Updated Successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('post.index')->with('toast', Info::showToast('error', ' Post Updated Fail.'));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            $postTitle = $post->title;
            if (isset($post->featured_image)) {
                Storage::delete('public/' . $post->featured_image);
            }
            foreach ($post->photos as $photo){
                Storage::delete('public/' . $photo->name);
                $photo->delete();
            }
            $post->delete();
            DB::commit();
            return redirect()->route('post.index')->with('toast', Info::showToast('success', strtoupper($postTitle) . ' is deleted successfully.'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('post.index')->with('toast', Info::showToast('error', strtoupper($postTitle) . ' is deleted successfully.'));

        }
    }
}
