<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
use App\Category;
use App\Language;
use Auth;
use App\SubSubCategory;
use Session;
use ImageOptimizer;
use DB;
use CoreComponentRepository;

class CollectionController extends Controller {

    public function collections_list(Request $request) {
        $type = 'Collection';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $collections = DB::table('collections');

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                    ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $collections = DB::table('collections')->orderBy('created_at', 'desc')->paginate(15000000);

        return view('collections.index', compact('collections', 'type', 'col_name', 'query', 'sort_search'));
    }

    public function collections_create() {
        $products = '';
        $products = Product::all()->where('published', '1');
        return view('collections.create', compact('products'));
    }

    public function collections_store(Request $request) {

        if ($request->name != null) {
            $name = $request->name;
            $price = $request->price;
            $tags = $request->tags;
            $description = $request->description;

            if (Auth::user()->user_type == 'seller') {
                $user_id = Auth::user()->id;
                $added_by = 'seller';
            } else {
                $user_id = \App\User::where('user_type', 'admin')->first()->id;
                $added_by = 'admin';
            }
            $thumbnail_img = '';
            if ($request->thumbnail_img != null) {
                $thumbnail_img = $request->thumbnail_img->store('uploads/collections/thumbnail');
            }
            $collection_id = DB::table('collections')->insertGetId([
                'name' => $name,
                'added_by' => $added_by,
                'user_id' => $user_id,
                'brand_id' => 0,
                'description' => $description,
                'unit_price' => $price,
                'search_tag' => $tags,
                'thumbnail_img' => $thumbnail_img,
                'status' => 1
            ]);
        }
        if ($request->products != null) {
            // add products in the product table
            foreach ($request->products as $product) {
                echo $product;
                DB::table('products_collection')->insert([
                    'collection_id' => $collection_id,
                    'product_id' => $product,
                ]);
            }
        }
        flash(__('Collection has been added successfully'))->success();
        return redirect()->route('collections.admin');
        dd($request);
    }

    public function collections_edit($id) {
        $id = $colid = decrypt($id);
        $collections = DB::table('collections')->where('id', $id)->get()->first();
        $products = Product::all()->where('published', '1');
        $products_collection = DB::table('products_collection')->select('product_id')->where('collection_id', $id)->get();
        $pro_col_array = array();
        foreach ($products_collection as $p_c) {
            $pro_col_array[] = $p_c->product_id;
        }
        $products_collection = $pro_col_array;

        return view('collections.edit', compact('products', 'collections', 'products_collection', 'colid'));
    }

    public function collections_update(Request $request, $id) {
        if ($request->name != null) {
            $name = $request->name;
            $price = $request->price;
            $tags = $request->tags;
            $description = $request->description;

            if (Auth::user()->user_type == 'seller') {
                $user_id = Auth::user()->id;
                $added_by = 'seller';
            } else {
                $user_id = \App\User::where('user_type', 'admin')->first()->id;
                $added_by = 'admin';
            }
            $thumbnail_img = '';
            if ($request->thumbnail_img != null) {
                $thumbnail_img = $request->thumbnail_img->store('uploads/collections/thumbnail');
                DB::table('collections')->where('id', $id)->update([
                    'thumbnail_img' => $thumbnail_img,
                ]);
            }
            DB::table('collections')->where('id', $id)->update([
                'name' => $name,
                'description' => $description,
                'unit_price' => $price,
                'search_tag' => $tags,
                'status' => 1
            ]);
        }
        DB::table('products_collection')->where('collection_id', $id)->delete();
        if ($request->products != null) {
            // add products in the product table
            foreach ($request->products as $product) {
                echo $product;
                DB::table('products_collection')->insert([
                    'collection_id' => $id,
                    'product_id' => $product,
                ]);
            }
        }
        flash(__('Collection has been Updated successfully'))->success();
        return redirect()->route('collections.admin');
    }

    public function collections_delete($id) {
        DB::table('products_collection')->where('collection_id', $id)->delete();
        DB::table('collections')->where('id', $id)->delete();
        flash(__('Collection has been deleted successfully'))->success();
        return redirect()->route('collections.admin');
    }
    
    // font end pages
    
    public function lookbook() {
        $collections = DB::table('collections')->orderBy('created_at', 'desc')->paginate(15000000);
        return view('frontend.collections.collections',compact('collections'));
    }
    public function collection_details($id){
        $collection = DB::table('collections')->orderBy('created_at', 'desc')->where('id',$id)->first();
//        $products = DB::table(' products_collection')
//            ->join('products', 'products.id', '=', ' products_collection.product_id')
//            ->where('products_collection.collection_id',$id)
//            ->select('products_collection.*,products.*')
//            ->get();
        $products=DB::select("SELECT * FROM products WHERE products.id IN (SELECT products_collection.product_id from products_collection WHERE products_collection.collection_id=$id)");
        return view('frontend.collections.details',compact('collection','products'));
    }

}
