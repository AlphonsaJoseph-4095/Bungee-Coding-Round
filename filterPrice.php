<?php
$csv = array_map("str_getcsv", file("output/filteredCountry.csv", FILE_SKIP_EMPTY_LINES));
$keys = array_shift($csv);
foreach ($csv as $i => $row) {
    $output[$i] = array_combine($keys, $row);
}
$result = array();
foreach ($output as $row) {
    $result[$row['SKU']][] = $row;
}

foreach ($result as $i => $row) {
    $filtered[$i] = [
        "SKU" => $row[0]['SKU'],
        "FIRST_PRICE" => $row[0]['PRICE'],
        "SECOND_PRICE" => isset($row[1]) ? $row[1]['PRICE'] : $row[0]['PRICE']
    ];
}

$file = fopen("output/lowestPrice.csv", "w");
fputcsv($file, ["SKU","FIRST_PRICE","SECOND_PRICE"]);
foreach ($filtered as $line) {
    fputcsv($file, $line);
}


$result = array_values($filtered);
echo json_encode($result);
