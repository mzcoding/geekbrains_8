<?php declare(strict_types=1);


namespace App\Services;


use App\Contracts\ParserServiceContract;

class ParserService implements ParserServiceContract
{
	/**
	 * @param string $url
	 * @return array
	 */
	public function getNews(string $url): array
	{
		$xml = \XmlParser::load($url);
		return $xml->parse([
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
	}
}