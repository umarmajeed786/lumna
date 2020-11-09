@extends('layouts.app')
@section('content')
<div>
    <h1 class="page-header text-overflow">Add New Collections</h1>
</div>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form form-horizontal mar-top" action="{{route('collections.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
            @csrf
            <input type="hidden" name="added_by" value="admin">
            <div class="panel">
                <div class="panel-heading bord-btm">
                    <h3 class="panel-title">{{__('Collection Information')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Collection Name')}}</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="name" placeholder="{{__('Collection Name')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Unit Price')}}</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="price" placeholder="Unit Price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Tags')}}</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="tags" placeholder="Type to add a tag" data-role="tagsinput" required>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel">
                <div class="panel-heading bord-btm">
                    <h3 class="panel-title">{{__('Collection Image')}}</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Image')}} <small>(290x300)</small></label>
                        <div class="col-lg-7">
                            <div id="thumbnail_img">
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <div class="panel">
                <div class="panel-heading bord-btm">
                    <h3 class="panel-title">{{__('Collection Description')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Description')}}</label>
                        <div class="col-lg-9">
                            <textarea class="editor" name="description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <!--Panel heading-->

                <div class="panel-heading bord-btm">
                    <h3 class="panel-title">{{__('Products')}}</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-striped" id="example" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('')}}</th>
                                <th>{{__('Name')}}</th>
                                
                                <th>{{__('Num of Sale')}}</th>
                                <th>{{__('Total Stock')}}</th>
                                <th>{{__('Base Price')}}</th>
                                <th>{{__('Todays Deal')}}</th>
                                <th>{{__('Rating')}}</th>
                                <th>{{__('Featured')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td><input type="checkbox" name='products[]' value='{{ __($product->id) }}'></td>
                                <td>
                                    <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image">
                                        </div>
                                </td>
                                <td>
                                   {{ __($product->name) }}
                                </td>

                                <td>{{ $product->num_of_sale }} {{__('times')}}</td>
                                <td>
                                    @php
                                    $qty = 0;
                                    if($product->variant_product){
                                    foreach ($product->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                    }
                                    }
                                    else{
                                    $qty = $product->current_stock;
                                    }
                                    echo $qty;
                                    @endphp
                                </td>
                                <td>{{ number_format($product->unit_price,2) }}</td>
                                <td><label class="switch">
                                        <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->todays_deal == 1) echo "checked"; ?> >
                                        <span class="slider round"></span></label></td>
                                <td>{{ $product->rating }}</td>

                                <td><label class="switch">
                                        <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->featured == 1) echo "checked"; ?> >
                                        <span class="slider round"></span></label></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="mar-all text-right">
                <button type="submit" name="button" class="btn btn-info">{{ __('Add New Collection') }}</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('script')


<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    });
    function add_more_customer_choice_option(i, name){
    $('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="Choice Title" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div></div>');
    $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    }

    $('input[name="colors_active"]').on('change', function() {
    if (!$('input[name="colors_active"]').is(':checked')){
    $('#colors').prop('disabled', true);
    }
    else{
    $('#colors').prop('disabled', false);
    }
    update_sku();
    });
    $('#colors').on('change', function() {
    update_sku();
    });
    $('input[name="unit_price"]').on('keyup', function() {
    update_sku();
    });
    $('input[name="name"]').on('keyup', function() {
    update_sku();
    });
    function delete_row(em){
    $(em).closest('.form-group').remove();
    update_sku();
    }

    function update_sku(){
    $.ajax({
    type:"POST",
            url:'{{ route('products.sku_combination') }}',
            data:$('#choice_form').serialize(),
            success: function(data){
            $('#sku_combination').html(data);
            if (data.length > 1) {
            $('#quantity').hide();
            }
            else {
            $('#quantity').show();
            }
            }
    });
    }

    function get_subcategories_by_category(){
    var category_id = $('#category_id').val();
    $.post('{{ route('subcategories.get_subcategories_by_category') }}', {_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
    $('#subcategory_id').html(null);
    for (var i = 0; i < data.length; i++) {
    $('#subcategory_id').append($('<option>', {
    value: data[i].id,
            text: data[i].name
    }));
    $('.demo-select2').select2();
    }
    get_subsubcategories_by_subcategory();
    });
    }

    function get_subsubcategories_by_subcategory(){
    var subcategory_id = $('#subcategory_id').val();
    $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}', {_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
    $('#subsubcategory_id').html(null);
    $('#subsubcategory_id').append($('<option>', {
    value: null,
            text: null
    }));
    for (var i = 0; i < data.length; i++) {
    $('#subsubcategory_id').append($('<option>', {
    value: data[i].id,
            text: data[i].name
    }));
    $('.demo-select2').select2();
    }
    //get_brands_by_subsubcategory();
    //get_attributes_by_subsubcategory();
    });
    }

    function get_brands_by_subsubcategory(){
    var subsubcategory_id = $('#subsubcategory_id').val();
    $.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}', {_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
    $('#brand_id').html(null);
    for (var i = 0; i < data.length; i++) {
    $('#brand_id').append($('<option>', {
    value: data[i].id,
            text: data[i].name
    }));
    $('.demo-select2').select2();
    }
    });
    }

    function get_attributes_by_subsubcategory(){
    var subsubcategory_id = $('#subsubcategory_id').val();
    $.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}', {_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
    $('#choice_attributes').html(null);
    for (var i = 0; i < data.length; i++) {
    $('#choice_attributes').append($('<option>', {
    value: data[i].id,
            text: data[i].name
    }));
    }
    $('.demo-select2').select2();
    });
    }

    $(document).ready(function(){
    get_subcategories_by_category();
    $("#photos").spartanMultiImagePicker({
    fieldName:        'photos[]',
            maxCount:         10,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-4 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
            console.log(index, file, 'file size too big');
            alert('File size too big');
            }
    });
    $("#thumbnail_img").spartanMultiImagePicker({
    fieldName:        'thumbnail_img',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-4 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
            console.log(index, file, 'file size too big');
            alert('File size too big');
            }
    });
    $("#featured_img").spartanMultiImagePicker({
    fieldName:        'featured_img',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-4 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
            console.log(index, file, 'file size too big');
            alert('File size too big');
            }
    });
    $("#flash_deal_img").spartanMultiImagePicker({
    fieldName:        'flash_deal_img',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-4 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
            console.log(index, file, 'file size too big');
            alert('File size too big');
            }
    });
    $("#meta_photo").spartanMultiImagePicker({
    fieldName:        'meta_img',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-4 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
            console.log(index, file, 'file size too big');
            alert('File size too big');
            }
    });
    });
    $('#category_id').on('change', function() {
    get_subcategories_by_category();
    });
    $('#subcategory_id').on('change', function() {
    get_subsubcategories_by_subcategory();
    });
    $('#subsubcategory_id').on('change', function() {
    // get_brands_by_subsubcategory();
    //get_attributes_by_subsubcategory();
    });
    $('#choice_attributes').on('change', function() {
    $('#customer_choice_options').html(null);
    $.each($("#choice_attributes option:selected"), function(){
    //console.log($(this).val());
    add_more_customer_choice_option($(this).val(), $(this).text());
    });
    update_sku();
    });


</script>

@endsection
