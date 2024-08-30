/**
 * amis v6.7.0
 * build time: 2024-08-06
 * Copyright 2018-2024 baidu
 */

var ICONS = [
    {
        name: 'Font Awesome 4.7',
        prefix: 'fa fa-',
        icons: [
            'slideshare',
            'snapchat',
            'snapchat-ghost',
            'snapchat-square',
            'soundcloud',
            'spotify',
            'stack-exchange',
            'stack-overflow'
        ]
    }
];
function setIconVendor(icons) {
    ICONS = icons;
}

export { ICONS, setIconVendor };
window.amisVersionInfo={version:'6.7.0',buildTime:'2024-08-06'};
