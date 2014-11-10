<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/8/14
 * Time: 1:06 PM
 */

class PQtest extends SplPriorityQueue
{
    public function compare($priority1, $priority2)
    {
//        if ($priority1 === $priority2) return 0;
//        return $priority1 < $priority2 ? -1 : 1;
        return $priority2 - $priority1;
    }
}