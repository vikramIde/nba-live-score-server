<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessGames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $gameId;
    protected $modelObj;
    public    $result;
    protected $fieldObj;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($gameId)
    {
        //
        $this->gameId = $gameId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Log::info('Starting the Game for  ',['jobName'=>$this->gameId,'timeStamp'=>date("Y-m-d h:i:sa")]);
        $this->modelObj = new \App\Game();
        $this->fieldObj['conditions'] = ['id'=>$this->gameId,'status'=>1];
        $this->result = $this->modelObj->fetchMap($this->fieldObj);
        if($this->result['flag'] == 1){
              if(sizeof($this->result['data']) > 0){
                foreach ($this->result['data'] as $game) {
                  $this->play($game['team1'],$game['team2']);
                }
              }
          }
    }
}
