@extends('layouts.dashboard.app')

@if(isset($category))
    @section('page-title','Edit Category\'s Data ('.$category->name.')')
@else
    @section('page-title','Add Category')
@endif
@section('style','')

@section('content')




    <header class="mb-5">
        <h1 class="h2 mb-0">
            {{ __('details.categories') }}
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('home') }}">
                        @lang('page.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('dashboard.category.index') }}">
                        {{ __('details.categories') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($category))
                        {{ __('action.edit') }} <span class="text-muted"> ({{ $category->name }}) </span>
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
                        @if(isset($category))
                            {{ __('action.edit') }} <span class="h6 text-muted"> ({{ $category->name }}) </span>
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
                        @if(isset($category))
                        action="{{ route('dashboard.category.update',$category->id) }}"
                        @else
                        action="{{ route('dashboard.category.store') }}"
                        @endif
                        method="post"
                        autocomplete="off"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @isset($category)
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
                                            @isset($category)
                                            value="{{ $category->translate($localeCode)->name }}"
                                            @endisset
                                        />
                                        <label for="{{ $localeCode.'_name' }}">{{ __('details.name').'('.$properties['native'].')' }}</label>
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
