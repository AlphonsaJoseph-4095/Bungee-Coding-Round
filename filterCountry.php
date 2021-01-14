<?php
$csv = array_map("str_getcsv", file("input\main.csv", FILE_SKIP_EMPTY_LINES));
$keys = array_shift($csv);
foreach ($csv as $i => $row) {
    $combinedRow = array_combine($keys, $row);
    if (stristr($combinedRow['COUNTRY'], "USA")) {
        $output[$i] = $combinedRow;
    }
}
$file = fopen("output/filteredCountry.csv", "w");
fputcsv($file, $keys);
foreach ($output as $line) {
    fputcsv($file, $line);
}

fclose($file);


$output = array_values($output);
echo json_encode($output);
