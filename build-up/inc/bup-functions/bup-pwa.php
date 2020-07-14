<?php

add_filter('web_app_manifest', function ($manifest) {
    $manifest['short_name'] = 'Bup';
    $manifest['background_color'] = '#333333';
    $manifest['display'] = 'standalone';

    return $manifest;
});
