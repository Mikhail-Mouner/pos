@extends('layouts.dashboard.app')

@section('page-title','Orders')
@section('style')
    <style>
        .view-product-tr{
            cursor: pointer;
        }
    </style>
@endsection

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
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('details.orders') }}
                </li>
            </ol>
        </nav>

    </header>


    <div class="row d-flex flex-fill align-items-start">

        <div class="col align-self-start">


            <section id="section_0">

                <header class="d-flex b-0">

                    <h2 class="h5 text-truncate w-100">
                        {{ __('details.orders') }}
                        <small class="h6 text-info font-italic font-weight-lighter">
                            ({{ $orders->count() }})
                        </small>
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
                    <form action="{{ route('dashboard.order.index') }}" method="get" autocomplete="off">
                        <div class="row">

                            <div class="col-md-8">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        placeholder="{{ __('data.search') }}"
                                        id="search"
                                        name="search"
                                        @isset(request()->search)
                                        value="{{ request()->search }}"
                                        @endisset
                                    />
                                    <label for="search">{{ __('data.search') }}</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fi fi-search"></i> {{ __('data.filter') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt--30 mb--60">
                @include('messages._alert')
                @include('messages._errors')

                <!--

                        data-autofill="false|hover|click"
                        data-enable-paging="true" 			false = show all, no pagination
                        data-items-per-page="10|15|30|50|100"

                    -->
                    <div class="row">
                        <div class="col-8">
                            <table class="table-datatable table table-bordered table-hover table-striped"
                                   data-lng-empty="{{ __('data.no data') }}"
                                   data-lng-page-info="Showing _START_ to _END_ of _TOTAL_ entries"
                                   data-lng-filtered="(filtered from _MAX_ total entries)"
                                   data-lng-loading="{{ __('data.loading') }}"
                                   data-lng-processing="{{ __('data.processing') }}"
                                   data-lng-search="{{ __('data.search') }}"
                                   data-lng-norecords="{{ __('data.no matching') }}"
                                   data-lng-sort-ascending="{{ __('data.sort ascending') }}"
                                   data-lng-sort-descending="{{ __('data.sort descending') }}"

                                   data-lng-column-visibility="{{ __('data.column visibility') }}"
                                   data-lng-csv="CSV"
                                   data-lng-pdf="PDF"
                                   data-lng-xls="XLS"
                                   data-lng-copy="{{ __('action.copy') }}"
                                   data-lng-print="{{ __('action.print') }}"
                                   data-lng-all="{{ __('data.all') }}"

                                   data-main-search="true"
                                   data-column-search="false"
                                   data-row-reorder="false"
                                   data-col-reorder="true"
                                   data-responsive="true"
                                   data-header-fixed="true"
                                   data-select-onclick="false"
                                   data-enable-paging="true"
                                   data-enable-col-sorting="true"
                                   data-autofill="false"
                                   data-group="false"
                                   data-items-per-page="10"

                                   data-lng-export="<i class='fi fi-squared-dots fs--18 line-height-1'></i>"
                                   data-export-pdf-disable-mobile="true"
                                   data-export='["csv", "pdf", "xls"]'
                                   data-options='["copy", "print"]'
                            >
                                <thead>
                                <tr>
                                    <th>{{ __('details.code') }}</th>
                                    <th>{{ __('auth.client') }}</th>
                                    <th>{{ __('details.phone') }}</th>
                                    <th>{{ __('details.price') }}</th>
                                    <th>{{ __('details.status') }}</th>
                                    <th>{{ __('details.created at') }}</th>
                                    <th>{{ __('action.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr class="view-product-tr" data-id="{{ $order->id }}" data-url="{{route('dashboard.order.product',$order->id)}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->client->name }}</td>
                                        <td>
                                            <i class="fi fi-phone"></i> {{ $order->client->phone }}
                                        </td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-sm" ><i class="fi fi-eye"></i> {{ __('action.view') }}</button>
                                            <a href="{{ route('dashboard.client.order.edit',[$order->client->id,$order->id]) }}" class="btn btn-outline-success btn-sm" ><i class="fi fi-pencil"></i> {{ __('action.edit') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">@lang('data.empty')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <div class="card card-primary">

                                <div class="card-header bg-primary-soft">

                                    <h3 class="box-title">{{ __('details.orders') }}</h3>

                                </div><!-- end of box header -->

                                <div class="card-body">


                                    <!-- Create Post Form -->

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ __('details.product') }}</th>
                                            <th>{{ __('details.qty') }}</th>
                                            <th>{{ __('details.price') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody class="order-list">


                                        <tr>
                                            <td colspan="3">
                                                {{ __('data.no data') }}
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table><!-- end of table -->

                                    <h4>{{ __('details.total') }} <span class="total-price badge badge-primary">0</span></h4>



                                </div><!-- end of box body -->

                            </div>
                        </div>
                    </div>



                </div>

            </section>



        </div>

    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.view-product-tr').on('click', function () {
                let id = $(this).data('id');
                let url = $(this).data('url');
                let order_list = $('.order-list');
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    beforeSend: function( xhr ) {
                        order_list.html(`
                            <tr>
                                <td colspan="3" class="text-center"> <i class="fi fi-loading-dots fi-spin"></i> {{ __('data.loading') }}</td>
                            </tr>
                        `);
                        $('.total-price').html(0)

                    }
                })
                    .done(function( data ) {
                        order_list.html('')
                        let total_price = 0
                        let price = 0

                        for (item of data){
                            price = parseFloat(item.pivot.qty * item.sale_price)
                            total_price += price

                            order_list.append(`
                                <tr>
                                    <td>${item.name}</td>
                                    <td>${item.pivot.qty}</td>
                                    <td>${price}</td>
                                </tr>
                            `);
                            $('.total-price').html(total_price)
                        }

                    })
                    .fail(function( jqXHR, textStatus ) {
                        order_list.html(`
                            <tr>
                                <td colspan="3" class="text-center"> <i class="fi fi-loud"></i> {{ __('data.error') }}</td>
                            </tr>
                        `);
                    });

            })
        })
    </script>
@endsection
