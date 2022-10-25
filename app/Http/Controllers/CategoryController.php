<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest("id")
            ->when(Auth::user(), function ($q) {
                return $q->where('user_id', Auth::id());
            })->with('user')
            ->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $categories = new Category();
            $categories->title = $request->title;
            $categories->slug = Str::slug($request->title);
            $categories->user_id = Auth::id();
            $categories->save();
            DB::commit();
            return redirect()->route('category.index')->with('toast',Info::showToast('success',strtoupper($categories->title) .  ' is added Successfully.'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('category.index')->with('toast',Info::showToast('error',strtoupper($categories->title) .  ' is added Fail.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->title = $request->title;
            $category->slug = Str::slug($request->title);
            $category->update();
            DB::commit();
            return redirect()->route('category.index')->with('toast',Info::showToast('success',strtoupper($category->title) .  ' is update Successfully.'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('category.index')->with('toast',Info::showToast('error',strtoupper($category->title) .  ' is update Fail.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $categoryTitle = $category->title;
            $category->delete();
            DB::commit();
            return redirect()->route('category.index')->with('toast',Info::showToast('success',strtoupper($categoryTitle) .  ' is deleted successfully.'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('category.index')->with('toast',Info::showToast('error',strtoupper($categoryTitle) .  ' is deleted Fail.'));
        }
    }
}
