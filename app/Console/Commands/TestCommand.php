<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = "38fc4d210d8c4860bf9200441250802";

        $response = Http::get("https://api.weatherapi.com/v1/current.json", [
            'key' => $key,
            'q' => 'London',
            'aqi' => 'no'
        ]);

        return $response->status();
    }
}
