<?php declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


class FileUploadService
{
	/**
	 * @param Request $request
	 * @return string
	 * @throws \Exception
	 */
  public function upload(Request $request): string
  {
	  if($request->hasFile('image')) {
		  $file = $request->file('image');

		  $originalExt = $file->getClientOriginalExtension();
		  $fileName = Str::random(10) . "." . $originalExt;
		  $fileUploaded = $file->storeAs('news', $fileName, 'public');
		  if($fileUploaded === false) {
		  	 throw new \Exception("File upload equals false");
		  }

		  return $fileUploaded;
	  }

	  throw new \Exception("File upload errors");
  }
}