<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\TAdminCountry;
use App\Models\Admin\TAdminState;
use App\Models\Admin\TAdminCity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminCsvImportCo extends Controller
{
    public function showForm()
    {
        return view('admin.importCsv.import-csv');
    }

    public function importCsv(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
            'table_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('csv_file');
        $path = $file->storeAs('csv_uploads', time() . '.' . $file->getClientOriginalExtension());
        
        try {
            $this->processCsv(Storage::path($path),$request->table_name);
            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error processing CSV file: ' . $e->getMessage());
        }
    }

    protected function processCsv($filePath, $tableName)
    {
        $file = fopen($filePath, 'r');
        
        $header = fgetcsv($file);
        if($tableName=='country'){

            while ($row = fgetcsv($file)) {
                $countryData = [
                    'id' => $row[0],
                    'name' => $row[1], 
                    'iso3' => $row[2],
                    'numeric_code' => $row[3],
                    'iso2' => $row[4],
                    'phonecode' => $row[5],
                    'capital' => $row[6],
                    'currency' => $row[7],
                    'currency_symbol' => $row[8],
                ];
                
                $country = TAdminCountry::create($countryData);
            }
        }elseif($tableName=='state'){

            while ($row = fgetcsv($file)) {
                $countryData = [
                    'id' => $row[0],
                    'name' => $row[1], 
                    'country_id' => $row[2],
                    'country_code' => $row[3],
                    'country_name' => $row[4],
                    'state_code' => $row[5],
                    'type' => $row[6],
                    'latitude' => $row[7],
                    'longitude' => $row[8],
                ];
                
                $country = TAdminState::create($countryData);
            }

        }elseif($tableName=='city'){

            while ($row = fgetcsv($file)) {
                $countryData = [
                    'id' => $row[0], 
                    'name' => $row[1], 
                    'state_id' => $row[2],
                    'state_code' => $row[3],
                    'country_id' => $row[4],
                    'country_code' => $row[5],
                    'latitude' => $row[6],
                    'longitude' => $row[7],
                ];
                
                $country = TAdminCity::create($countryData);
            }

        }

        fclose($file);
    }
}

