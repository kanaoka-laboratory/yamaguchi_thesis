<?php
copy('a.txt', 'b.txt');
$fp = fopen('a.txt', 'w');
fwrite($fp, 'hoge');
fclose($fp);
?>