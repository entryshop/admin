@php
    $value = interpolate($value, $renderable->getContext());
    if(!empty($href)) {
        $link = true;
        $href = interpolate($href, $renderable->getContext());
        $target = $target??'_self';
    } else {
        $link = false;
    }

    if($is_currency??false) {
        $value = currency($value, $currency_in??'', $currency_locale??null);
    }

@endphp

@if($link)
    <a href="{{$href}}" target="{{$target}}">
        @endif
        @if($escape??false)
            {!! to_string($value) !!}
        @else
            {{ to_string($value) }}
        @endif
        @if($link)
    </a>
@endif

@if($copyable??false)
    <span data-copy data-value="{{to_string($value)}}" role="button" title="@lang('admin::crud.copy')"><i
            class="ri-clipboard-line"></i></span>
    @pushonce('scripts')
        <script nonce="{{admin()->csp()}}">
            async function copyTextToClipboard(text) {
                if (navigator.clipboard && window.isSecureContext) {
                    try {
                        await navigator.clipboard.writeText(text);
                        console.log('Text copied to clipboard');
                    } catch (err) {
                        console.error('Failed to copy text: ', err);
                    }
                } else {
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    textArea.style.position = 'fixed';  //避免滚动到页面底部
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    try {
                        const successful = document.execCommand('copy');
                        const msg = successful ? 'successful' : 'unsuccessful';
                        console.log('Fallback: Copying text command was ' + msg);
                    } catch (err) {
                        console.error('Fallback: Oops, unable to copy', err);
                    }
                    document.body.removeChild(textArea);
                }
            }

            document.querySelectorAll('span[data-copy]').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    copyTextToClipboard(this.getAttribute('data-value'));
                    this.innerHTML = '<i class="text-success ri-check-line"></i>';
                    setTimeout(function () {
                        this.innerHTML = '<i class="ri-clipboard-line"></i>';
                    }.bind(this), 3000);
                });
            });
        </script>
    @endpushonce
@endif
