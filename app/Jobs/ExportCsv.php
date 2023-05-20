<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ExportUsersMail;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class ExportCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    $filename = 'student-' . time() . 1234 . '.csv';
    $data = Student::all();
   
    // Set the CSV header row
    $header = ['name', 'email','password'];
  
    $path = Storage::disk('public')->path($filename);
    $file = fopen($path, 'w');
    fputcsv($file, [
        'name',
        'email',
        'password'
        
    ]);

   fputcsv($file, $header);

    foreach ($data as $row) {
        fputcsv($file, [$row->name, $row->email,$row->password]);
    }
    fclose($file);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    // Output the CSV file contents to the response
    readfile('php://output');
    
    
    Mail::to('rajdeep@lawsikho.in')->send(new ExportUsersMail(data:$data));
    
    }
}
