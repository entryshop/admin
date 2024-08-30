<?php

namespace Entryshop\Admin\Http\Controllers;

use Entryshop\Admin\Http\Controllers\Traits\HasApiResponse;
use Illuminate\Support\Facades\Storage;

class UploadController
{
    use HasApiResponse;

    public function __invoke()
    {
        $file_field = request('file_field') ?? 'file';
        if (!request()->hasFile($file_field)) {
            return $this->error('File not found');
        }

        $file = request()->file($file_field);

        if (is_array($file)) {
            $result = [];
            foreach ($file as $item) {
                $result[] = $this->upload($item, request('key'));
            }
            return $this->success($result);
        }

        $result = $this->upload($file, request('key'));

        return $this->success($result);
    }

    protected function upload($file, $key = null)
    {
        $key ??= 'url';
        $url = Storage::url($file->store('uploads'));
        return [
            $key   => $url,
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'type' => $file->getMimeType(),
        ];
    }
}
