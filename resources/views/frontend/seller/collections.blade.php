@extends('frontend.layouts.app')



@section('content')

<section class="gry-bg py-4 profile">

    <div class="container">

        <div class="row cols-xs-space cols-sm-space cols-md-space">

            <div class="col-lg-3 d-none d-lg-block">

                @include('frontend.inc.seller_side_nav')

            </div>



            <div class="col-lg-9">

                <div class="main-content">

                    <!-- Page title -->

                    <div class="page-title">

                        <div class="row align-items-center">

                            <div class="col-md-6">

                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">

                                    {{__('Collections')}}

                                </h2>

                            </div>
                            <div class="col-md-6">

                                <div class="float-md-right">

                                    <ul class="breadcrumb">

                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>

                                        <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>

                                        <li><a href="{{ route('seller.collections') }}">{{__('Collections')}}</a></li>

                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card no-border mt-4">
                        <div class="">
                            <a href="#" class="pull-right">Add Collection</a>
                        </div>
                        <div class="card-header py-2">

                            <div class="row align-items-center">

                                <div class="col-md-6 col-xl-3">

                                    <h6 class="mb-0">All Collections</h6>

                                </div>

                                <div class="col-md-6 col-xl-3 ml-auto">

                                    <form class="" action="" method="GET">

                                        <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search Collection">

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-sm table-hover table-responsive-md">

                                <thead>

                                    <tr>

                                        <th>IMG</th>

                                        <th>{{__('Name')}}</th>

                                        <th>{{__('Price')}}</th>

                                        <th>{{__('Tags')}}</th>

                                        <th>{{__('Description')}}</th>

                                        <th>{{__('Created At')}}</th>

                                        <th>{{__('Options')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($collections as $key => $collection)
                                    <tr>
                                        <td>
                                            <a href=""  class="media-block">
                                                <div class="media-left">
                                                    <img loading="lazy" width="100"  class="img-md" src="{{ asset($collection->thumbnail_img)}}" alt="Image">
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ __($collection->name) }}</td>
                                        <td>{{ number_format($collection->unit_price,2) }}</td>
                                        <td>{{ $collection->search_tag }}</td>
                                        <td><textarea>{{ $collection->description }}</textarea></td>
                                        <td>{{ $collection->created_at }}</td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @if ($type == 'Seller')
                                                    <li><a href="{{route('collections.edit', encrypt($collection->id))}}">{{__('Edit')}}</a></li>
                                                    @else
                                                    <li><a href="{{route('collections.edit', encrypt($collection->id))}}">{{__('Edit')}}</a></li>
                                                    @endif
                                                    <li><a onclick="confirm_modal('{{route('collections.destroy', $collection->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</section>











@endsection
