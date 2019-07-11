//getting UTC time and matching to the tables time
<?php
//getting todays day
$day=date('l');
//loading required files automatically for reading and writing
require 'vendor/autoload.php';
//$day is todays day
$fxls =$day.'.xlsx';
//loading files to be read
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
//getting active sheet from
$xlsata = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
// print_r($xlsata[1]) ;
// $nr = count($xlsata);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
// $reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($fxls);
$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row number and column letter referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
// echo($highestRow.'</br>');
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
// echo($highestColumn.'</br>');
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
// echo($highestColumnIndex);

// $now = date('h:i A', time());
// echo '</br>'.$now.'</br>';
$cellAlpha='';
$cell_value='';
foreach (range('A',$highestColumn) as $i) {
	$cellAlpha.='/'. $xlsata[1][$i];
	$cell_value.=$i;
}
// echo implode(',',$cellAlpha);
echo $cellAlpha.'</br>';
// echo $cell_value.'</br>';
$split_data= explode("/", $cellAlpha);
print_r($split_data);
$hour='';
for ($i=2; $i <= $highestColumnIndex ; $i++) {
	$hour.='/'.date('H',strtotime($split_data[$i]));
}
print_r('</br>'.$hour.'</br>');
$splithour= explode("/", $hour);
print_r($splithour);
$min='';
for ($i=2; $i <= $highestColumnIndex ; $i++) {
	$min.='/'.date('i',strtotime($split_data[$i]));
}
print_r('</br>'.$min.'</br>');
$splitmin= explode("/", $min);
print_r($splitmin);
date_default_timezone_set('Asia/Kolkata');
$now = new DateTime();
$now->getTimestamp();
$time= new DateTime();
for ($i=1; $i < 13 ; $i++) {
	(int) $h=$splithour[$i];
	(int) $m=$splitmin[$i];
	if ($now < $time->setTime($h,$m)){
		echo '</br>'.$splithour[$i].':'.$splitmin[$i].'not yet. </br>';
	}
	else{
		echo '</br>'.$splithour[$i].':'.$splitmin[$i].' passed. </br>';
	}
}
?>
