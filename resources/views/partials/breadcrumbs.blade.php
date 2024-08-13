<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0">
                @if($back_url = admin()->back())
                    <a href="{{$back_url}}" class="me-2"><i class="ri-arrow-left-line"></i></a>
                @endif
                {{admin()->title()}}
            </h4>
        </div>
    </div>
</div>
