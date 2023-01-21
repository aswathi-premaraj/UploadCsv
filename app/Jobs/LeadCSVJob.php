<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Lead;
use App\Models\ImportCsvProgress;

class LeadCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $header;
    public $data;
    public $progressId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header,$progressId)
    {
        $this->data = $data;
        $this->header = $header;
        $this->progressId = $progressId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $i=1;
        $error = 0;
        $failureReason = '';
        foreach ($this->data as $leads) {
            $items = [];
            $reason = '';
            $lead_csv_data = array_combine($this->header,$leads);
            $all = Lead::get()->toArray();
            if(count($all)>0){
            $firstName = array_unique(array_column($all, 'first_name'));
            $email = array_unique(array_column($all, 'email'));
            $mobile = array_unique(array_column($all, 'mobile_no'));
                if(!isset($lead_csv_data['First Name'])){
                    $reason .="Firstname is empty,";
                }else{
                    if(in_array($lead_csv_data['First Name'],$firstName)){
                        $reason .="Firstname already exist,";
                    }
                }
                if(!isset($lead_csv_data['Email'])){
                    $reason .="Email is empty,";
                }else{
                    if(in_array($lead_csv_data['Email'],$email)){
                        $reason .="Email already exist,";
                    }
                }
                if(!isset($lead_csv_data['Mobile Number'])){
                    $reason .="Mobile Number is empty,";
                }else{
                    if(in_array($lead_csv_data['Mobile Number'],$mobile)){
                        $reason .="Mobile already exist,";
                    }
                }
            }
           
           if($reason==''){
            
            $items = [
                'import_id'  => $this->progressId,
                'first_name' => isset($lead_csv_data['First Name']) ? $lead_csv_data['First Name']:null,
                'last_name' => isset($lead_csv_data['Last Name']) ? $lead_csv_data['Last Name']:null,
                'mobile_no' => isset($lead_csv_data['Mobile Number']) ? $lead_csv_data['Mobile Number']:null,
                'email' => isset($lead_csv_data['Email']) ? $lead_csv_data['Email']:null,
                'street1' => isset($lead_csv_data['Street1']) ? $lead_csv_data['Street1']:null,
                'street2' => isset($lead_csv_data['Street2']) ? $lead_csv_data['Street2']:null,
                'city' => isset($lead_csv_data['City']) ? $lead_csv_data['City']:null,
                'state' => isset($lead_csv_data['State']) ? $lead_csv_data['State']:null,
                'country' => isset($lead_csv_data['Country']) ? $lead_csv_data['Country']:null,
                'lead_source' => isset($lead_csv_data['Lead Source']) ? $lead_csv_data['Lead Source']:null,
                'status' => isset($lead_csv_data['Status']) ? $lead_csv_data['Status']:null,


                
            ]; 
            Lead::insert($items);
            
        }else{
        $failureReason .= $reason."on row ".$i.".";
        $error = 1; 
        }
        $i++;
        } 
        $progress = ImportCsvProgress::find($this->progressId);
            if($error==0){
                $progress->update([
                    'status'=>1,
                    
                ]);
            }else{
                $progress->update([
                    'status'=>0,
                    'reason'=>$failureReason
                ]);
            }

    }
}