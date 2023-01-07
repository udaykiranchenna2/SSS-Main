<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public static function pcatsForDropDown()
    {
        $pcats = ProductCategory::orderBy('id','ASC')->pluck('productcategory','productcategory');
        return $pcats;
        response()->json(['productcategories'=>$pcats]);
    }

    public function loadPcats()
    {
        $data = [
            ['productcategory'=>'Refrigerator', 'status'=>true],
            ['productcategory'=>'Washer Dryer', 'status'=>true],
            ['productcategory'=>'Washing Machines', 'status'=>true],
            ['productcategory'=>'Dishwashers', 'status'=>true],
            ['productcategory'=>'Ac', 'status'=>true],
            ['productcategory'=>'Cooler', 'status'=>true],
            ['productcategory'=>'Other', 'status'=>true],
        ];
        ProductCategory::insert($data);
        
    }
}
