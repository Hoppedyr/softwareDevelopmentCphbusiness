<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class MergeSort extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'mergeSort';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Merge Sort';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    function merge_sort($my_array){
        if(count($my_array) == 1 ) return $my_array;
        
        $mid = count($my_array) / 2;
        $left = array_slice($my_array, 0, $mid);
        $right = array_slice($my_array, $mid);
    
        $left = $this->merge_sort($left);
        $right = $this->merge_sort($right);
        return $this->merge($left, $right);
        
    }
    function merge($left, $right){
        $res = array();
        while (count($left) > 0 && count($right) > 0){
            if($left[0] > $right[0]){
                $res[] = $right[0];
                $right = array_slice($right , 1);
            }else{
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }
        while (count($left) > 0){
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }
        while (count($right) > 0){
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }
        return $res;
    }
    
    public function handle()
    {
        $this->info('Running Merge Sort');

        $random_number_array = range(0, 100000);
        shuffle($random_number_array);
            
    
        $start_time = microtime(true);
        //$this->info(implode(', ', $this->merge_sort($random_number_array))."\n");
        $this->merge_sort($random_number_array);
        $this->info('it is sortet');
        $end_time = microtime(true);
        $this->info($end_time - $start_time . 'sec');

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
