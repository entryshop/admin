@extends('admin::layouts.html')

@push('body')
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{admin()->homeUrl()}}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{admin()->get('miniLogo', admin()->logo())}}" alt="" height="22">
                                {{admin()->logoText()}}
                            </span>
                                <span class="logo-lg">
                             <img src="{{admin()->logo()}}" alt="Logo" height="34">
                                    {{admin()->logoText()}}
                        </span>
                            </a>
                            <a href="{{admin()->homeUrl()}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{admin()->get('miniLogo', admin()->logo())}}" alt="" height="22">
                            {{admin()->logoText()}}
                        </span>
                                <span class="logo-lg fs-4 text-white">
                            <img src="{{admin()->logo()}}" alt="Logo" height="34">
                            {{admin()->logoText()}}
                        </span>
                            </a>
                        </div>
                        <button type="button"
                                class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                                id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">

                        <!-- top right menu -->
                        {!! render(admin()->children('top_right_components')) !!}

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        @if(auth()->user()?->avatar)
                                            <img class="rounded-circle header-profile-user"
                                                 src="{{auth()->user()?->avatar}}"
                                                 alt="{{auth()->user()?->name}}">
                                        @else
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-white bg-primary">
                                                    <span>{{mb_substr(auth()->user()?->name, 0, 1)}}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <span class="text-start ms-xl-2">
                                            <span
                                                class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                                {{auth()->user()?->name ?? __('admin::auth.guest')}}
                                            </span>
                                            <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"></span>
                                        </span>
                                    </span>
                            </button>
                            @include('admin::partials.user_menu', ['menus' => admin()->menus('user')])
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Light Logo-->
                <a href="{{admin()->homeUrl()}}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{admin()->get('miniLogo', admin()->logo())}}" alt="Logo" height="34" width="50"
                         class="object-fit-contain">
                </span>
                    <span class="logo-lg">
                    <img src="{{admin()->logo()}}" alt="Logo" height="34" width="200" class="object-fit-contain">
                </span>
                    {{admin()->logoText()}}
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                        id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    @include('admin::partials.main_menu', ['menus' => admin()->menus('main')])
                </div>
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('admin::partials.breadcrumbs')
                    {!! render(admin()->children('before_content')) !!}
                    @stack('before_content')
                    <!-- start page title -->
                    @stack('content')
                    @foreach(admin()->children() as $child)
                        {!! render($child) !!}
                    @endforeach
                    <!-- end page title -->
                    @stack('after_content')
                    {!! render(admin()->children('after_content')) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- End page -->
@endpush

@push('html_attributes')
    @foreach(admin()->theme() as $key => $value)
        {{$key}}="{{$value}}"
    @endforeach
@endpush

@pushonce('after_scripts')
    <script nonce="{{admin()->csp()}}" src="{{admin()->asset('js/main.js')}}"></script>
@endpushonce
