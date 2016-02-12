<?php
namespace Kr\Bol\Utils;

class CsvParser
{
    /**
     * Convert csv string to array with headers as keys for each row
     * @param string $csvString
     * @return array
     */
    public function parse($csvString)
    {
        $rows = explode(PHP_EOL, $csvString);

        $headers = str_getcsv(array_shift($rows));

        // Remove last row if it's empty
        $lastRow = end($rows);
        if($lastRow === "") {
            array_pop($rows);
        }


        $output = [];

        foreach($rows as $row)
        {
            $columns = str_getcsv($row);
            $output[] = array_combine($headers, $columns);
        }

        return $output;
    }
}