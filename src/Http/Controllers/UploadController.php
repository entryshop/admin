<?php

namespace Entryshop\Admin\Http\Controllers;

use Entryshop\Admin\Http\Controllers\Traits\HasApiResponse;
use Illuminate\Support\Facades\Storage;

class UploadController
{
    use HasApiResponse;

    public function __invoke()
    {
        if (!request()->hasFile('file')) {
            return $this->error('File not found');
        }
        $url = Storage::url(request()->file('file')->store('uploads'));
        $key = request('key') ?? 'url';
        return $this->success([
            $key => $url,
        ]);
    }
}
