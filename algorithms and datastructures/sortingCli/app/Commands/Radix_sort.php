<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Radix_sort extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'radix_sort';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    function radix_sort($elements) {
        // Array for 10 queues.
        $queues = array(
          array(), array(), array(), array(), array(), array(), array(), array(),
          array(), array()
        );
        // Queues are allocated dynamically. In first iteration longest digits
        // element also determined.
        $longest = 0;
        foreach ($elements as $el) {
          if ($el > $longest) {
            $longest = $el;
          }
          array_push($queues[$el % 10], $el);
        }
        // Queues are dequeued back into original elements.
        $i = 0;
        foreach ($queues as $key => $q) {
          while (!empty($queues[$key])) {
            $elements[$i++] = array_shift($queues[$key]);
          }
        }
        // Remaining iterations are determined based on longest digits element.
        $it = strlen($longest) - 1;
        $d = 10;
        while ($it--) {
          foreach ($elements as $el) {
            array_push($queues[floor($el/$d) % 10], $el);
          }
          $i = 0;
          foreach ($queues as $key => $q) {
            while (!empty($queues[$key])) {
              $elements[$i++] = array_shift($queues[$key]);
            }
          }
          $d *= 10;
        }
      }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '900M');
        
        $random_number_array = range(0, 5000000);
        shuffle($random_number_array);

        $this->info('Running Radix Sort');

        $read = file_get_contents('Storage\shakespeare-cleaned.txt');
       
        $start_time = microtime(true);
        //$array = explode(' ',  $read);   
        //file_put_contents('Storage\merge_sort.txt', implode(' ', ( $this->merge_sort($array))));
        
        $this->info("\nSorted Array :");
        $this->info(implode(', ', $this->radix_sort($random_number_array))."\n");
        
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
