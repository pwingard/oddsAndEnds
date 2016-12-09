<?php
//build a test array
foreach (range(1, 25) as $row) {
    foreach (range(1, 10) as $col) {
        $data[$row][$col]=rand(0, 1000);
    }
}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=somename.csv");
header("Pragma: no-cache");
header("Expires: 0");

outputCSV($data);

function outputCSV($data) {
    
    $outputBuffer = fopen("php://output", 'w');
    
//get col names from keys
     foreach ($data as $row) {
        foreach ($row as $colName => $value) {
           $keyCol[]=$colName; 
        }
        break;
    }
    fputcsv($outputBuffer, $keyCol);
    foreach($data as $row) {
        foreach ($row as $cell) {
            $thisrow[]=$cell;
        }
        fputcsv($outputBuffer, $thisrow);//write each array once as an entire row
        $thisrow=array();
    }
    fclose($outputBuffer);
 }
