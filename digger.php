<?php

// -s is a last data string
// -d is a difficulty level of calcs
$args = getopt('s:d:a:');
extract($args);

if ($s === null || $d === null || $a === null) {
  echo "-s AND -d AND -a IS REQUIRED!\r\n";
  return;
}

$goal = get_maxmimal_hash($d, $a);
echo "Algorithm: $a\r\n";
echo "Difficulty level = $d\r\n";
echo "Goal is <= $goal\r\n\r\n";
usleep(1500000);
$nonce = 0;
do {
  $hash = hash($a, $s . $nonce);
  echo "Nonce: $nonce\t$hash\r\n";
  $nonce++;
} while ($hash > $goal);

echo "Goal!\r\nNonce:\t$nonce\r\nGoal:\t$goal\r\nResult:\t$hash\r\n\r\n";

function get_maxmimal_hash($difficulty, $algo) {
  $fl = strlen(hash($algo, 1)) - $difficulty;
  return sprintf("%0{$difficulty}s%'f{$fl}s", '', '');
}
