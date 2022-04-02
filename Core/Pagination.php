<?php

namespace core;

class Pagination {

    private $current_page;
    private $total;
    private $amount;
    private $limit = 3;
    private $max = 5;

    public function __construct($total, $limit, $current_page) {

        $this->total = $total;
        $this->limit = $limit;
        $this->amount = ceil($this->total / $this->limit);
        $this->current_page = $current_page;
    }

    public function render(){

        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination">';

        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->current_page > 1)
                $links = $this->generateHtml(1, '&lt;') . $links;
            if ($this->current_page < $this->amount)
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';
        return $html;

    }

    private function generateHtml($page, $text = null) {

        if (!$text) {
            $text = $page;
        }

        return '<li class="page-item"><a class="page-link" href="' . $page . '">' . $text . '</a></li>';
    }

    private function limits() {

        $start = $this->current_page - floor($this->max / 2);
        $start = $start > 0 ? $start : 1;

        if ($start + $this->max > $this->amount) {
            $end = $this->amount;
            $start = $end - $this->max + 1;
        } else {
            $end = $start + $this->max - 1;
        }

        return array($start, $end);
    }

}