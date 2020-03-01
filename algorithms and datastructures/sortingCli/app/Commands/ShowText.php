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
        $this->info('Running');
        $read = file_get_contents('Storage\shakespeare-complete-works.txt');
        $readLowerAndCleaned = preg_replace("#[[:punct:]]#", '', strtolower($read));

        $output = preg_replace('!\s+!', ' ', $readLowerAndCleaned);
        ini_set('memory_limit', '700M');

        $array = explode(' ',  $output);     
        file_put_contents('Storage\shakespeare-cleaned.txt', implode(' ', ($array)));


    



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
