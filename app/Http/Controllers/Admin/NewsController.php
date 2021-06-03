<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $news = News::with('category')
		  ->orderBy('id', 'desc')
		  ->paginate(5);

      return view('admin.news.index', [
      	'newsList' => $news
	  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::all();
		return view('admin.news.create', [
			'categories' => $categories
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request)
    {
    	$request->validate([
    		'title' => ['required']
		]);

        $fields = $request->only('category_id', 'title', 'description', 'image');
        $fields['slug'] = \Str::slug($fields['title']);

        $news = News::create($fields);
        if($news) {
			return redirect()->route('news.index');
		}


        return back();
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
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
    	$categories = Category::all();
		return view('admin.news.edit', [
			'news' => $news,
			'categories' => $categories
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param News $news
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, News $news)
    {
		$request->validate([
			'title' => ['required']
		]);

		$fields = $request->only('category_id', 'title', 'description', 'image', 'status');
		$fields['slug'] = \Str::slug($fields['title']);


		$news = $news->fill($fields)->save();
		if($news) {
			return redirect()->route('news.index');
		}


		return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
