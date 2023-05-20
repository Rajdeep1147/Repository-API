<?php

namespace App\Jobs;

use App\Mail\JobTestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\SendEmailTest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CalculateDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $request;
    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request= $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailTest();
        Mail::to($this->request['email'])->send($email);
    }
}
