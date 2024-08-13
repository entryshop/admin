<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{$title ?? admin()->brandName()}}</title>
<link rel="shortcut icon" type="image/png" href="{{admin()->favicon()}}">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<meta property="csp-nonce" content="{{admin()->csp()}}"/>

@stack('before_styles')

@foreach(admin()->css() as $css)
    <link href="{{$css}}" rel="stylesheet" type="text/css"/>
@endforeach

@stack('styles')

<style>
    :root {
    @foreach(admin()->cssVar() as $style_key => $style_value)
    {{$style_key}}: {{$style_value}};
    @endforeach
    }
</style>
@stack('after_styles')
