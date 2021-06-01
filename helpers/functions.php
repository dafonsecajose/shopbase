<?php

function formatPriceToDatabase($price)
{
    return str_replace(['.', ','], ['', '.'], $price);
}


function multi_array_key_exists($key, array $array): bool
{
    if (array_key_exists($key, $array)) {
        return true;
    }
    foreach ($array as $v) {
        if (is_array($v) && multi_array_key_exists($key, $v)) {
            return true;
        }
    }
    return false;
}

function formatNumberToHuman($data)
{
    return number_format($data, 2, ',', '.');
}

function formatCEPToHuman($zipCode)
{
    return substr_replace(substr_replace($zipCode, '-', -3, 0), '.', 2, 0);
}
