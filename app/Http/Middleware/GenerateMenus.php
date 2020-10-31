<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		\Menu::make('MyNavBar', function ($menu) {
			$menu->add('Home');
			$menu->add('About', 'about-us');
			$menu->add('Dashboard', 'admin');
			$menu->add('Brands', 'brands');
			$menu->add('Categories', 'categories');
			$menu->add('Products', 'products');
			//$menu->add('Content', 'content');
			$menu->add('Users', 'admin/users');
			$menu->add('Subscribes', 'admin/subscribes');
			$menu->add('Settings', 'admin/settings');
			//$menu->add('Stats', 'stats');
		});

		return $next($request);
	}
}
