<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/8/14
 * Time: 12:32 PM
 */
//    function cube($n)
//    {
//        return($n * $n * $n);
//    }
//
//    $a = array(1, 2, 3, 4, 5);
//    $b = array_map("cube", $a);
//    var_dump($b);
//    var_dump($a);
    require('Edge.php');
    require('Heap.php');

    $e1 = new Edge("a", "b", 6);
    $e2 = new Edge("b", "c", 4);
    $e3 = new Edge("d", "c", 5);
    $e4 = new Edge("a", "d", 2);
    $e5 = new Edge("a", "c", 1);
    $e6 = new Edge("b", "d", 3);
    //var_dump($e1);



    $list = array();

    $list[] = $e1;
    $list[] = $e2;
    $list[] = $e3;
    $list[] = $e4;
    $list[] = $e5;
    $list[] = $e6;

    $hs = array();
   // echo("<br>");
   // var_dump($list[0]->start);
   // $hs[$key] = 1;
//    $hs[$e1.start] = 1;
//
    $heap = new PQtest();

    foreach($list as $edge) {
        $heap->insert($edge, $edge -> distance);
        $hs[$edge->start] = 0;
        $hs[$edge->end] = 0;
    }
   // var_dump($heap);

    $len = 4;
    $res = array();

//    while($heap->valid()){
//        print_r($heap->current());
//        echo "<BR>";
//        $heap->next();
//    }

    while ( !$heap->isEmpty()&& count($res) < $len) {
        $cur = $heap->extract();

        if ($hs[$cur->start] > 0 && $hs[$cur->end] > 0) {
            continue;
        }

        $hs[$cur->start] = $hs[$cur->start] + 1;

        $hs[$cur->end] = $hs[$cur->end] + 1;

        if ($hs[$cur->start] == 1 || $hs[$cur->end] == 1) {
            $res[] = $cur;
        }
    }

//    print_r($hs['a']);
//    print_r($hs['b']);
//    print_r($hs['c']);
//    print_r($hs['d']);

//    console.log($hs['a']);
//    console.log($hs['b']);
//    console.log($hs['c']);
//    console.log($hs['d']);

    $start = '';
    $end = '';
    //var_dump($hs);

    foreach (array_keys($hs) as $key) {
        if ($hs[$key] == 1) {
            if($start == '') {
                $start = $key;
            } else {
                $end = $key;
                break;
            }
        }
    }


    //var_dump($res);

    $cur = $start;
    $sol = '';


    while ($cur != $end) {
        for ($i = 0; $i < count($res); $i++) {
            $e = $res[$i];

            if ($e -> start == $cur) {
                if ($sol == "") {
                    $sol = $cur."->". $e->distance ."->";
                } else {
                    $sol = $sol. $cur. "->". $e->distance ."->";
                }
                $cur = $e->end;
                unset($res[$i]);
                break;
            } elseif($e -> end == $cur) {
                if ($sol == "") {
                    $sol = $cur. $e->distance ."->";
                } else {
                    $sol = $sol. $cur. "->". $e->distance ."->";
                }
                $cur = $e->start;
                unset($res[$i]);
                break;
            }
        }
    }



    $sol = $sol.$end;
   // $sol = $sol. " -> ". $e->distance ." -> ". $end;
    print_r ("input node a,b,c,d, it is complete graph, so total six edges. The best choice is:");
    print_r($sol);











