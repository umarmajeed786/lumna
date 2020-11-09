<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 p-md-4 bg-white">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{__('Collections')}}</span>
                </h3>
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <!--<div class="row">-->
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                     @foreach($collections as $key => $collection)
                     <div class="caorusel-card">
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                            <div class="card-body p-0">

                                <div class="card-image">
                                    <a href="{{ route('collections.detail',$collection->id)}}" class="d-block">
                                        <img class="img-fit lazyload mx-auto" src="{{ asset($collection->thumbnail_img)}}" data-src="{{ asset($collection->thumbnail_img)}}" alt="{{ __($collection->name) }}">
                                    </a>
                                </div>

                                <div class="p-md-3 p-2">
                                    <?php
                                    $products = DB::select("SELECT * FROM products WHERE products.id IN (SELECT products_collection.product_id from products_collection WHERE products_collection.collection_id=$collection->id) limit 3");
                                    ?>
                                 <div class="product-nav product-nav-thumbs">
                                     @foreach($products as $key => $product)
                                        <a href="{{ route('product', $product->slug) }}#" class="active">
                                            <img width="50" height="50" src="{{ $product->featured_img }}" alt="IMG">
                                        </a>
                                     @endforeach
                                     </div>
                                    <h2 class="product-title p-0 text-truncate-2">
                                        <a href="{{ route('collections.detail',$collection->id)}}">{{ __($collection->name) }}</a>
                                    </h2>
                                   </div>
                                   </div>
                                   </div>
                                   </div>
                        
                        @endforeach
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>
