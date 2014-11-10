<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/8/14
 * Time: 12:32 PM
 */

class Edge {
    public $start;
    public $distance;
    public $end;

    function __construct($start,  $end, $distance) {
        $this->start = $start;
        $this->end = $end;
        $this->distance = $distance;

    }
}