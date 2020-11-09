@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Import Product From taobao.com')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
        
            <form class="form-horizontal" role="form" action="{{ route('save_taobao_products') }}" method="POST">
                @csrf
                <div class="panel-body">
                    {{-- to get category --}}
                    <div class="form-group" id="category">

                        <label class="col-lg-2 control-label">{{__('Category')}}</label>

                        <div class="col-lg-7">

                            <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>

                                @foreach($categories as $category)

                                    <option value="{{$category->id}}">{{__($category->name)}}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="form-group" id="subcategory">

                        <label class="col-lg-2 control-label">{{__('Subcategory')}}</label>

                        <div class="col-lg-7">

                            <select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>



                            </select>

                        </div>

                    </div>

                    <div class="form-group" id="subsubcategory">

                        <label class="col-lg-2 control-label">{{__('Sub Subcategory')}}</label>

                        <div class="col-lg-7">

                            <select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">



                            </select>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{__('Product ID')}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('product_id') }}" placeholder="{{ __('https://item.taobao.com/item.htm?id=620132344420') }}" name="product_id">
                        
                            @if ($errors->has('product_id'))
                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('product_id') }}</strong>
                                                    </span>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Import Products')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>

@section('script')
    <script type="text/javascript">
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
        function get_subcategories_by_category(){

            var category_id = $('#category_id').val();

            $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){

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

            $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){

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
    </script>
@endsection

@endsection



