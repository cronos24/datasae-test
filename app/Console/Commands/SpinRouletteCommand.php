<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RuletaController;
use Illuminate\Http\Request;
use App\Http\Controllers\ApuestasController;

class SpinRouletteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spin:roulette';
    protected $RuletaController;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear cada 3 minutos un nuevo giro de ruleta';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RuletaController $RuletaController, ApuestasController $ApuestasController)
    {
        $this->RuletaController = $RuletaController;
        $this->ApuestasController = $ApuestasController;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller_ruleta = $this->RuletaController;
        $controller_apuesta = $this->ApuestasController;
        $model = new Request();
        $model->setMethod('POST');
        $model->request->add(['fecha'=>date('Y-m-d H:i:s'),'estado'=>'A']);
        
        $save_ruleta = $controller_ruleta->store($model);

        if ($save_ruleta['status']=="success") {
            
            $model_apuesta = new Request();
            $model_apuesta->setMethod('POST');
            $model_apuesta->request->add(['ruleta_id'=>$save_ruleta['response']->id,'estado'=>'A']);
            $save_apuesta = $controller_apuesta->store($model_apuesta);

            dd($save_apuesta);
         } 

        
        //return 0;
    }
}
