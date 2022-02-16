<?php

if (!function_exists('success')) {
    function success($message)
    {
        request()->session()->flash('flash.banner', $message);
        request()->session()->flash('flash.bannerStyle', 'success');
    }
}
if (!function_exists('danger')) {
    function danger($message)
    {
        request()->session()->flash('flash.banner', $message);
        request()->session()->flash('flash.bannerStyle', 'danger');
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}
