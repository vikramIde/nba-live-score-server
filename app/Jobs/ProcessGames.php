<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Carbon\Carbon;

class ProcessGames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $game;
    protected $team1;
    protected $team2;
    protected $score;

    protected $modelObj;
    protected $fieldObj;
    protected $helperObj;
    public    $result;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game,$team1,$team2)
    {
        $this->game = $game;
        $this->team1 = $team1;
        $this->team2 = $team2;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Starting the Game for  ',['jobName'=>$this->game['id'],'timeStamp'=>date("Y-m-d h:i:sa")]);
        echo "The Match ".$this->game['id']." Started between ".$this->team1['name'].' V/S '.$this->team2['name'].'<br/>';

        try {
            $now = Carbon::now();
            $endTime = Carbon::now()->addSeconds(240);;
            echo ($now); 
            echo ($endTime);
                    
        } catch (Exception $e) {
            echo $e->getMessage(); 
        }


        // unset($this->modelObj, $this->fieldObj, $this->helperObj, $this->result);
        // $this->modelObj = new \App\Game();
        // $this->fieldObj['conditions'] = ['id' => $this->gameId, 'status' => 1];
        // $this->result = $this->modelObj->fetchMap($this->fieldObj);

        // if($this->result['flag'] == 1) {
        //     if(sizeof($this->result['data']) > 0) {
        //         foreach ($this->result['data'] as $game) {  
        //             $this->play($game['team1'],$game['team2']);
        //         }
        //     }
        // }
    }
}