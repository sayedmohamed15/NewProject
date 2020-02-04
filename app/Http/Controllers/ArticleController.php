<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create',[
            'tags'=>Tag::all()
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateInputes= $this->validateRequest($request);

//        $newArticle=Article::firstOrCreate($validateInputes);
//        dd($newArticle);


        $article = new Article($validateInputes);
        $article->user_id=1;
//
//        $article->title=request('title');
//        $article->excerpt=request('excerpt');
//        $article->body=request('body');
        $article->save();
        $article->tags()->attach($request['tags']);
        return redirect(route('article.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
//        $article = Article::findOrFail($id);
        return view('articles/edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validateUpdate= $this->validateRequest($request);
        $article->update($validateUpdate);
//        $article = Article::find($id);
//        $article->title=request('title');
//        $article->excerpt=request('excerpt');
//        $article->body=request('body');
//        $article->save();
        return redirect('/article/'.$article->id.'/edit');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags'=>'exists:tags,id'
        ]);
    }
}
