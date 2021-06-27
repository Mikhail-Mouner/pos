@extends('layouts.dashboard.app')

@section('page-title','Clients\' Order ('.$client->name.')')
@section('style','')

@section('content')




    <header class="mb-5">
        <h1 class="h2 mb-0">
            {{ __('details.orders') }}
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('home') }}">
                        @lang('page.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('dashboard.client.index') }}">
                        {{ __('auth.clients') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('action.add order') }} <span class="text-muted"> ({{ $client->name }}) </span>
                </li>
            </ol>
        </nav>

    </header>


    <div class="row d-flex flex-fill align-items-start">

        <div class="col align-self-start">


            <section id="section_0">

                <header class="d-flex b-0">

                    <h2 class="h5 text-truncate w-100">
                        {{ __('action.add order') }} <span class="text-muted"> ({{ $client->name }}) </span>
                    </h2>

                    <div class="ui-options d-flex">


                        <!-- fullscreen -->
                        <a href="#" class="btn-toolbar" data-toggle-container-class="fullscreen" data-toggle-body-class="overflow-hidden" data-target="#section_0">
                            <span class="group-icon">
                                <i class="fi fi-expand"></i>
                                <i class="fi fi-shrink"></i>
                            </span>
                        </a>

                    </div>

                </header>

                <div class="mt--30 mb--60">
                    @include('messages._errors')

                    <div class="row">
                        <div class="col-md-6">

                            <div class="card">

                                <div class="card-header bg-primary-soft">

                                    <h3 class="box-title" style="margin-bottom: 10px">{{ __('details.categories') }}</h3>

                                </div><!-- end of box header -->

                                <div class="card-body">

                                    @foreach ($categories as $category)

                                        <div class="panel-group">

                                            <div class="card">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">
                                                    <div class="card-header bg-indigo-soft">
                                                        <h4 class="panel-title">
                                                            {{ $category->name }}
                                                        </h4>
                                                    </div>
                                                </a>

                                                <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                                    <div class="panel-body">

                                                        @if ($category->products->count() > 0)

                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>{{ __('details.name') }}</th>
                                                                    <th>{{ __('details.stock') }}</th>
                                                                    <th>{{ __('details.price') }}</th>
                                                                    <th>{{ __('action.add') }}</th>
                                                                </tr>

                                                                @foreach ($category->products as $product)
                                                                    <tr>
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->stock }}</td>
                                                                        <td>{{ $product->sale_price }}</td>
                                                                        <td>
                                                                            <a href=""
                                                                               id="product-{{ $product->id }}"
                                                                               data-name="{{ $product->name }}"
                                                                               data-id="{{ $product->id }}"
                                                                               data-price="{{ $product->sale_price }}"
                                                                               class="btn btn-success btn-sm add-product-btn">
                                                                                <i class="fi fi-plus-slim"></i> {{ __('action.add') }}
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table><!-- end of table -->

                                                        @else
                                                            <h5>{{ __('data.no data') }}</h5>
                                                        @endif

                                                    </div><!-- end of panel body -->

                                                </div><!-- end of panel collapse -->

                                            </div><!-- end of panel primary -->

                                        </div><!-- end of panel group -->

                                    @endforeach

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                        </div><!-- end of col -->

                        <div class="col-md-6">

                            <div class="card card-primary">

                                <div class="card-header bg-primary-soft">

                                    <h3 class="box-title">{{ __('details.orders') }}</h3>

                                </div><!-- end of box header -->

                                <div class="card-body">

                                    <form action="{{ route('dashboard.client.order.store', $client->id) }}" method="post">

                                        @csrf

                                        @include('messages._errors')

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>{{ __('details.product') }}</th>
                                                <th>{{ __('details.qty') }}</th>
                                                <th>{{ __('details.price') }}</th>
                                            </tr>
                                            </thead>

                                            <tbody class="order-list">


                                            </tbody>

                                        </table><!-- end of table -->

                                        <h4>{{ __('details.total') }} : <span class="total-price">0</span></h4>

                                        <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fi fi-plus"></i> {{ __('action.add order') }}</button>

                                    </form>

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                            @if ($client->orders->count() > 0)

                                <div class="box box-primary">

                                    <div class="box-header">

                                        <h3 class="box-title" style="margin-bottom: 10px">{{ __('details.previous order') }}
                                            <small>{{ $orders->count() }}</small>
                                        </h3>

                                    </div><!-- end of box header -->

                                    <div class="box-body">

                                        @foreach ($orders as $order)

                                            <div class="panel-group">

                                                <div class="card bg-success">

                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            {{ $order->created_at->toFormattedDateString() }}
                                                        </h4>
                                                    </div>

                                                    <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="card-body">

                                                        <div class="panel-body">

                                                            <ul class="list-group">
                                                                @foreach ($order->products as $product)
                                                                    <li class="list-group-item">{{ $product->name }}</li>
                                                                @endforeach
                                                            </ul>

                                                        </div><!-- end of panel body -->

                                                    </div><!-- end of panel collapse -->

                                                </div><!-- end of panel primary -->

                                            </div><!-- end of panel group -->

                                        @endforeach

                                        {{ $orders->links() }}

                                    </div><!-- end of box body -->

                                </div><!-- end of box -->

                            @endif

                        </div><!-- end of col -->
                    </div>

                </div>

            </section>



        </div>

    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            //add product btn
            $('.add-product-btn').on('click', function (e) {

                e.preventDefault();
                var name = $(this).data('name');
                var id = $(this).data('id');
                var price = $(this).data('price');

                $(this).removeClass('btn-success').addClass('btn-dark disabled');

                var html =
                    `<tr>
                        <td>${name}</td>
                        <td><input type="number" name="products[${id}][qty]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                        <td class="product-price">${price}</td>
                        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fi fi-thrash"></span></button></td>
                    </tr>`;

                $('.order-list').append(html);

                //to calculate total price
                calculateTotal();
            });

            //disabled btn
            $('body').on('click', '.disabled', function(e) {

                e.preventDefault();

            });//end of disabled

            //remove product btn
            $('body').on('click', '.remove-product-btn', function(e) {

                e.preventDefault();
                var id = $(this).data('id');

                $(this).closest('tr').remove();
                $('#product-' + id).removeClass('btn-dark disabled').addClass('btn-success');

                //to calculate total price
                calculateTotal();

            });//end of remove product btn

            //change product quantity
            $('body').on('keyup change', '.product-quantity', function() {

                var quantity = Number($(this).val()); //2
                var unitPrice = $(this).data('price'); //150
                $(this).closest('tr').find('.product-price').html(quantity * unitPrice);
                calculateTotal();

            });//end of product quantity change

            //list all order products
            $('.order-products').on('click', function(e) {

                e.preventDefault();

                $('#loading').css('display', 'flex');

                var url = $(this).data('url');
                var method = $(this).data('method');
                $.ajax({
                    url: url,
                    method: method,
                    success: function(data) {

                        $('#loading').css('display', 'none');
                        $('#order-product-list').empty();
                        $('#order-product-list').append(data);

                    }
                })

            });//end of order products click

            //print order
            $(document).on('click', '.print-btn', function() {

                $('#print-area').printThis();

            });//end of click function

        });//end of document ready

        //calculate the total
        function calculateTotal() {

            var price = 0;

            $('.order-list .product-price').each(function(index) {

                price += parseFloat($(this).html().replace(/,/g, ''));

            });//end of product price

            $('.total-price').html(price);

            //check if price > 0
            if (price > 0) {

                $('#add-order-form-btn').removeClass('disabled')

            } else {

                $('#add-order-form-btn').addClass('disabled')

            }//end of else

        }//end of calculate total

    </script>
@endsection
