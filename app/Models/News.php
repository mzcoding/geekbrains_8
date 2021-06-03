<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    public function newsList()
	{
		return \DB::table($this->table)
			->join('categories', 'news.category_id', '=', 'categories.id')
			->select(['news.*', 'categories.title as category_title'])
			/*->where([
				['news.title', 'like', '%'. request()->query('q') .'%'],
				['news.id', '>', 1],
				['news.id', '<', 10]
			])*/
				->whereIn('news.id', [1,5,9])
			->orWhere('news.id', '>', 5)
			->orderBy('news.id', 'desc')
			->get();
	}

	public function news(int $id): object
	{
		return \DB::table($this->table)
			->select(['id', 'title', 'description', 'created_at'])
			->where(['id' => $id])
			->first();
	}
}
