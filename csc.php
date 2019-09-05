<?php
/*
 * Запус скрипта php csc.php input.txt
 *
 * */
function main($argv)
{
    $file = $argv[1];
    if (file_exists($file)) {

        $str = file_get_contents($file);
        $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
        $str = preg_replace('/\s+/', ' ', $str);
        $str = mb_strtolower ($str);

        $words = explode(' ', $str);
        $words = array_unique($words);

        $result = [];
        $resultStr = '';

        foreach ($words as $word) {
            $result[$word] = mb_substr_count($str . ' ', $word . ' ');
        }

        arsort($result);

        foreach ($result as $key=>$item) {
            $resultStr .= $key . ' - ' . $item . PHP_EOL;
        }

        $f = fopen('file.cs', 'w');
        fwrite($f, $resultStr);
        fclose($f);
    } else {
        echo 'file not found';
    }
}

main($argv);

