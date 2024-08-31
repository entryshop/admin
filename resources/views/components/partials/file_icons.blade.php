@pushonce('before_scripts')
    <script nonce="{{admin()->csp()}}">
        const file_type_map = {
            'image': [
                'image/png',
                'image/jpeg',
                'image/gif',
                'image/bmp',
                'image/webp',
                'image/svg+xml',
                'image/tiff',
                'image/x-icon',
                'image/vnd.microsoft.icon',
                'image/x-png',
                'image/x-jng',
                'image/x-ms-bmp',
                'image/x-xbitmap',
                'image/x-xpixmap',
            ],
            'ri-file-pdf-line': [
                'application/pdf',
                'application/x-pdf',
                'application/acrobat',
                'applications/vnd.pdf',
                'text/pdf',
                'text/x-pdf',
                'application/x-pkcs7-signature',
                'application/x-pkcs7-mime',
                'application/x-pkcs7-certreqresp',
                'application/x-pkcs7-certificates',
                'application/x-pkcs12',
            ],
            'ri-file-ppt-line': [
                'application/vnd.openxmlformats-officedocument.presentationml.presentation'
            ],
            'ri-file-excel-line': [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ],
            'ri-file-word-line': [
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-word.document.macroEnabled.12',
                'application/vnd.ms-word.template.macroEnabled.12',
                'application/vnd.ms-word.document.12',
                'application/vnd.ms-word.template.12',
                'application/vnd.ms-word.template.macroEnabledTemplate.12',
            ],
            'ri-video-line': [
                'video/mp4',
                'video/x-msvideo',
                'video/x-ms-wmv',
                'video/x-ms-asf',
                'video/x-ms-wmx',
                'video/x-ms-wvx',
                'video/x-flv',
                'video/mpeg',
                'video/quicktime',
                'video/x-m4v',
                'video/x-matroska',
                'video/webm',
            ],
            'ri-music-line': [
                'audio/mpeg',
                'audio/x-wav',
                'audio/x-ms-wma',
                'audio/x-ms-wax',
                'audio/x-ms-wmz',
                'audio/x-ms-wm',
                'audio/x-ms-wax',
                'audio/x-ms-wma',
                'audio/x-ms-wax',
                'audio/x-ms-wma',
                'audio/x-ms-wax',
            ]
        }

        function mapFilePreviewIcon(file_list) {
            for (let p in file_list) {
                let file_type = file_list[p].type;
                for (let type in file_type_map) {
                    if (file_type_map[type].indexOf(file_type) !== -1) {
                        if (type === 'image') {
                            file_list[p].is_image = true;
                            file_list[p].preview_icon = false;
                        } else {
                            file_list[p].is_image = false;
                            file_list[p].preview_icon = type;
                        }
                        break;
                    }
                    file_list[p].is_image = false;
                    file_list[p].preview_icon = 'ri-file-line';
                }
            }
            return file_list;
        }
    </script>
@endpushonce
