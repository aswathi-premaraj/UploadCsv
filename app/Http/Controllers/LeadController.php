<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportCsvProgress;
use App\Jobs\LeadCSVJob;
use App\Models\Lead;


class LeadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function uploadCsvFile(Request $request)
    {
        if( $request->has('csv') ) {
            $csv    = file($request->csv);
            $file   = $request->csv;
            $chunks = array_chunk($csv,1000);
            $header = [];
            $progress = ImportCsvProgress::create(['file_name'=>$file->getClientOriginalName()]);
            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                LeadCSVJob::dispatch($data, $header,$progress->id);                
            }
            return redirect()->route('list.import.status')->with([
                'success' => 'CSV file queued for importing, Please wait couple of minutes to complete.',
            ]);

        }else{
        return redirect()->route('list.import.status')->with([
            'error' => 'Please select file',
        ]);
        }
    }
    public function listImportStatus(){
         $lists = ImportCsvProgress::all();
         return view('import_status',compact('lists'));
    }
    public function listCsvData($importId){
        $lists = Lead::where('import_id',decrypt($importId))->get();
        return view('view_csv',compact('lists'));
   }
}