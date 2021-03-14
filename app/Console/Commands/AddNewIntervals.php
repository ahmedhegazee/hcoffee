<?php

namespace App\Console\Commands;

use App\Models\Interval;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddNewIntervals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:intervals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new intervals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $maxGuestsCount = Setting::where("name", "عدد الافراد في الفترة الواحدة")->first()->value;
        $date = new Carbon();
        $intervals =  [];
        for ($i = 1; $i <= 365; $i++) {
            $intervals[]
                = [
                    "date" => now()->addDays($i),
                    "type" => 0,
                    "max_guests_count" => $maxGuestsCount
                ];
            $intervals[]
                = [
                    "date" => now()->addDays($i),
                    "type" => 1,
                    "max_guests_count" => $maxGuestsCount
                ];
        }
        Interval::insert($intervals);
        return 0;
    }
}