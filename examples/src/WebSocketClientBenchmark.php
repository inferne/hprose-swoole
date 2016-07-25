<?php
require_once "../vendor/autoload.php";

use \Hprose\Future;
use \Hprose\Swoole\Client;

Future\co(function() {
    $test = new Client("ws://127.0.0.1:8088");
    $start = microtime(true);
    $n = 100;
    $m = 100;
    for ($j = 0; $j < $n; $j++) {
        $results = array();
        for ($i = 0; $i < $m; $i++) {
            $results[] = ($test->hello("$j-$i"));
        }
        (yield $results);
    }
    $total = microtime(true) - $start;
    $average = $total / $n / $m;
    var_dump($total);
    var_dump($average);
});
