<?php

use Illuminate\Support\Facades\Route;

/**
 * 将当前请求的路由名称转换为 CSS 类名称
 * @return array|string|string[]|null
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 焦点
 * @param $category_id
 * @return string
 */
function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}
