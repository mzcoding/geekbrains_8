<?php

namespace App\Http\Controllers;

use App\Jobs\NewsJob;
use Illuminate\Http\Request;
use App\Services\ParserService;


class ParserController extends Controller
{
    public function  index()
	{
		$urls = [
			'https://news.yandex.ru/games.rss',
			'https://news.yandex.ru/internet.rss',
			'https://news.yandex.ru/cyber_sport.rss',
			'https://news.yandex.ru/movies.rss',
			'https://news.yandex.ru/cosmos.rss',
			'https://news.yandex.ru/culture.rss',
			'https://news.yandex.ru/championsleague.rss',
			'https://news.yandex.ru/music.rss',
			'https://news.yandex.ru/nhl.rss',
		];

		foreach($urls as $url) {
			NewsJob::dispatch($url);
		}

		echo "Операция выполнена";
	}
}
