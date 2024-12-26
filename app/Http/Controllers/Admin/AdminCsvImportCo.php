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
        $countryList = TAdminState::with('cities')->orderBy('country_id','ASC')->get();
        
        return view('admin.importCsv.import-csv',compact('countryList'));
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
                    'name' => mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1'),
                    'latitude' => $row[2],
                    'longitude' => $row[3],
                ];
                
                $country = TAdminCountry::create($countryData);
            }
        }elseif($tableName=='state'){

            while ($row = fgetcsv($file)) {
                $stateData = [
                    'id' => $row[0],
                    'name' => mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1'),
                    'country_id' => $row[2],
                    'country_name' => mb_convert_encoding($row[3], 'UTF-8', 'ISO-8859-1'),
                    'latitude' => $row[4],
                    'longitude' => $row[5],
                ];
                
                $state = TAdminState::create($stateData);
            }

        }elseif($tableName=='city'){

            while ($row = fgetcsv($file)) {
                $cityData = [
                    'id' => $row[0], 
                    'name' => mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1'), 
                    'state_id' => $row[2],
                    'country_id' => $row[3],
                    'latitude' => $row[4],
                    'longitude' => $row[5],
                ];
                
                $city = TAdminCity::create($cityData);
            }

        }

        fclose($file);
    }
}

