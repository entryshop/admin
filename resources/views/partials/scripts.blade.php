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

@include('admin::partials.toasts')

@stack('after_scripts')
