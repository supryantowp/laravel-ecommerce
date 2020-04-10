<?php

function presentPrice($price)
{
    return money_format('$%i', $price / 100);
}

function setActiveCategory($slug, $output = 'active')
{
    return request()->category == $slug ? 'active' : '';
}
