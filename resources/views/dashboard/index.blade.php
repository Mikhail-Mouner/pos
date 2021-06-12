@extends('layouts.dashboard.app')

@section('page-title','HomePage')
@section('style','')

@section('content')



    <header class="mb-5">
        <h1 class="h2 mb-0">
            Vendor Plugin
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
                <li class="breadcrumb-item">
                    <a class="text-indigo" href="../index.html">Smarty Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Documentation
                </li>
            </ol>
        </nav>

    </header>


    <div class="row d-flex flex-fill align-items-start">

        <div class="col align-self-start">


            <section id="section_0">

                <header class="d-flex b-0">

                    <h2 class="h5 text-truncate w-100">
                        Basic

                        <a href="#" class="btn-link">
                            <i class="fi fi-plus"></i>
                        </a>
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


                </div>

            </section>



        </div>

    </div>



@endsection

@section('scripts','')
