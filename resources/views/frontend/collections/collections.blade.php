@extends('frontend.layouts.app')

@section('content')
<section class="mb-4">
    <div class="container">
        <h1>Collections</h1>
        <div class="row">
            @foreach($collections as $key => $collection)
<!--            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset($collection->thumbnail_img)}}" alt="{{ __($collection->name) }}">
                <?php
                $products = DB::select("SELECT * FROM products WHERE products.id IN (SELECT products_collection.product_id from products_collection WHERE products_collection.collection_id=$collection->id)");
                ?>
                @foreach($products as $key => $product)
                            <div class="card" style="width: 18rem;">
                                <div class="card-body p-0">
                                    <div class="card-image">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block">
                                            <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                    </div>
                
                                    <div class="p-md-3 p-2">
                                        <div class="price-box">
                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                            @endif
                                            <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                        </div>
                                        <div class="star-rating star-rating-sm mt-1">
                                            {{ renderStarRating($product->rating) }}
                                        </div>
                                        <h2 class="product-title p-0 text-truncate-2">
                                            <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                        </h2>
                
                                        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                            {{ __('Club Point') }}:
                                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                @endforeach
                <div class="card-body"> 
                    <h5 class="card-title">{{ __($collection->name) }}</h5>
                    <p class="card-text">{{ __($collection->search_tag) }}</p>
                    <a href="{{ route('collections.detail',$collection->id)}}" class="btn btn-primary">${{ number_format($collection->unit_price,2) }}</a>
                </div>
            </div>-->
            @endforeach
            <div class="col-xl-12">
                <!-- <hr class=""> -->
                <div class="products-box-bar p-3 bg-white">
                    <div class="row sm-no-gutters gutters-5">
                       @foreach($collections as $key => $collection)
                        <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-6">
                            <div class="product-box-2 bg-white alt-box my-md-2">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('collections.detail',$collection->id)}}" class="d-block product-image h-100 text-center" tabindex="0">
                                        <img class="img-fit lazyload" src="{{ asset($collection->thumbnail_img)}}" data-src="{{ asset($collection->thumbnail_img)}}" alt="{{ __($collection->name) }}">
                                    </a>
                                </div>
                                <?php
                                    $products = DB::select("SELECT * FROM products WHERE products.id IN (SELECT products_collection.product_id from products_collection WHERE products_collection.collection_id=$collection->id)");
                                    ?>
                                 <div class="product-nav product-nav-thumbs">
                                     @foreach($products as $key => $product)
                                        <a href="{{ route('product', $product->slug) }}#" class="active">
                                            <img width="50" height="50" src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                     @endforeach
                                        
                                    </div>
                                <div class="p-md-3 p-2">
                                    <h2 class="product-title p-0">
                                        <a href="{{ route('collections.detail',$collection->id)}}" class=" text-truncate">{{ __($collection->name) }}</a>
                                    </h2>

                                    <div class="star-rating star-rating-sm mt-1">
                                      
                                    </div>
<!--                                    <div class="price-box">
                                        <span class="product-price strong-600">${{ number_format($collection->unit_price,2) }}</span>
                                    </div>-->
                                    
                                </div>
                               
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- </div> -->
            </div>
        </div>
    </div>
</section>

@endsection