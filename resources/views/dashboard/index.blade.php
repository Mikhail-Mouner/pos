@extends('layouts.dashboard.app')

@section('page-title','HomePage')
@section('style','')

@section('content')



    <header class="mb-5">
        <h1 class="h2 mb-0">
            {{ __('page.dashboard') }}
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('page.home') }}
                </li>
            </ol>
        </nav>

    </header>


    <div class="row d-flex flex-fill align-items-start">

        <div class="col align-self-start">


            <section id="section_0">

                <header class="d-flex b-0">

                    <h2 class="h5 text-truncate w-100">
                        {{ __('page.dashboard') }}
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
                            <th>{{ __('pagination.page') }}</th>
                            <th>{{ __('details.description') }}</th>
                            <th>{{ __('details.created by') }}</th>
                            <th>{{ __('details.created at') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge-primary badge">{{ $activity->log_name }}</span></td>
                                <td>{{ $activity->description }}</td>
                                <td>@isset($activity->causer->first_name) {{ $activity->causer->first_name.' '.$activity->causer->last_name }} @endisset</td>
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">@lang('data.empty')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>

            </section>



        </div>

    </div>



@endsection

@section('scripts','')
