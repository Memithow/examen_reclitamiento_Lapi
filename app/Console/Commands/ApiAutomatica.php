<?php

namespace App\Console\Commands;

use App\Models\MensajesAutomaticos;
use App\Models\RandomData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApiAutomatica extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $response = Http::withoutVerifying()->get('https://random-data-api.com/api/stripe/random_stripe');
        $resp_json = $response->json();
        unset($resp_json['id']);
        RandomData::create($resp_json);

        $texto = '[ '.date('Y-m-d H:i:s').' ] : Tarea registro Api';

        Storage::append("archivo.txt", $texto);
    }
}
