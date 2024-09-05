<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddUserBalance implements ShouldQueue,ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $amount;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }

    /**
     * 任务的唯一 ID
     */
    public function uniqueId(): string
    {
        return $this->user->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(10);
        // 更新用户余额的逻辑
        $this->user->balance += $this->amount;
        $this->user->save();
    }
}
