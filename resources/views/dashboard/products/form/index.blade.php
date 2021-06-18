@extends('layouts.dashboard.app')

@if(isset($product))
    @section('page-title','Edit Product\'s Data ('.$product->name.')')
@else
    @section('page-title','Add Product')
@endif
@section('style')
    <style>

        .paper {
            position: relative;
            width: 90%;
            height: 390px;
            margin: 10px auto;
            background: #fafafa;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.3);
            overflow: hidden;
        }
        .paper:before {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            @if(LaravelLocalization::getCurrentLocale() == 'ar') right: 0; @else left: 0; @endif
            width: 60px;
            background: radial-gradient(#575450 6px, transparent 7px) repeat-y;
            background-size: 30px 30px;
            @if(LaravelLocalization::getCurrentLocale() == 'ar') border-left: 3px solid #D44147; @else border-right: 3px solid #D44147; @endif
            box-sizing: border-box;
        }

        .paper-content {
            position: absolute;
            top: 30px; bottom: 30px;
            @if(LaravelLocalization::getCurrentLocale() == 'ar') left: 0; right: 60px; @else right: 0; left: 60px; @endif
            background: linear-gradient(transparent, transparent 28px, #91D1D3 28px);
            background-size: 30px 30px;
        }

        .paper-content textarea {
            width: 100%;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            line-height: 30px;
            padding: 0 10px;
            border: 0;
            outline: 0;
            background: transparent;
            color: mediumblue;
            font-weight: bold;
            font-size: 18px;
            box-sizing: border-box;
            z-index: 1;
            resize: none;
        }

    </style>
@endsection

@section('content')




    <header class="mb-5">
        <h1 class="h2 mb-0">
            {{ __('details.products') }}
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('home') }}">
                        @lang('page.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('dashboard.product.index') }}">
                        {{ __('details.products') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($product))
                        {{ __('action.edit') }} <span class="text-muted"> ({{ $product->name }}) </span>
                    @else
                        {{ __('action.add') }}
                    @endif
                </li>
            </ol>
        </nav>

    </header>


    <div class="row d-flex flex-fill align-items-start">

        <div class="col align-self-start">


            <section id="section_0">

                <header class="d-flex b-0">

                    <h2 class="h5 text-truncate w-100">
                        @if(isset($product))
                            {{ __('action.edit') }} <span class="h6 text-muted"> ({{ $product->name }}) </span>
                        @else
                            {{ __('action.add') }}
                        @endif
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
                    <form
                        @if(isset($product))
                        action="{{ route('dashboard.product.update',$product->id) }}"
                        @else
                        action="{{ route('dashboard.product.store') }}"
                        @endif
                        method="post"
                        autocomplete="off"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @isset($product)
                            @method('put')
                        @endisset
                        <div class="row">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-md-6">
                                    <div class="form-label-group mb-3">
                                        <input
                                            type="text"
                                            class="form-control form-control-clean"
                                            id="{{ $localeCode.'_name' }}"
                                            name="{{ $localeCode.'[name]' }}"
                                            placeholder="{{ __('details.name') }}"
                                            @isset($product)
                                            value="{{ $product->translate($localeCode)->name }}"
                                            @endisset
                                        />
                                        <label for="{{ $localeCode.'_name' }}">{{ __('details.name').' ('.$properties['native'].')' }}</label>
                                    </div>
                                </div>
                            @endforeach


                            <div class="row">

                                <div class="col-md-4 text-center">

                                    <label class="w--200 h--200 text-center position-relative d-inline-block cursor-pointer border border-secondary border-dashed bg-white">

                                        <!-- remove button -->
                                        <a href="#" class="js-file-upload-avatar-circle-remove hide position-absolute absolute-top w-100 z-index-3">
                                                <span class="d-inline-block btn btn-sm btn-pill bg-secondary text-white pt--4 pb--4 pl--10 pr--10 m--1 mt--n15" title="remove avatar" data-tooltip="tooltip">
                                                    <i class="fi fi-close m-0"></i>
                                                </span>
                                        </a>

                                        <span class="z-index-2 js-file-input-avatar-circle-container d-block absolute-full z-index-1 hide-empty" style="">
                                            <!-- avatar container -->
                                            @isset($product)
                                                <span
                                                    data-id="0"
                                                    data-file-name="{{ $product->name }}"
                                                    style="background-image:url('{{ $product->image_path }}')"
                                                    class="js-file-input-item d-inline-block position-relative overflow-hidden text-center m-0 p-0 animate-bouncein bg-cover w-100 h-100">
                                                </span>
                                            @endisset
                                        </span>

                                        <!-- hidden input (out of viewport, or safari will ignore it) -->
                                        <!-- NOTE: data-file-preview-img-height="118 and <label> has .h--12 (120px). This is because we have a border - so we cut 2px (1px for each side) -->
                                        <input
                                            name="image"
                                            type="file"
                                            data-file-ext="jpg, png, gif"
                                            data-file-max-size-kb-per-file=""
                                            data-file-ext-err-msg="Allowed:"
                                            data-file-size-err-item-msg="File too large!"
                                            data-file-size-err-total-msg="Total allowed size exceeded!"
                                            data-file-toast-position="bottom-center"
                                            data-file-preview-container=".js-file-input-avatar-circle-container"
                                            data-file-preview-show-info="false"
                                            data-file-preview-class="m-0 p-0 animate-bouncein"
                                            data-file-preview-img-height="200"
                                            data-file-btn-clear="a.js-file-upload-avatar-circle-remove"
                                            data-file-preview-img-cover="true"
                                            accept="image/*"
                                            class="custom-file-input absolute-full"
                                        />

                                        <svg class="fill-gray-600 m-4 z-index-0" viewBox="0 0 60 60">
                                            <path d="M41.014,45.389l-9.553-4.776C30.56,40.162,30,39.256,30,38.248v-3.381c0.229-0.28,0.47-0.599,0.719-0.951c1.239-1.75,2.232-3.698,2.954-5.799C35.084,27.47,36,26.075,36,24.5v-4c0-0.963-0.36-1.896-1-2.625v-5.319c0.056-0.55,0.276-3.824-2.092-6.525C30.854,3.688,27.521,2.5,23,2.5s-7.854,1.188-9.908,3.53c-2.368,2.701-2.148,5.976-2.092,6.525v5.319c-0.64,0.729-1,1.662-1,2.625v4c0,1.217,0.553,2.352,1.497,3.109c0.916,3.627,2.833,6.36,3.503,7.237v3.309c0,0.968-0.528,1.856-1.377,2.32l-8.921,4.866C1.801,46.924,0,49.958,0,53.262V57.5h46v-4.043C46,50.018,44.089,46.927,41.014,45.389z"/>
                                            <path d="M55.467,46.526l-9.723-4.21c-0.23-0.115-0.485-0.396-0.704-0.771l6.525-0.005c0,0,0.377,0.037,0.962,0.037c1.073,0,2.638-0.122,4-0.707c0.817-0.352,1.425-1.047,1.669-1.907c0.246-0.868,0.09-1.787-0.426-2.523c-1.865-2.654-6.218-9.589-6.354-16.623c-0.003-0.121-0.397-12.083-12.21-12.18c-1.187,0.01-2.309,0.156-3.372,0.413c0.792,2.094,0.719,3.968,0.665,4.576v4.733c0.648,0.922,1,2.017,1,3.141v4c0,1.907-1.004,3.672-2.607,4.662c-0.748,2.022-1.738,3.911-2.949,5.621c-0.15,0.213-0.298,0.414-0.443,0.604v2.86c0,0.442,0.236,0.825,0.631,1.022l9.553,4.776c3.587,1.794,5.815,5.399,5.815,9.41V57.5H60v-3.697C60,50.711,58.282,47.933,55.467,46.526z"/>
                                        </svg>

                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-label-group mb-3">
                                                <select class="form-control  form-control-clean bs-select" id="category" name="category_id" data-live-search="true">
                                                    @foreach($categories as $category)
                                                        <option data-tokens="" value="{{ $category->id }}" @if(isset($product) && $product->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="category">{{ __('details.category') }}</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-label-group mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-clean"
                                                    id="purchase_price"
                                                    name="purchase_price"
                                                    placeholder="{{ __('details.purchase price') }}"
                                                    @isset($product)
                                                    value="{{ $product->purchase_price }}"
                                                    @endisset
                                                />
                                                <label for="purchase_price">{{ __('details.purchase price') }}</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-label-group mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-clean"
                                                    id="sale_price"
                                                    name="sale_price"
                                                    placeholder="{{ __('details.sale price') }}"
                                                    @isset($product)
                                                    value="{{ $product->sale_price }}"
                                                    @endisset
                                                />
                                                <label for="sale_price">{{ __('details.sale price') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-label-group mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-clean"
                                                    id="stock"
                                                    name="stock"
                                                    placeholder="{{ __('details.stock') }}"
                                                    @isset($product)
                                                    value="{{ $product->stock }}"
                                                    @endisset
                                                />
                                                <label for="stock">{{ __('details.stock') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-md-6">

                                    <div class="paper mb-3">
                                        <div class="paper-content">

                                            <label>{{ __('details.description').' ('.$properties['native'].')' }}</label>
                                            <textarea class=""
                                                      name="{{ $localeCode.'[description]' }}"
                                            >@isset($product){{ $product->translate($localeCode)->description }}@endisset</textarea>

                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fi fi-plus"></i> {{ __('action.submit') }}</button>
                            </div>

                    </form>

                </div>

            </section>



        </div>

    </div>



@endsection

@section('scripts','')
