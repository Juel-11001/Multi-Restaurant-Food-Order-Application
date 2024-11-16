<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $banners=Banner::where('status',1)->latest()->limit(4)->get();
        $clients=Client::latest()->where('status',1)->limit(4)->get();
        foreach ($clients as $client) {
            $client->menus = $this->menu($client->id);
            $coupons = Coupon::where('client_id', $client->id)->where('status', 1)->first();
            $client->coupons = $coupons;
        }

        return view('frontend.home.home', compact('banners','clients'));
    }
    public function menu($client_id) 
    {
        return Menu::where('client_id', $client_id)
            ->where('status', 1)
            ->take(3)
            ->pluck('name');
    }
}
