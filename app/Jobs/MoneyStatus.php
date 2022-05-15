<?php

namespace App\Jobs;

use App\Mail\MoneyReceived;
use App\Mail\MoneyReimbursed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MoneyStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $status, public $user)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->status === "received") {
            Mail::to($this->user->email)->send(new MoneyReceived($this->user));
        } else {
            Mail::to($this->user->email)->send(new MoneyReimbursed($this->user));
        }
    }
}
