<?php

function formatPriceToDatabase($price)
{
    return str_replace(['.', ','], ['', '.'], $price);
}
