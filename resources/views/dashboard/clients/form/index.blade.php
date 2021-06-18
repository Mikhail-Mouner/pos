@extends('layouts.dashboard.app')

@if(isset($client))
    @section('page-title','Edit Client\'s Data ('.$client->name.')')
@else
    @section('page-title','Add Client')
@endif
@section('style','')

@section('content')




    <header class="mb-5">
        <h1 class="h2 mb-0">
            {{ __('auth.clients') }}
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
                    @if(isset($client))
                        {{ __('action.edit') }} <span class="text-muted"> ({{ $client->name }}) </span>
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
                        @if(isset($client))
                            {{ __('action.edit') }} <span class="h6 text-muted"> ({{ $client->name }}) </span>
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
                        @if(isset($client))
                        action="{{ route('dashboard.client.update',$client->id) }}"
                        @else
                        action="{{ route('dashboard.client.store') }}"
                        @endif
                        method="post"
                        autocomplete="off"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @isset($client)
                            @method('put')
                        @endisset
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        id="name"
                                        name="name"
                                        placeholder="{{ __('details.name') }}"
                                        @isset($client)
                                        value="{{ $client->name }}"
                                        @endisset
                                    />
                                    <label for="name">{{ __('details.name') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        id="phone"
                                        name="phone"
                                        placeholder="{{ __('details.phone') }}"
                                        @isset($client)
                                        value="{{ $client->phone }}"
                                        @endisset
                                    />
                                    <label for="phone">{{ __('details.phone') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        id="address"
                                        name="address"
                                        placeholder="{{ __('details.address') }}"
                                        @isset($client)
                                        value="{{ $client->address }}"
                                        @endisset
                                    />
                                    <label for="phone">{{ __('details.address') }}</label>
                                </div>
                            </div>

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
