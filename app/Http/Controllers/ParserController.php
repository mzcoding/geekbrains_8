<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParserService;


class ParserController extends Controller
{
    public function  index(ParserService $service)
	{
        dd($service->getNews('https://news.yandex.ru/music.rss'));
	}
}
