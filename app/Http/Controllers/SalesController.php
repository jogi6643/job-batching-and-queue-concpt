<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Jobs\SalesCsvProcess;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
class SalesController extends Controller
{
    public function upload()
    {
        if(request()->has('mycsv'))
        {
            // $data =  array_map('str_getcsv',file(request()->mycsv));
            $data =  file(request()->mycsv);
            // $header = $data[0];
            // unset($data[0]);
            // chunking files
           $chunks =  array_chunk($data,1000);
           // convert 1000 chunks a new csv files
           $path = resource_path('temp');
        //    foreach ($chunks as $key => $chunk) {
        //      $name = "/tmp{$key}.csv";
            
        //      file_put_contents($path . $name,$chunk);
        //    } 
           
           $files = glob("$path/*.csv");
           $header = [];
           $batch = Bus::batch([])->dispatch();
        //    foreach ($files as $key => $file) {
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv',$chunk);
               
             
              if($key == 0)
              {
                  $header = $data[0];
                  unset($data[0]);
              }
             $batch->add(new SalesCsvProcess($data,$header));
            //   SalesCsvProcess::dispatch($data,$header);
            
            //  unlink($file);
           }
           
            return $batch;
        
        }
        return 'please upload the csv file';
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}
