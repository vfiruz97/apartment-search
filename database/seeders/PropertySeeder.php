<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [];
        $path = storage_path('data/csv/property-data.csv');
        $pure_data = $this->getCsvLinesInArray($path);
        foreach ($pure_data as $property_values) {
            if (count($property_values) !== 6) throw new \Exception('Parse Error: wrong structured data in the csv file ' . $path);

            $properties[] = [
                'name'      => $property_values[0],
                'price'     => $property_values[1],
                'bedrooms'  => $property_values[2],
                'bathrooms' => $property_values[3],
                'storeys'   => $property_values[4],
                'garages'   => $property_values[5],
            ];
        }
        if (empty($properties)) return;
        DB::table('properties')->insert($properties);
    }

    /**
     * Get data from csv file.
     *
     * @return array
     */
    protected function getCsvLinesInArray($file_path): array
    {
        $result = [];
        $first_line = true;
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            while (($data_line = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Skip the 1st row because it has the column name instead of the data.
                if ($first_line) {
                    $first_line = false;
                    continue;
                }
                $result[] = $data_line;
            }
            fclose($handle);
        }
        return $result;
    }
}
