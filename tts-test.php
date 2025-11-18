<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use Pejman\Agi\Client;

$agi = new Client();

$agi->answer();

$agi->sayText('سلام پژمان جان، خوش آمدی به دنیای جدید ای جی آی مدرن با صدای ایرانی واقعی');

$agi->sayText('امروز هجدهم نوامبر دو هزار و بیست و پنج است و ما داریم تاریخ می‌سازیم');

$agi->hangup();