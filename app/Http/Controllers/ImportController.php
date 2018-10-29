<?php

namespace App\Http\Controllers;

use App\Client;
use App\CsvData;
use Illuminate\Http\Request;
use Validator;

class ImportController extends Controller
{
    public function getImport()
    {
        return view('import.import');
    }

    public function parseImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $path = $request->file('csv_file')->getRealPath();
            $data = array_map('str_getcsv', file($path));

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);

            $dataLength = count($data);
            $csv_data = array_slice($data, 0, $dataLength);

            return view('import.import_fields', compact('csv_data', 'csv_data_file'));
        }

    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);

        foreach ($csv_data as $row) {

            //print_r($row[2]); // ROW NA POSIÇÃO 2 PEGA CADA EMAIL

            $client = new Client();
            foreach (config('app.db_fields') as $index => $field) {
                $client->$field = $row[$request->fields[$index]];
            }
            $client->save();
        }

        return redirect('clients')->with('success','Lista de clientes importada com sucesso!');
    }


}
