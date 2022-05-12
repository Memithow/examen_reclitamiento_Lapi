<?php

namespace App\Console\Commands;

use App\Models\MensajesAutomaticos as MensajesAutomaticosModel;
use App\Models\TareasProgramadas as TareasProgramadasModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TareasProgramadas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:task';

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
        date_default_timezone_set('America/Mexico_City');
        $mensajes_programados = TareasProgramadasModel::where('hora', date('H:i'))->get();

        if($mensajes_programados){
            foreach ($mensajes_programados as $mensaje_programado){
                $mensaje_automatico = new MensajesAutomaticosModel();
                $mensaje_automatico->mensaje = $mensaje_programado->mensaje;
                $mensaje_automatico->save();

                $texto = '[ '.date('Y-m-d H:i:s').' ] : Mensaje Programado: '.$mensaje_automatico->mensaje;

                Storage::append("archivo.txt", $texto);
            }
        }
    }
}
