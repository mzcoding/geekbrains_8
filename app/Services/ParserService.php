<?php declare(strict_types=1);


namespace App\Services;


use App\Contracts\ParserServiceContract;

class ParserService implements ParserServiceContract
{

	/**
	 * @param string|null $url
	 * @return void
	 */
	public function getNews(string $url): void
	{

		$e = explode("/", $url);
		$endElement = end($e);
		$xml = \XmlParser::load($url);
		$data =  $xml->parse([
			'title' => [
				'uses' => 'channel.title'
			],
			'link' => [
				'uses' => 'channel.link'
			],
			'description' => [
				'uses' => 'channel.description'
			],
			'image' => [
				'uses' => 'channel.image.url'
			],
			'news' => [
				'uses' => 'channel.item[title,link,guid,description,pubDate]'
			]
		]);

		$dataSerialize = serialize($data);
		\Storage::put('parsing/' . $endElement . ".txt", $dataSerialize);
	}
}