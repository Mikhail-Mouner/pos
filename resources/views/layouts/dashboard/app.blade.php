<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>@yield('page-title', config('app.name', 'Laravel') )</title>
    <meta name="description" content="...">

    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- up to 10% speed up for external res -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <!-- preloading icon font is helping to speed up a little bit -->
    <link rel="preload" href="{{ asset('assets/fonts/flaticon/Flaticon.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- non block rendering : page speed : js = polyfill for old browsers missing `preload` -->
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="{{ asset('assets/rtl/css/core.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/rtl/css/vendor_bundle.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/core.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/vendor_bundle.min.css') }}">
    @endif
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('demo.files/logo/icon_512x512.png') }}">

    <link rel="manifest" href="{{ asset('assets/images/manifest/manifest.json') }}">
    <meta name="theme-color" content="#377dff">

    @yield('style')
</head>


<!--

    Layout Admin
        .layout-admin 	(required)

        .aside-sticky  					- sidebar : fixed and push header
        .header-sticky  				- header : always visible on top (acting as old .header-focus)


    ****************************************************************************************************

        NOTES

            1. 	LOGO TO REPLACE
                    - logo_light.svg 	: sidebar
                    - logo_dark.svg 	: header navbar

    ****************************************************************************************************


    ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++

    SCROLL TO TOP BUTTON [optional styling]

        data-s2t-disable="true"
        data-s2t-position="start|end"
        data-s2t-class="btn-secondary btn-sm" 	(default)
        data-s2t-class="btn-secondary rounded-circle"
        data-s2t-class="btn-warning rounded-circle"

    ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++

-->
<body class="layout-admin aside-sticky header-sticky" data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0" data-gfont="Aref Ruqaa">

<div id="wrapper" class="d-flex align-items-stretch flex-column">



    <!--
        HEADER

        .header-match-aside-primary
    -->
    <header id="header">


        <!-- NAVBAR -->
        <div class="container-fluid position-relative">

            <nav class="navbar navbar-expand-lg navbar-light justify-content-lg-between justify-content-md-inherit h--70">

                <div class="align-items-start">

                    <!--
                        sidebar toggler
                    -->
                    <a href="#aside-main" class="btn-sidebar-toggle h-100 d-inline-block d-lg-none justify-content-center align-items-center p-2">
								<span class="group-icon">
									<i>
										<svg width="25" viewBox="0 0 20 20">
											<path d="M 19.9876 1.998 L -0.0108 1.998 L -0.0108 -0.0019 L 19.9876 -0.0019 L 19.9876 1.998 Z"></path>
											<path d="M 19.9876 7.9979 L -0.0108 7.9979 L -0.0108 5.9979 L 19.9876 5.9979 L 19.9876 7.9979 Z"></path>
											<path d="M 19.9876 13.9977 L -0.0108 13.9977 L -0.0108 11.9978 L 19.9876 11.9978 L 19.9876 13.9977 Z"></path>
											<path d="M 19.9876 19.9976 L -0.0108 19.9976 L -0.0108 17.9976 L 19.9876 17.9976 L 19.9876 19.9976 Z"></path>
										</svg>
									</i>

									<i>
										<svg width="25" viewBox="0 0 47.971 47.971">
											<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
										</svg>
									</i>
								</span>
                    </a>


                    <!--
                        Logo : height: 60px max
                        visibility : mobile only
                    -->
                    <a class="navbar-brand d-inline-block d-lg-none" href="#">
                        <img src="{{ asset('assets/images/logo/logo_dark.svg') }}" width="110" height="60" alt="...">
                    </a>


                </div>




                <!-- NAVIGATION -->
                <div class="collapse navbar-collapse" id="navbarMainNav">



                    <!-- MOBILE MENU NAVBAR -->
                    <div class="navbar-xs d-none">

                        <!-- mobile menu button : close -->
                        <button class="navbar-toggler pt-0" type="button" data-toggle="collapse" data-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">
                            <svg width="20" viewBox="0 0 20 20">
                                <path d="M 20.7895 0.977 L 19.3752 -0.4364 L 10.081 8.8522 L 0.7869 -0.4364 L -0.6274 0.977 L 8.6668 10.2656 L -0.6274 19.5542 L 0.7869 20.9676 L 10.081 11.679 L 19.3752 20.9676 L 20.7895 19.5542 L 11.4953 10.2656 L 20.7895 0.977 Z"></path>
                            </svg>
                        </button>

                        <!--
                            Optional Mobile Menu Logo
                            Logo : height: 70px max
                        -->
                        <a class="navbar-brand px-4 w-auto" href="#">
                            <img src="{{ asset('assets/images/logo/logo_dark.svg') }}" width="110" height="70" alt="...">
                        </a>

                    </div>
                    <!-- /MOBILE MENU NAVBAR -->



                    <!-- Dropdowns -->
                    <ul class="navbar-nav align-items-center">

                        <!--  -->
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavHome">
                                <i class="fi fi-plus"></i> {{ __('action.add') }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-clean" aria-labelledby="mainNavHome">

                                @if(auth()->user()->hasPermission('users_create'))
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="{{ route('dashboard.user.create') }}">
                                        <i class="fi fi-user-plus"></i>
                                        {{ __('auth.user') }}
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->hasPermission('categories_create'))
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="{{ route('dashboard.category.create') }}">
                                        <i class="fi fi-folder-full"></i>
                                        {{ __('details.category') }}
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->hasPermission('products_create'))
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="{{ route('dashboard.product.create') }}">
                                        <i class="fi fi-cart-1"></i>
                                        {{ __('details.product') }}
                                    </a>
                                </li>
                                @endif

                            </ul>

                        </li>

                    </ul>
                    <!-- /Dropdowns -->

                </div>
                <!-- /NAVIGATION -->




                <!-- OPTIONS -->
                <ul class="list-inline list-unstyled mb-0 d-flex align-items-end">

                    <!-- messages  d-none d-md-inline-block -->
                    <li class="list-inline-item ml--6 mr--6 dropdown">

                        <a href="#" id="dropdownMessageOptions" class="btn btn-sm rounded-circle btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">

                            <!-- badge -->
                            <span class="badge badge-danger shadow-danger-md animate-pulse fs--10 p--3 mt--n3 position-absolute end-0">1</span>

                            <span class="group-icon">
										<i class="fi fi-envelope-2"></i>
										<i class="fi fi-close"></i>
									</span>
                        </a>

                        <div aria-labelledby="dropdownMessageOptions" class="dropdown-menu dropdown-menu-clean dropdown-menu-navbar-autopos dropdown-menu-invert dropdown-click-ignore p-0 mt--18 fs--15 w--300">

                            <div class="dropdown-header fs--14 py-3">

                                <a href="#!" class="js-ajax-modal btn btn-sm btn-primary btn-soft b-0 px-2 py-1 m-0 fs--12 mt--n3 float-end"
                                   data-href="_ajax/admin_modal_message_write.html"
                                   data-ajax-modal-size="modal-md"
                                   data-ajax-modal-centered="false"
                                   data-ajax-modal-backdrop="static">
                                    + WRITE
                                </a>

                                1 NEW MESSAGE

                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="max-h-50vh scrollable-vertical">

                                <!-- MESSAGE -->
                                <a href="#!" class="clearfix dropdown-item font-weight-medium px-3 border-bottom border-light overflow-hidden shadow-md-hover bg-theme-color-light">

                                    <span class="badge badge-success float-end font-weight-normal mt-1">new</span>
                                    <span class="badge badge-danger float-end font-weight-normal mt-1">urgent</span>

                                    <!-- image -->
                                    <div class="w--50 h--50 mb-2 mt-1 rounded-circle bg-cover bg-light float-start" style="background-image:url('../../html_frontend/demo.files/images/icons/user80.png')"></div>

                                    <!-- author -->
                                    <strong class="d-block text-truncate">{{ auth()->user()->first_name }}</strong>

                                    <!-- subject -->
                                    <p class="fs--14 m-0 text-truncate font-weight-normal">
                                        Spartans has no weekends, so neither you!
                                    </p>

                                    <!-- date -->
                                    <small class="d-block fs--11 text-muted">
                                        Jan 22, 2019 / 02:21:46pm
                                    </small>

                                </a>
                                <!-- /MESSAGE -->

                                <!-- MESSAGE -->
                                <a href="#!" class="clearfix dropdown-item font-weight-medium px-3 border-bottom border-light overflow-hidden shadow-md-hover">

                                    <!-- image -->
                                    <div class="w--50 h--50 mb-2 mt-1 rounded-circle bg-cover bg-light float-start" style="background-image:url('../../html_frontend/demo.files/images/unsplash/team/michael-dam-mEZ3PoFGs_k-unsplash.jpg')"></div>

                                    <!-- author -->
                                    <strong class="d-block text-truncate">Michael Dam</strong>

                                    <!-- subject -->
                                    <p class="fs--14 m-0 text-truncate font-weight-normal">
                                        Go with Smarty, you can't go wrong, trust me
                                    </p>

                                    <!-- date -->
                                    <small class="d-block fs--11 text-muted">
                                        Jan 22, 2019 / 02:21:46pm
                                    </small>

                                </a>
                                <!-- /MESSAGE -->

                                <!-- MESSAGE -->
                                <a href="#!" class="clearfix dropdown-item font-weight-medium px-3 border-bottom border-light overflow-hidden shadow-md-hover">

                                    <!-- image -->
                                    <div class="w--50 h--50 mb-2 mt-1 rounded-circle bg-cover bg-light float-start" style="background-image:url('../../html_frontend/demo.files/images/unsplash/team/joseph-gonzalez-iFgRcqHznqg-unsplash.jpg')"></div>

                                    <!-- author -->
                                    <strong class="d-block text-truncate">Joseph Gonzalez</strong>

                                    <!-- subject -->
                                    <p class="fs--14 m-0 text-truncate font-weight-normal">
                                        RE: No Subject
                                    </p>

                                    <!-- date -->
                                    <small class="d-block fs--11 text-muted">
                                        Jan 22, 2019 / 02:21:46pm
                                    </small>

                                </a>
                                <!-- /MESSAGE -->

                                <!-- MESSAGE -->
                                <a href="#!" class="clearfix dropdown-item font-weight-medium px-3 border-bottom border-light overflow-hidden shadow-md-hover">

                                    <!-- image -->
                                    <div class="w--50 h--50 mb-2 mt-1 rounded-circle bg-cover bg-light float-start" style="background-image:url('../../html_frontend/demo.files/images/unsplash/team/erik-mclean-06vpBIHmiYc-unsplash.jpg')"></div>

                                    <!-- author -->
                                    <strong class="d-block text-truncate">Erik Mclean</strong>

                                    <!-- subject -->
                                    <p class="fs--14 m-0 text-truncate font-weight-normal">
                                        Indeed, this is unbeliveable
                                    </p>

                                    <!-- date -->
                                    <small class="d-block fs--11 text-muted">
                                        Jan 22, 2019 / 02:21:46pm
                                    </small>

                                </a>
                                <!-- /MESSAGE -->

                                <!-- MESSAGE -->
                                <a href="#!" class="clearfix dropdown-item font-weight-medium px-3 border-bottom border-light overflow-hidden shadow-md-hover">

                                    <!-- image -->
                                    <div class="w--50 h--50 mb-2 mt-1 rounded-circle bg-cover bg-light float-start" style="background-image:url('../../html_frontend/demo.files/images/unsplash/team/valerie-elash-9IL_stSpvOU-unsplash.jpg')"></div>

                                    <!-- author -->
                                    <strong class="d-block text-truncate">Valerie Elash</strong>

                                    <!-- subject -->
                                    <p class="fs--14 m-0 text-truncate font-weight-normal">
                                        RE: No Subject
                                    </p>

                                    <!-- date -->
                                    <small class="d-block fs--11 text-muted">
                                        Jan 22, 2019 / 02:21:46pm
                                    </small>

                                </a>
                                <!-- /MESSAGE -->

                            </div>

                            <div class="dropdown-divider mb-0"></div>

                            <a href="#!" class="prefix-icon-ignore dropdown-footer dropdown-custom-ignore font-weight-medium pt-3 pb-3">
                                <i class="fi fi-arrow-end fs--11"></i>
                                <span class="d-inline-block pl-2 pr-2">View all</span>
                            </a>
                        </div>

                    </li>

                    <!-- account -->
                    <li class="list-inline-item ml--6 mr--6 dropdown">

                        <a href="#" id="dropdownAccountOptions" class="btn btn-sm btn-light dropdown-toggle btn-pill pl--12 pr--12" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">

									<span class="group-icon m-0">
										<!-- <i class="fi fi-user-female"></i> -->
										<i class="fi w--15 fi-user-male"></i>
										<i class="fi w--15 fi-close"></i>
									</span>

                            <span class="fs--14 d-none d-sm-inline-block font-weight-medium">{{ auth()->user()->first_name }}</span>
                        </a>


                        <!--

                            Dropdown Classes
                                .dropdown-menu-dark 		- dark dropdown (desktop only, will be white on mobile)
                                .dropdown-menu-hover 		- open on hover
                                .dropdown-menu-clean 		- no background color on hover
                                .dropdown-menu-invert 		- open dropdown in oposite direction (left|right, according to RTL|LTR)
                                .dropdown-click-ignore 		- keep dropdown open on inside click (useful on forms inside dropdown)

                                Dropdown prefix icon (optional, if enabled in variables.scss)
                                    .prefix-link-icon .prefix-icon-dot 		- link prefix
                                    .prefix-link-icon .prefix-icon-line 	- link prefix
                                    .prefix-link-icon .prefix-icon-ico 		- link prefix
                                    .prefix-link-icon .prefix-icon-arrow 	- link prefix

                                    .prefix-icon-ignore 					- ignore, do not use on a specific link

                        -->
                        <div aria-labelledby="dropdownAccountOptions" class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-navbar-autopos dropdown-menu-invert dropdown-click-ignore p-0 mt--18 fs--15 w--300">

                            <div class="dropdown-header fs--14 py-4">

                                <!-- profile image -->
                                <div class="w--60 h--60 rounded-circle bg-light bg-cover float-start" style="background-image:url('{{ auth()->user()->image_path }}')"></div>

                                <!-- initials - no image -->
                                <!--
                                <div data-initials="Username" data-assign-color="true" class="sow-util-initials bg-light rounded h5 w--60 h--60 d-inline-flex justify-content-center align-items-center rounded-circle float-start">
                                    <i class="fi fi-circle-spin fi-spin"></i>
                                </div>
                                -->

                                <!-- user detail -->
                                <span class="d-block font-weight-medium text-truncate fs--16">{{ auth()->user()->first_name }}</span>
                                <span class="d-block text-muted font-weight-medium text-truncate">{{ auth()->user()->email }}</span>
                                <small class="d-block text-muted"><b>{{ __('details.last login') }}:</b> @if(auth()->user()->previousLoginAt()) {{ auth()->user()->previousLoginAt()->diffForHumans() }} @endisset</small>

                            </div>

                            <div class="dropdown-divider mb-0"></div>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="prefix-icon-ignore dropdown-footer dropdown-custom-ignore font-weight-medium pt-3 pb-3 btn-block btn-link border-0">
                                    <i class="fi fi-power float-start"></i>
                                    {{ __('auth.logout') }}
                                </button>
                            </form>
                        </div>

                    </li>

                </ul>
                <!-- /OPTIONS -->


            </nav>


            <!-- TOP NAVIGATION TOGGLER -->
            <button class="navbar-toggler shadow-xs h-auto w-auto m-0 btn btn-sm bg-white rounded-circle position-absolute end-0 mt-1 mb-1 ml-2 mr-2 z-index-2 d-none d-inline-block d-lg-none" type="button" data-toggle="collapse" data-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fi fi-bars"></i>
            </button>
            <!-- /TOP NAVIGATION TOGGLER -->

        </div>
        <!-- /NAVBAR -->

    </header>
    <!-- /HEADER -->


    <div id="wrapper_content" class="d-flex flex-fill">


        <aside id="aside-main" class="aside-start bg-gradient-purple font-weight-light aside-hide-xs d-flex flex-column h-auto">


            <!--
                LOGO
                visibility : desktop only
            -->
            <div class="d-none d-sm-block">
                <div class="clearfix d-flex justify-content-between">

                    <!-- Logo : height: 60px max -->
                    <a class="w-100 align-self-center navbar-brand p-3" href="/">
                        <img src="{{ asset('assets/images/logo/logo_light.svg') }}" width="110" height="60" alt="...">
                    </a>

                </div>
            </div>
            <!-- /LOGO -->


            <div class="aside-wrapper scrollable-vertical scrollable-styled-light align-self-baseline h-100 w-100">

                <!--

                    All parent open navs are closed on click!
                    To ignore this feature, add .js-ignore to .nav-deep

                    Links height (paddings):
                        .nav-deep-xs
                        .nav-deep-sm
                        .nav-deep-md  	(default, ununsed class)

                    .nav-deep-hover 	hover background slightly different
                    .nav-deep-bordered	bordered links


                    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    IMPORTANT NOTE:
                        Curently using ajax navigation!
                        remove .js-ajax class to have regular links!
                    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                -->
                <nav class="nav-deep nav-deep-dark nav-deep-hover fs--15 pb-5">
                    <ul class="nav flex-column">

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="fi fi-menu-dots"></i>
                                <b>{{ __('page.dashboard') }}</b>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('users_read'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.user.index') }}">
                                    <i class="fi fi-users"></i>
                                    <b>{{ __('auth.users') }}</b>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasPermission('categories_read'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.category.index') }}">
                                    <i class="fi fi-folder-full"></i>
                                    <b>{{ __('details.categories') }}</b>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasPermission('products_read'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.product.index') }}">
                                    <i class="fi fi-cart-1"></i>
                                    <b>{{ __('details.products') }}</b>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="#">
										<span class="group-icon float-end">
											<i class="fi fi-arrow-end-slim"></i>
											<i class="fi fi-arrow-down-slim"></i>
										</span>
                                <i class="fi fi-code"></i>
                                <span class="badge badge-warning float-end fs--11 mt-1">new</span>
                                Components
                            </a>

                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="#">
                                        Alerts
                                    </a>
                                </li>

                            </ul>

                        </li>



                    </ul>
                </nav>

            </div>
        </aside>
        <!-- /SIDEBAR -->


        <!-- MIDDLE -->
        <div id="middle" class="flex-fill">

            @yield('content')

        </div>
        <!-- /MIDDLE -->

    </div>



    <!-- FOOTER -->
    <footer id="footer" class="bg-gradient-purple text-white">
        <div class="p-3 fs--14">
            &copy; {{ config('app.name') }}



            <div class="d-inline-block float-end dropdown">
                <ul class="list-inline m-0">

                    <!-- LANGUAGE -->
                    <li class="dropdown list-inline-item m-0">

                        <a id="topDDLanguage" href="#!" class="d-inline-block" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="fi fi-globe"></i>
                            <span class="pl-2 pr-2">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        </a>

                        <div aria-labelledby="topDDLanguage" class="dropdown-menu fs--13 px-1 pt-1 pb-0 m-0 max-h-50vh scrollable-vertical dropdown-menu-right">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="active dropdown-item text-muted text-truncate line-height-1 rounded p--12 mb-1">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>

                    </li>
                    <!-- /LANGUAGE -->

                </ul>
            </div>


        </div>
    </footer>
    <!-- /FOOTER -->


</div><!-- /#wrapper -->



<script src="{{ asset('assets/js/core.min.js') }}"></script>

<script>

    $('.btn-delete').on('click',function (e) {
        return confirm('{{ __('message.are you sure') }}')
    })

</script>

@yield('scripts')

<!--

    [SOW Ajax Navigation Plugin] [AJAX ONLY, IF USED]
    If you have specific page js files, wrap them inside #page_js_files
    Ajax Navigation will use them for this page!
    This way you can load this page in a normal way and/or via ajax.
    (you can change/add more containers in sow.config.js)

    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    NOTE: This is mostly for frontend, full ajax navigation!
    Admin Panels use a backend, so the content should be served without
    menu, header, etc! Else, the ajax has no reason to be used because will
    not minimize server load!

    /documentation/plugins-sow-ajax-navigation.html
    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

-->
<div id="page_js_files"><!-- specific page javascript files here --></div>

</body>
</html>
