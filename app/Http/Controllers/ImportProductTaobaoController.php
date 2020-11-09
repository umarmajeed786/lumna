<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTblModel;
use App\Category;
use App\Product;
use App\ProductStock;
use Auth;

class ImportProductTaobaoController extends Controller
{
    //
    protected $product_table_model;
    protected $product_model;
    protected $product_stock_model;
    public function __construct()
    {
        $this->product_table_model = new ProductTblModel();
        $this->product_model       = new Product();
        $this->product_stock_model = new ProductStock();
    }
    
    public function index(){
        $categories = Category::all();
        return view('import_product_taobao.index',compact('categories'));
    }

    /* call api and process */
    public function store_products(Request $request){
        $this->validate($request, [
            'product_id' => 'required'
        ]);
        $product_id = $request->product_id;

        /*get User_ID and User_Type to save in database*/
        if(Auth::user()->user_type == 'seller'){
            $user_id = Auth::user()->id;
            $user_type = 'seller';
        }
        else{
            $user_id = \App\User::where('user_type', 'admin')->first()->id;
            $user_type = 'admin';
        }
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $subsubcategory_id = $request->subsubcategory_id;
        /*get User_ID and User_Type to save in database*/

        if ( strpos( $product_id, ',' ) !== false ) {
            $product_ids = explode(',',$product_id);
            foreach ($product_ids as $product){
                if (strpos($product,'?id=') !== false){
                    $id = explode('?id=',$product);
                    $id = $id[1];
                    /* testing testing */
                    $json = json_decode(file_get_contents('https://www.lovbuy.com/taobaoapi/getproductinfo.php?key=bd93c95448cd07fb34b5d3d16541f7f9&item_id='.$id), true);
                    $status = $json['status'];
                    if ($status == 510){
                        flash(__('Balance is not enough. Make sure your account balance >=5 CNY'))->error();
                    } elseif ($status == 500){
                        flash(__('Something went wrong, please try again'))->error();
                    } elseif ($status == 501){
                        flash(__('API key is not correct'))->error();
                    } elseif ($status == 505){
                        flash(__('Miss required parameter'))->error();
                    } elseif ($status == 544){
                        flash(__('Fail to get'))->error();
                    } elseif ($status == 200){
                        $product_details = $json['productinfo'];
                        $price = $product_details['price']*2;
                        
                        $data = array(
                            'num_iid'   => $product_details['num_iid'],
                            'product_id'   => $product_details['num_iid'],
                            'title'   => $product_details['title'],
                            'desc_short'   => $product_details['desc_short'],
                            'price'   => $price,
                            'total_price'   => $price,
                            'suggestive_price'   => $price,
                            'orginal_price'   => $product_details['price'],
                            'nick'   => $product_details['nick'],
                            'num'   => $product_details['num'],
                            'min_num'   => $product_details['min_num'],
                            'detail_url'   => $product_details['detail_url'],
                            'pic_url'   => $product_details['pic_url'],
                            'brand'   => $product_details['brand'],
                            'cid'   => $product_details['cid'],
                            'rootCatId'   => $product_details['rootCatId'],
                            'crumbs'   => json_encode($product_details['crumbs']),
                            'created_time'   => $product_details['created_time'],
                            'modified_time'   => $product_details['modified_time'],
                            'delist_time'   => $product_details['delist_time'],
                            'desc'   => $product_details['desc'],
                            'desc_img'   => json_encode($product_details['desc_img']),
                            'item_imgs'   => json_encode($product_details['item_imgs']),
                            'item_weight'   => $product_details['item_weight'],
                            'item_size'   => $product_details['item_size'],
                            'location'   => $product_details['location'],
                            'post_fee'   => $product_details['post_fee'],
                            'express_fee'   => $product_details['express_fee'],
                            'ems_fee'   => $product_details['ems_fee'],
                            'shipping_to'   => $product_details['shipping_to'],
                            'has_discount'   => $product_details['has_discount'],
                            'video'   => json_encode($product_details['video']),
                            'is_virtual'   => $product_details['is_virtual'],
                            'sample_id'   => $product_details['sample_id'],
                            'is_promotion'   => $product_details['is_promotion'],
                            'props_name'   => $product_details['props_name'],
                            'prop_imgs'   => json_encode($product_details['prop_imgs']),
                            'property_alias'   => $product_details['property_alias'],
                            'props'   => json_encode($product_details['props']),
                            'skus'   => json_encode($product_details['skus']),
                            'seller_id'   => $product_details['seller_id'],
                            'sales'   => $product_details['sales'],
                            'shop_id'   => $product_details['shop_id'],
                            'props_list'   => json_encode($product_details['props_list']),
                            'seller_info'   => json_encode($product_details['seller_info']),
                            'tmall'   => $product_details['tmall'],
                            'error'   => $product_details['error'],
                            'warning'   => $product_details['warning'],
                            'url_log'   => json_encode($product_details['url_log']),
                            'favcount'   => $product_details['favcount'],
                            'fanscount'   => $product_details['fanscount'],
                            'stuff_status'   => $product_details['stuff_status'],
                            'shopinfo'   => json_encode($product_details['shopinfo']),
                            'data_from'   => $product_details['data_from'],
                            'method'   => $product_details['method'],
                            'promo_type'   => $product_details['promo_type'],
                            'props_img'   => json_encode($product_details['props_img']),
                            'rate_grade'   => $product_details['rate_grade'],
                            'shop_item'   => json_encode($product_details['shop_item']),
                            'relate_items'   => json_encode($product_details['relate_items']),
                        );
                        
                        $insert_data = $this->product_table_model->insert($data);
                        /* preparing array for product table, whihc is actual table */
                        $shipping_cost = $product_details['price']*0.9;

                        $choice_options = array();
                        $produ_images = array();
                        foreach ($product_details['item_imgs'] as $img) {
                            $produ_images[] = $img['url'];
                        }
                        $product_images = json_encode($produ_images);
                        $product_data = array(
                            'name'  => $product_details['title'],
                            'user_id' => $user_id,
                            'added_by' => $user_type,
                            'category_id' => $category_id,
                            'subcategory_id' => $subcategory_id,
                            'subsubcategory_id' => $subsubcategory_id,
                            'thumbnail_img' => $product_details['pic_url'],
                            'featured_img' => $product_details['pic_url'],
                            'flash_deal_img' => $product_details['pic_url'],
                            'current_stock' => $product_details['num'],
                            'refundable'    => 0,
                            'photos'    => $product_images,
                            'description'   => $product_details['desc'],
                            'unit_price'    => $price,
                            'purchase_price'    =>  $product_details['price'],
                            'tax'    =>  0,
                            'shipping_type' => 'flat_rate',
                            'shipping_cost' => $shipping_cost,
                            'attributes'    => json_encode(array()),
                            'choice_options' => json_encode(array()),
                            'colors'         => json_encode(array())
                        );
                        $productId = $this->product_model->insertGetId($product_data);
//                         $this->product_model->lastInsertId();
                        $skus = $product_details['skus']['sku'];
                        foreach ($skus as $val){
                            $get_color = explode(':',$val['properties_name']);
                            $color = $get_color[3];
                            $this->product_stock_model->product_id = $productId;
                            $this->product_stock_model->variant = $color;
                            $this->product_stock_model->price = $val['price']*2;
                            $this->product_stock_model->qty = $val['quantity'];
                            $this->product_stock_model->sku = $val['sku_id'];
                            $this->product_stock_model->save();
                        }
                        /* preparing array for product table, whihc is actual table */

                        flash(__('Data inserted '))->success();

                        /* testing testing */
                    } else{
                        flash(__('This url is not valid, please check the url again, '.$product))->error();
                        return back();
                    }

                }
            }
            if ($insert_data){
                flash(__('Data saved successfully '))->success();
                if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                    return redirect()->route('products.admin');
                }else{
                    if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                        $seller = Auth::user()->seller;
                        $seller->remaining_uploads -= 1;
                        $seller->save();
                    }
                    return redirect()->route('seller.products');
                }
                return back();
            } else{
                flash(__('Data not saved '))->error();
                return back();
            }

        } else{
            if (strpos( $product_id, '?id=' ) !== false){
                $id = explode('?id=',$product_id);
                $id = $id[1];
                /* testing testing */
                $json = json_decode(file_get_contents('https://www.lovbuy.com/taobaoapi/getproductinfo.php?key=bd93c95448cd07fb34b5d3d16541f7f9&item_id='.$id), true);
                $status = $json['status'];
                if ($status == 510){
                    flash(__('Balance is not enough. Make sure your account balance >=5 CNY'))->error();
                } elseif ($status == 500){
                    flash(__('Something went wrong, please try again'))->error();
                } elseif ($status == 501){
                    flash(__('API key is not correct'))->error();
                } elseif ($status == 505){
                    flash(__('Miss required parameter'))->error();
                } elseif ($status == 544){
                    flash(__('Fail to get'))->error();
                } elseif ($status == 200){
                    $product_details = $json['productinfo'];
                    $price = $product_details['price']*2;
                    $data = array(
                        'num_iid'   => $product_details['num_iid'],
                        'product_id'   => $product_details['num_iid'],
                        'title'   => $product_details['title'],
                        'desc_short'   => $product_details['desc_short'],
                        'price'   => $price,
                        'total_price'   => $price,
                        'suggestive_price'   => $price,
                        'orginal_price'   => $product_details['price'],
                        'nick'   => $product_details['nick'],
                        'num'   => $product_details['num'],
                        'min_num'   => $product_details['min_num'],
                        'detail_url'   => $product_details['detail_url'],
                        'pic_url'   => $product_details['pic_url'],
                        'brand'   => $product_details['brand'],
                        'cid'   => $product_details['cid'],
                        'rootCatId'   => $product_details['rootCatId'],
                        'crumbs'   => json_encode($product_details['crumbs']),
                        'created_time'   => $product_details['created_time'],
                        'modified_time'   => $product_details['modified_time'],
                        'delist_time'   => $product_details['delist_time'],
                        'desc'   => $product_details['desc'],
                        'desc_img'   => json_encode($product_details['desc_img']),
                        'item_imgs'   => json_encode($product_details['item_imgs']),
                        'item_weight'   => $product_details['item_weight'],
                        'item_size'   => $product_details['item_size'],
                        'location'   => $product_details['location'],
                        'post_fee'   => $product_details['post_fee'],
                        'express_fee'   => $product_details['express_fee'],
                        'ems_fee'   => $product_details['ems_fee'],
                        'shipping_to'   => $product_details['shipping_to'],
                        'has_discount'   => $product_details['has_discount'],
                        'video'   => json_encode($product_details['video']),
                        'is_virtual'   => $product_details['is_virtual'],
                        'sample_id'   => $product_details['sample_id'],
                        'is_promotion'   => $product_details['is_promotion'],
                        'props_name'   => $product_details['props_name'],
                        'prop_imgs'   => json_encode($product_details['prop_imgs']),
                        'property_alias'   => $product_details['property_alias'],
                        'props'   => json_encode($product_details['props']),
                        'skus'   => json_encode($product_details['skus']),
                        'seller_id'   => $product_details['seller_id'],
                        'sales'   => $product_details['sales'],
                        'shop_id'   => $product_details['shop_id'],
                        'props_list'   => json_encode($product_details['props_list']),
                        'seller_info'   => json_encode($product_details['seller_info']),
                        'tmall'   => $product_details['tmall'],
                        'error'   => $product_details['error'],
                        'warning'   => $product_details['warning'],
                        'url_log'   => json_encode($product_details['url_log']),
                        'favcount'   => $product_details['favcount'],
                        'fanscount'   => $product_details['fanscount'],
                        'stuff_status'   => $product_details['stuff_status'],
                        'shopinfo'   => json_encode($product_details['shopinfo']),
                        'data_from'   => $product_details['data_from'],
                        'method'   => $product_details['method'],
                        'promo_type'   => $product_details['promo_type'],
                        'props_img'   => json_encode($product_details['props_img']),
                        'rate_grade'   => $product_details['rate_grade'],
                        'shop_item'   => json_encode($product_details['shop_item']),
                        'relate_items'   => json_encode($product_details['relate_items']),
                    );
                    $insert_data = $this->product_table_model->insert($data);
                    /* preparing array for product table, whihc is actual table */
                    $shipping_cost = $product_details['price']*0.9;

                    $choice_options = array();
                    $produ_images = array();
                    foreach ($product_details['item_imgs'] as $img) {
                        $produ_images[] = $img['url'];
                    }
                    $product_images = json_encode($produ_images);
                    $product_data = array(
                        'name'  => $product_details['title'],
                        'user_id' => $user_id,
                        'added_by' => $user_type,
                        'category_id' => $category_id,
                        'subcategory_id' => $subcategory_id,
                        'subsubcategory_id' => $subsubcategory_id,
                        'thumbnail_img' => $product_details['pic_url'],
                        'featured_img' => $product_details['pic_url'],
                        'flash_deal_img' => $product_details['pic_url'],
                        'current_stock' => $product_details['num'],
                        'refundable'    => 0,
                        'photos'    => $product_images,
                        'description'   => $product_details['desc'],
                        'unit_price'    => $price,
                        'purchase_price'    =>  $product_details['price'],
                        'tax'    =>  0,
                        'shipping_type' => 'flat_rate',
                        'shipping_cost' => $shipping_cost,
                        'attributes'    => json_encode(array()),
                        'choice_options' => json_encode(array()),
                        'colors'         => json_encode(array())
                    );
                    $productId = $this->product_model->insertGetId($product_data);
//                    $productId = $this->product_model->lastInsertId();
                    $skus = $product_details['skus']['sku'];
                    foreach ($skus as $val){
                        $get_color = explode(':',$val['properties_name']);
                        $color = $get_color[3];
                        $this->product_stock_model->product_id = $productId;
                        $this->product_stock_model->variant = $color;
                        $this->product_stock_model->price = $val['price']*2;
                        $this->product_stock_model->qty = $val['quantity'];
                        $this->product_stock_model->sku = $val['sku_id'];
                        $this->product_stock_model->save();
                    }
                    /* preparing array for product table, whihc is actual table */
                    if ($insert_data){
                        flash(__('Data saved successfully '))->success();
                        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                            return redirect()->route('products.admin');
                        }else{
                            if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                                $seller = Auth::user()->seller;
                                $seller->remaining_uploads -= 1;
                                $seller->save();
                            }
                            return redirect()->route('seller.products');
                        }
                    } else{
                        flash(__('Data not saved successfully '))->error();
                        return back();
                    }
                    /* testing testing */
                } else{
                    flash(__('This url is not valid, please check the url again, '))->error();
                    return back();
                }
            } else{
                flash(__('This url is not valid, please check the url again, '))->error();
                return back();
            }

        }

    }
}
