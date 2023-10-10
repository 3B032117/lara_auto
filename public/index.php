<?php
require '../vendor/autoload.php';

// 類別先import進來
use Demo\Hello\Lara;
use Demo\Hello\Someone;
$lara= new Lara();
$vincent= new Someone('Vincent');

// 類別未先import進來
$mary= new \Demo\Hello\Someone('Mary');
$john= new Demo\Hello\Someone('John');
$hello= new Demo\HelloWorld();

use Demo\HelloWorld as World; // 類別另取別名
$world = new World();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('WISD');
$log->pushHandler(new StreamHandler('../log/my.log', Level::Warning));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

echo "<br/>";

use Carbon\Carbon;

printf("Right now is %s <br/>", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s <br/>", Carbon::now('America/Vancouver'));  //implicit __toString()
printf("Right now in Taipei is %s <br/>", Carbon::now('Asia/Taipei'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);

$officialDate = Carbon::now()->toRfc2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$internetWillBlowUpOn = Carbon::create(2038, 01, 19, 3, 14, 7, 'GMT');

// Don't really want this to happen so mock now
Carbon::setTestNow(Carbon::createFromDate(2000, 1, 1));

// comparisons are always done in UTC
if (Carbon::now()->gte($internetWillBlowUpOn)) {
    die();
}

// Phew! Return to normal behaviour
Carbon::setTestNow();

if (Carbon::now()->isWeekend()) {
    echo 'Party!';
}

echo "<br/>";
// Over 200 languages (and over 500 regional variants) supported:
echo Carbon::now()->subMinutes(2)->diffForHumans()."<br/>"; // '2 minutes ago'
echo Carbon::now()->subMinutes(2)->locale('zh_CN')->diffForHumans()."<br/>"; // '2分钟前'
echo Carbon::now()->subMinutes(2)->locale('zh_TW')->diffForHumans()."<br/>"; // '2分钟前'
echo Carbon::parse('2019-07-23 14:51')->isoFormat('LLLL')."<br/>"; // 'Tuesday, July 23, 2019 2:51 PM'
echo Carbon::parse('2019-07-23 14:51')->locale('fr_FR')->isoFormat('LLLL')."<br/>"; // 'mardi 23 juillet 2019 14:51'

// ... but also does 'from now', 'after' and 'before'
// rolling up to seconds, minutes, hours, days, months, years

$daysSinceEpoch = Carbon::createFromTimestamp(0)->diffInDays();