<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\ArticleCollection;
use App\Model\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.article.index', compact('categories'));
    }

    public function jsonData(Request $request)
    {
        $model = Article::query();
        $limit = $request->limit ?: 15;
        if ($request->has('category_id')) {
            $model = $model->where('category_id', $request->get('category_id'));
        }
        if ($request->has('title')) {
            $model = $model->where('title', 'like', '%' . $request->get('title') . '%');
        }
        $article = $model->with('category')->orderBy('updated_at', 'desc')->paginate($limit);
        return new ArticleCollection($article);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
