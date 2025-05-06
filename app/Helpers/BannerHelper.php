<?php

use App\Models\PageBanner;

if (!function_exists('getBanner')) {
    function getBanner($page_name)
    {
        return PageBanner::where('page_name', $page_name)->first();
    }
}
