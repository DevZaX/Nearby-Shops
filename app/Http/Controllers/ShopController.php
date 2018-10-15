<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Shop;
use App\Shopprefered;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
{

    public function fetch(Request $request){
    	$res = [];

    	$shops = Shop::where('location', 'near', [
		'$geometry' => [
	          'type' => 'Point',
		    'coordinates' => [0.0, 0.0],
	    ],
	])->get();
    	foreach ($shops as $shop) {
    		if($shop->dislike != 1){
    			$res[] = $shop;  
    		}
    	}


        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($res);
        $perPage = 8;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

       
        return Response::json(["shops"=>$paginatedItems]);
    }

    public function dislike(Request $request){

    	$shop = Shop::find($request->id);
    	$shop->dislike = 1;
          $shop->time = $request->time;
    	$shop->save();

    	return Response::json(["shop"=>$shop]);

    }


   public function like(Request $request){
    $shop = Shop::find($request->shop_id);
    if($shop == null) return "shop not found";
    $shop->like = 1;
    $shopPrefered = new Shopprefered();
    $shopPrefered->name = $shop->name;
    $shopPrefered->id = $shop->_id;
    $shopPrefered->picture = $shop->picture;
    $shopPrefered->user_email = $request->user_email;
    $shopPrefered->save();
    $shop->save();
    return "ok";
   }

   public function prefered_shops(Request $request){
    $shops = Shopprefered::where("user_email",$request->user_email)->get();
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($shops);
        $perPage = 8;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
    return Response::json(["shops"=>$paginatedItems]);

   }

public function remove(Request $request){
    $shopPrefered = Shopprefered::find($request->id);
    $shop = Shop::find($request->shop_id);
    $shop->like = 0;
    $shop->save();
    $shopPrefered->delete();
    return "ok";
}



}
