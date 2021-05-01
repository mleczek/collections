<?php

use Mleczek\Collections\Collection;
use Mleczek\Collections\CollectionInterface;

if (function_exists('collection')) {
    throw new Exception('The collection helper method is already defined. Failed to initialize the mleczek/collections composer package.');
} else {
    function collection(array $items): CollectionInterface
    {
        return new Collection($items);
    }
}
