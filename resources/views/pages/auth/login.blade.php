<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                 viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="#" class="d-inline-block auth-logo">
                                <img src="{{admin()->logo()}}" alt="" height="40">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium"></p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">
                        <div class="card-body p-4">
                            <div class="p-2 mt-4">
                                @include('admin::partials.errors')
                                <form action="{{admin()->loginUrl()}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">@lang('admin::auth.username')</label>
                                        <input type="text" class="form-control" name="username"
                                               value="{{old('username')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="password-input">@lang('admin::auth.password')</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input"
                                                   name="password">
                                            <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100"
                                                type="submit">@lang('admin::auth.login')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
</div>

@push('after_scripts')
    <script nonce="{{admin()->csp()}}" src="{{ admin()->asset('libs/particles.js/particles.js') }}"></script>
    <script nonce="{{admin()->csp()}}" src="{{ admin()->asset('js/pages/particles.app.js') }}"></script>
    <script nonce="{{admin()->csp()}}" src="{{ admin()->asset('js/pages/password-addon.init.js') }}"></script>
@endpush
