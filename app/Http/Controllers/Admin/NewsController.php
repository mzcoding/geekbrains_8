<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreate;
use App\Models\Category;
use App\Models\News;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function store(NewsCreate $request, FileUploadService $uploadedService): \Illuminate\Http\RedirectResponse
	{
		$fields = $request->validated();
		$fields['slug'] = \Str::slug($fields['title']);
		$fields['image'] = $uploadedService->upload($request);

		$news = News::create($fields);
		if ($news) {
			return redirect()->route('news.index');
		}

		return back()->withInput();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
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
	public function update(Request $request, News $news, FileUploadService $uploadedService)
	{
		$request->validate([
			'title' => ['required']
		]);

		$fields = $request->only('category_id', 'title', 'description', 'image', 'status');
		$fields['slug'] = \Str::slug($fields['title']);
		$fields['image'] = $uploadedService->upload($request);

		$news = $news->fill($fields)->save();
		if ($news) {
			return redirect()->route('news.index')
				->with('success', 'Запись успешно обновлена');
		}


		return back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(News $news)
	{
		$status = $news->delete();
		if($status) {
			 return response()->json(['ok' => 'ok']);
		}
	}
}
