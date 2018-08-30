<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Posts;
use View;
class Helper
{

    /**
     * @return int
     */
    public static function totalProduct()
    {
    	$products=Posts::all()->count();
    	return $products;
    }
}