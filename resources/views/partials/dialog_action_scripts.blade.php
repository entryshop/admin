@push('after_scripts')
    <script nonce="{{admin()->csp()}}">
        @if($action = admin()->getContext('action'))
            @if(!is_array($action[0]??null))
                @php
                    $action = [$action];
                @endphp
            @endif

            @foreach($action as $item)
            window.parent.admin.actionResponse(@json($item));
          @endforeach
        @endif

        @if(admin()->getContext('close'))
        window.parent.admin.closeIframeModal();
        @endif
    </script>
@endpush
