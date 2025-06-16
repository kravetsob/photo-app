<?php

namespace app\core;


class Page
{
    protected int $current;
    protected int $all;
    public function __construct($photosAmount)
    {
        $this->current = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $this->all = $this->all($photosAmount);
    }

    /**
     * Calculates total pages
     * @return float|int
     */
    protected function all($photosAmount): int
    {
        if ($photosAmount < 1) {
            return 1;
        }

        return (int) ceil($photosAmount / IMG_LIMIT);
    }

    /**
     * Returns current page
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * Returns the total number of pages
     * @return int
     */
    public function getAll(): int
    {
        return $this->all;
    }

    /**
     * Returns the next page or null
     * @return int|null
     */
    public function next(): ?int
    {
        $next = $this->current + 1;
        if ($next <= $this->all) {
            return $next;
        }

        return null;
    }
    /**
     * Returns the previous page or null
     * @return int|null
     */
    public function prev(): ?int
    {
        $prev = $this->current - 1;
        if ($prev > 0) {
            return $prev;
        }

        return null;
    }

    /**
     * Returns the address of the page from which the user navigated
     * @return string
     */
    public static function currentPage(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '/';
    }
}
