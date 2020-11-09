@extends('frontend.layouts.app')

@section('content')
<section class="mb-4">
    <div class="container">
        <div class="row">
        <div class="col-md-8 mt-3">
         <img class="img-fit lazyload" src="{{ asset($collection->thumbnail_img)}}" data-src="{{ asset($collection->thumbnail_img)}}" alt="{{ __($collection->name) }}">
        <h3>{{ __($collection->name) }}</h3>
         </div>
        <div class="col-md-4">
            <div class="col-xl-12">
                        <!-- <hr class=""> -->
                        <div class="products-box-bar p-3 bg-white">
                            <div class="row sm-no-gutters gutters-5">
                                @foreach ($products as $key => $product)
                                    <div class="col-sm-12">
                                       <div class="caorusel-card my-1">
                                <div class="row no-gutters product-box-2 align-items-center">
                                    <div class="col-4">
                                        <div class="position-relative overflow-hidden h-100">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                            </a>
                                            <div class="product-btns">
                                                <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                    <i class="la la-heart-o"></i>
                                                </button>
                                                <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                    <i class="la la-refresh"></i>
                                                </button>
                                                <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})">
                                                    <i class="la la-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 border-left">
                                        <div class="p-3">
                                            <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                            </h2>
                                            <div class="star-rating star-rating-sm mb-2">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">
                                                        {{ home_discounted_base_price($product->id) }}
                                                    </span>
                                                </div>
                                                <div class="float-right">
                                                    <button class="add-to-cart btn" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                        <i class="la la-shopping-cart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
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
<section class="gry-bg">
        <div class="container">
            <div class="row">
              
                <div class="col-xl-12">
                    <div class="product-desc-tab bg-white">
                        <div class="tabs tabs--style-2">
                            <ul class="nav nav-tabs justify-content-center sticky-top bg-white">
                                <!--<li class="nav-item">-->
                                <!--    <a href="#tab_default_5" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">Product Details</a>-->
                                <!--</li>-->
                                <li class="nav-item">
                                    <a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">Description</a>
                                </li>
                                                                                                <li class="nav-item">
                                    <a href="#tab_default_4" data-toggle="tab" class="nav-link text-uppercase strong-600">Reviews</a>
                                </li>
                            </ul>


                          
                            <div class="tab-content pt-0">
                                <div class="tab-pane active show" id="tab_default_1">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mw-100 overflow--hidden">
                                                    {!! __($collection->description) !!}         
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_2">
                                    <div class="fluid-paragraph py-2">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="embed-responsive embed-responsive-16by9 mb-5">
                                                                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="https://lansapi.feibis.com/public">Download</a>
                                            </div>
                                        </div>
                                        <span class="space-md-md"></span>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <div class="fluid-paragraph py-4">
                                        
                                                                                    <div class="text-center">
                                                There have been no reviews for this product yet.
                                            </div>
                                        
                                                                            </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection