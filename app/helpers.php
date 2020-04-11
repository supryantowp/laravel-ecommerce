<?php

function presentPrice($price)
{
    return money_format('$%i', $price / 100);
}

function setActiveCategory($slug, $output = 'active')
{
    return request()->category == $slug ? 'active' : '';
}

function productImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('img/no-found.png');
}
