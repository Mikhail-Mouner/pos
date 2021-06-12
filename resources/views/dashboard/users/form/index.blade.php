@extends('layouts.dashboard.app')

@section('page-title','HomePage')
@section('style','')

@section('content')




    <header class="mb-5">
        <h1 class="h2 mb-0">
            @lang('auth.users')
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('home') }}">
                        @lang('page.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="{{ route('dashboard.user.index') }}">
                        @lang('auth.users')
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($user))
                        {{ __('action.edit') }} <span class="text-muted"> ({{ $user->first_name }}) </span>
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
                        @if(isset($user))
                            {{ __('action.edit') }} <span class="h6 text-muted"> ({{ $user->first_name }}) </span>
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
                        @if(isset($user))
                        action="{{ route('dashboard.user.update',$user->id) }}"
                        @else
                        action="{{ route('dashboard.user.store') }}"
                        @endif
                        method="post"
                        autocomplete="off">
                        @csrf
                        @isset($user)
                            @method('put')
                        @endisset
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        id="first_name"
                                        name="first_name"
                                        placeholder="{{ __('details.first name') }}"
                                        @isset($user)
                                        value="{{ $user->first_name }}"
                                        @endisset
                                    />
                                    <label for="first_name">{{ __('details.first name') }}</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="text"
                                        class="form-control form-control-clean"
                                        placeholder="{{ __('details.last name') }}"
                                        id="last_name"
                                        name="last_name"
                                        @isset($user)
                                        value="{{ $user->last_name }}"
                                        @endisset
                                    />
                                    <label for="last_name">{{ __('details.last name') }}</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="email"
                                        class="form-control form-control-clean"
                                        placeholder="{{ __('details.e-mail') }}"
                                        id="e_mail"
                                        name="e_mail"
                                        @isset($user)
                                        value="{{ $user->email }}"
                                        @endisset
                                    />
                                    <label for="e_mail">{{ __('details.e-mail') }}</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="password"
                                        class="form-control form-control-clean"
                                        placeholder="{{ __('details.password') }}"
                                        id="password"
                                        name="password"
                                    />
                                    <label for="password">{{ __('details.password') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group mb-3">
                                    <input
                                        type="password"
                                        class="form-control form-control-clean"
                                        placeholder="{{ __('details.password confirm') }}"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                    />
                                    <label for="password_confirmation">{{ __('details.password confirm') }}</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <!--
                                To remember last tab, add:
                                .nav-link.nav-link-remember

                                Add to .bg-*-active to .nav-link
                                to change the color on active!
                            -->


                                <div class="row">
                                    @php
                                        $models = [
                                            ['prefix'=>'users','model'=>__('auth.user')],
                                            ['prefix'=>'categories','model'=>__('details.categories')],
                                            ['prefix'=>'products','model'=>__('details.products')]
                                        ];

                                        $maps = [
                                            ['prefix'=>'create','map'=>__('action.create'),'color'=>'primary'],
                                            ['prefix'=>'delete','map'=>__('action.delete'),'color'=>'danger'],
                                            ['prefix'=>'read','map'=>__('action.read'),'color'=>'info'],
                                            ['prefix'=>'update','map'=>__('action.update'),'color'=>'success'],
                                        ];
                                    @endphp
                                    <div class="col-3">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            @foreach($models as $model)
                                                <a class="nav-link  @if($loop->first)active @endif" id="v-pills-home-tab{{ $loop->iteration }}" data-toggle="pill" href="#v-pills-home{{ $loop->iteration }}" role="tab" aria-controls="v-pills-home{{ $loop->iteration }}" aria-selected="true">{{ $loop->iteration.'. '.$model['model'] }}</a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <div class="tab-content" id="v-pills-tabContent">

                                            @foreach($models as $model)
                                                <div class="tab-pane fade @if($loop->first)show active @endif" id="v-pills-home{{ $loop->iteration }}" role="tabpanel" aria-labelledby="v-pills-home-tab{{ $loop->iteration }}">

                                                    <div class="col-6">

                                                        @foreach($maps as $map)
                                                            <label class="form-checkbox form-checkbox-{{ $map['color'] }} form-checkbox-bordered">
                                                                <input type="checkbox" name="permission[]" value="{{ $model['prefix'] .'_'. $map['prefix'] }}">
                                                                <i></i>{{ $map['map'] }}
                                                            </label>

                                                            <br>
                                                        @endforeach


                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fi fi-plus"></i> {{ __('action.submit') }}</button>
                            </div>

                        </div>
                    </form>

                </div>

            </section>



        </div>

    </div>



@endsection

@section('scripts','')
