<?php

namespace App\Core;

class Pagination
{
    public $currentPage;
    public $perPage;
    public $totalCount;

    /**
     * Class constructor.
     *
     * @param integer $page
     * @param integer $per_page
     * @param integer $total_count
     */
    public function __construct($page = 1, $perPage = 20, $totalCount = 0)
    {
        $this->currentPage = (int)$page;
        $this->perPage = (int)$perPage;
        $this->totalCount = (int)$totalCount;
    }

    /**
     * Get the offset.
     *
     * @return number $offset
     */
    public function offset()
    {
        return $this->perPage * ($this->currentPage - 1);
    }

    /**
     * Get the number of total pages.
     *
     * @return number $totalPages
     */
    public function totalPages()
    {
        return ceil($this->totalCount / $this->perPage);
    }

    /**
     * Get the previous page number.
     *
     * @return number $previousPage
     */
    public function previousPage()
    {
        $previous = $this->currentPage - 1;

        return ($previous > 0) ? $previous : false;
    }

    /**
     * Get the next page number.
     *
     * @return number $nextPage
     */
    public function nextPage()
    {
        $next = $this->currentPage + 1;

        return ($next <= $this->totalPages()) ? $next : false;
    }

    /**
     * Display the previous link.
     *
     * @param string $url
     * @return string $link
     */
    public function previousLink($url = '')
    {
        $link = '';

        if ($this->previousPage() !== false) {
            $link = '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $this->previousPage() . '">';
            $link .= '&laquo; Previous</a></li>';
        }

        return $link;
    }

    /**
     * Display the next link.
     *
     * @param string $url
     * @return string $link
     */
    public function nextLink($url = '')
    {
        $link = '';

        if ($this->nextPage() !== false) {
            $link = '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $this->nextPage() . '">';
            $link .= 'Next &raquo;</a></li>';
        }

        return $link;
    }

    /**
     * Display numbered links.
     *
     * @param string $url
     * @return string $links
     */
    public function numberLinks($url = '')
    {
        $links = '';

        for ($i = 1; $i <= $this->totalPages(); $i++) {
            if ($i == $this->currentPage) {
                $links .= '<li class="page-item disabled"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
            } else {
                $links .= '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        return $links;
    }

    /**
     * Display all pagination links.
     *
     * @param string $url
     * @return string $links
     */
    public function links($url)
    {
        $links = '';

        if ($this->totalPages() > 1) {
            $links = '<div class="text-center">';
            $links .= '<ul class="pagination justify-content-center">';
            $links .= $this->previousLink($url);
            $links .= $this->numberLinks($url);
            $links .= $this->nextLink($url);
            $links .= '</ul>';
            $links .= '</div>';
        }

        return $links;
    }
}
