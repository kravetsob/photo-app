<?php

namespace app\controllers;

class Page
{
    /**
     * Returns the address of the page from which the user navigated
     * @return string
     */
    public static function currentPage(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '/';
    }
}