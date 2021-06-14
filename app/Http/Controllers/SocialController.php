<?php

namespace App\Http\Controllers;

use App\Services\SocialService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function login()
	{
		return Socialite::driver('vkontakte')->redirect();
	}

	public function callback(SocialService $service)
	{
		return redirect(
			$service->login(
		      Socialite::driver('vkontakte')->user()
		));
	}
}
