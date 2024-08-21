@stack('before_scripts')

@foreach(admin()->js() as $js)
    <script nonce="{{admin()->csp()}}" src="{{$js}}"></script>
@endforeach

@stack('scripts')
@foreach(admin()->scripts() as $script)
    <script nonce="{{admin()->csp()}}">
        {!! $script !!}
    </script>
@endforeach

@include('admin::partials.admin_scripts')
@include('admin::partials.toasts')
@include('admin::partials.iframe')

@stack('after_scripts')
