<?php

namespace App\Utils;

class CsvParser
{
    public static function csvFileToAssociativeArray(string $filePath)
    {
        $fileRows = file($filePath);
        $header = array_shift($fileRows);

        $data = [];

        foreach ($fileRows as $fileRow) {
            $data[] = array_combine(str_getcsv($header), str_getcsv($fileRow));
        }

        return $data;
    }
}
