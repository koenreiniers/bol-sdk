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

        // Remove last empty row
        array_pop($rows);

        foreach($rows as $row)
        {
            $columns = str_getcsv($row);
            $output[] = array_combine($headers, $columns);
        }

        return $output;
    }
}