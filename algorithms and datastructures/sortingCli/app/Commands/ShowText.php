<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Storage;
use Illuminate\Support\Facades\File;

class ShowText extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'showText';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    //file::get('Storage\shakespeare-complete-works.txt');
    $read = file_get_contents('Storage\shakespeare-complete-works.txt');
    //$readLower = array_map('strtolower', $read);

    $readLowerAndCleaned = preg_replace("#[[:punct:]]#", '', strtolower($read));
    $this->info(implode(', ', $readLowerAndCleaned."\n"));


    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
