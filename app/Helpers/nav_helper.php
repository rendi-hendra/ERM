<?php

function navActive($segment, $current)
{
    return $segment === $current
        ? 'text-blue-600 font-medium bg-blue-50 px-3 py-1.5 rounded-lg'
        : 'text-gray-700 hover:text-blue-600';
}

function tabActive($segment, $current)
{
    return $segment === $current
        ? 'text-blue-600 border-blue-600 font-medium'
        : 'text-gray-600 hover:text-blue-600 border-transparent hover:border-blue-600';
}
