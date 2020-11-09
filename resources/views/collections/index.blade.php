@extends('layouts.app')

@section('content')

@if($type != 'Seller')
<div class="row">
    <div class="col-lg-12 pull-right">
        <a href="{{ route('collections.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Collection')}}</a>
    </div>
</div>
@endif

<br>


<div class="panel">
    <!--Panel heading-->

    <div class="panel-heading bord-btm">
        <h3 class="panel-title">{{__('Collections')}}</h3>
    </div>

    <div class="panel-body">
        <table class="table table-striped" id="example" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th width="30%">{{__('Name')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('tags')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Created At')}}</th>
                    <th>{{__('Options')}}</th

                </tr>
            </thead>
            <tbody>
                @foreach($collections as $key => $collection)
                <tr>
                    <td>
                        <a href="" target="_blank" class="media-block">
                            <div class="media-left">
                                <img loading="lazy"  class="img-md" src="{{ asset($collection->thumbnail_img)}}" alt="Image">
                            </div>
                            <div class="media-body">{{ __($collection->name) }}</div>
                        </a>
                    </td>

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
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    });
    $(document).ready(function(){
    //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
    });
    function update_todays_deal(el){
    if (el.checked){
    var status = 1;
    }
    else{
    var status = 0;
    }
    $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
    if (data == 1){
    showAlert('success', 'Todays Deal updated successfully');
    }
    else{
    showAlert('danger', 'Something went wrong');
    }
    });
    }

    function update_published(el){
    if (el.checked){
    var status = 1;
    }
    else{
    var status = 0;
    }
    $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
    if (data == 1){
    showAlert('success', 'Published products updated successfully');
    }
    else{
    showAlert('danger', 'Something went wrong');
    }
    });
    }

    function update_featured(el){
    if (el.checked){
    var status = 1;
    }
    else{
    var status = 0;
    }
    $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
    if (data == 1){
    showAlert('success', 'Featured products updated successfully');
    }
    else{
    showAlert('danger', 'Something went wrong');
    }
    });
    }

    function sort_products(el){
    $('#sort_products').submit();
    }
    $(document).ready(function() {
    $('#product_table').DataTable();
    });
</script>
@endsection
