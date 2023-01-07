<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public static function brandsForDropDown()
    {
        $brands = Brand::orderBy('id','ASC')->pluck('brandname','brandname');
        return $brands;
        response()->json(['brands'=>$brands]);
    }

    public function loadBrands()
    {
        $brands = ['LG','Samsung','Godrej','Videocon','Electrolux','Hitachi','Hafflie','liebherr','Other'];
        $data = [
            ['brandname'=>'LG', 'status'=>true],
            ['brandname'=>'Samsung', 'status'=>true],
            ['brandname'=>'Godrej', 'status'=>true],
            ['brandname'=>'Videocon', 'status'=>true],
            ['brandname'=>'Electrolux', 'status'=>true],
            ['brandname'=>'Hitachi', 'status'=>true],
            ['brandname'=>'Hafflie', 'status'=>true],
            ['brandname'=>'liebherr', 'status'=>true],
            ['brandname'=>'Other', 'status'=>true],
        ];
        Brand::insert($data);
        
    }
}
