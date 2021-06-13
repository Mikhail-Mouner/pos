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
                        autocomplete="off"
                        enctype="multipart/form-data"
                    >
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
                                <div class="row">

                                    <div class="col-md-4 text-center">

                                        <label class="w--120 h--120 rounded-circle text-center position-relative d-inline-block cursor-pointer border border-secondary border-dashed bg-white">

                                            <!-- remove button -->
                                            <a href="#" class="js-file-upload-avatar-circle-remove hide position-absolute absolute-top w-100 z-index-3">
                                                <span class="d-inline-block btn btn-sm btn-pill bg-secondary text-white pt--4 pb--4 pl--10 pr--10 m--1 mt--n15" title="remove avatar" data-tooltip="tooltip">
                                                    <i class="fi fi-close m-0"></i>
                                                </span>
                                            </a>

                                            <span class="z-index-2 js-file-input-avatar-circle-container d-block absolute-full z-index-1 hide-empty" style="">
                                                <!-- avatar container -->
                                                @isset($user)
                                                <span
                                                    data-id="0"
                                                    data-file-name="{{ $user->first_name }}"
                                                    style="background-image:url('{{ $user->image_path }}')"
                                                    class="js-file-input-item d-inline-block position-relative overflow-hidden text-center rounded-circle m-0 p-0 animate-bouncein bg-cover w-100 h-100">
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
                                                data-file-preview-class="rounded-circle m-0 p-0 animate-bouncein"
                                                data-file-preview-img-height="118"
                                                data-file-btn-clear="a.js-file-upload-avatar-circle-remove"
                                                data-file-preview-img-cover="true"
                                                accept="image/*"
                                                class="custom-file-input absolute-full"
                                            />

                                            <svg class="fill-gray-600 rounded-circle m-4 z-index-0" viewBox="0 0 60 60">
                                                <path d="M41.014,45.389l-9.553-4.776C30.56,40.162,30,39.256,30,38.248v-3.381c0.229-0.28,0.47-0.599,0.719-0.951c1.239-1.75,2.232-3.698,2.954-5.799C35.084,27.47,36,26.075,36,24.5v-4c0-0.963-0.36-1.896-1-2.625v-5.319c0.056-0.55,0.276-3.824-2.092-6.525C30.854,3.688,27.521,2.5,23,2.5s-7.854,1.188-9.908,3.53c-2.368,2.701-2.148,5.976-2.092,6.525v5.319c-0.64,0.729-1,1.662-1,2.625v4c0,1.217,0.553,2.352,1.497,3.109c0.916,3.627,2.833,6.36,3.503,7.237v3.309c0,0.968-0.528,1.856-1.377,2.32l-8.921,4.866C1.801,46.924,0,49.958,0,53.262V57.5h46v-4.043C46,50.018,44.089,46.927,41.014,45.389z"/>
                                                <path d="M55.467,46.526l-9.723-4.21c-0.23-0.115-0.485-0.396-0.704-0.771l6.525-0.005c0,0,0.377,0.037,0.962,0.037c1.073,0,2.638-0.122,4-0.707c0.817-0.352,1.425-1.047,1.669-1.907c0.246-0.868,0.09-1.787-0.426-2.523c-1.865-2.654-6.218-9.589-6.354-16.623c-0.003-0.121-0.397-12.083-12.21-12.18c-1.187,0.01-2.309,0.156-3.372,0.413c0.792,2.094,0.719,3.968,0.665,4.576v4.733c0.648,0.922,1,2.017,1,3.141v4c0,1.907-1.004,3.672-2.607,4.662c-0.748,2.022-1.738,3.911-2.949,5.621c-0.15,0.213-0.298,0.414-0.443,0.604v2.86c0,0.442,0.236,0.825,0.631,1.022l9.553,4.776c3.587,1.794,5.815,5.399,5.815,9.41V57.5H60v-3.697C60,50.711,58.282,47.933,55.467,46.526z"/>
                                            </svg>

                                        </label>

                                    </div>
                                    <div class="col-md-8">

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
                                    </div>
                                </div>

                                <hr class="col-md-12" />
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
                                                                    <input type="checkbox" name="permission[]" value="{{ $model['prefix'] .'_'. $map['prefix'] }}" @if(isset($user) && $user->hasPermission($model['prefix'] .'_'. $map['prefix'])) checked @endif>
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
                                </hr>



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
