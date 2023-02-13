<?php

namespace App\Jobs;

use App\Models\Task;

use App\Imports\VgoImport;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Maatwebsite\Excel\Facades\Excel;

class ImportVgo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $task_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $task_id)
    {
        $this->file = $file;
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        dd($this->file);
        
        $newTask = Task::find($this->task_id);
        $newTask->status = true;
        $newTask->save();

    }
}
