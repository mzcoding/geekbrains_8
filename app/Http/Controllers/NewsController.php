<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
	{
		$model = new News();
		return view('news.index', [
			'newsList' => $model->newsList()
		]);
	}

	public function show(int $id)
	{
		$model = new News();
		$news = $model->news($id);
		return view('news.show', [
			'news' => $news
		]);
	}
}
