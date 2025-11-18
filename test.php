<?php

require 'vendor/autoload.php';

use Pejman\Agi\Client;

$agi = new Client();

echo "CallerID: " . $agi->getCallerId() . PHP_EOL;

$agi->answer();
$agi->streamFile('tt-monkeys');
$agi->hangup();