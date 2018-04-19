<?php

//echo 'This is a message from test.php!';

//echo strlen("  ");
//var_dump(empty("  "));

//echo (bool)" " . (int) '5n' . (int)(string)14E-1;

$a = 9870E-1 !== 987;
var_dump(987);
var_dump(9870E-1);

$text = '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>';
echo strip_tags($text);
echo "\n";

// Allow <p> and <a>
echo strip_tags($text, '<p><a>');

