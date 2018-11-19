<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Carbon\Carbon;
use App\Player;
use App\Rule;
use App\Score;
use App\Game;

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
        Log::info('Starting the Game for  ',['jobName'=>$this->game['id'], 'timeStamp'=>date("Y-m-d h:i:sa")]);
        Log::info('Game details' , [ 'Game'=>$this->game['id'], 'Team1' => $this->team1['id'], 'Team2' => $this->team2['id'] ]);
        echo "The Match ".$this->game['id']." Started between ".$this->team1['name'].' V/S '.$this->team2['name'].'<br/>';

        try {

            $players = self::getPlayersId();
            $rules = self::getAllRules();

            $endInterval = 48;
             self::updateGameStatus($this->game['id'], 'live');
            for ($interval = 1; $interval <= $endInterval; $interval++) {
                $keyPlayer = array_rand($players);
                $keyRule = array_rand($rules);
                self::updateScoreTable($this->game['id'], $players[$keyPlayer], $rules[$keyRule]); 
                Log::info(Carbon::now());
                Log::info($interval);
                sleep(1);
                //flush();
            }

            self::updateGameStatus($this->game['id'], 'finished');
   
        } catch (Exception $e) {
            Log::info('Error in ProcessGames:: ',['Job Error'=>$e->getMessage(),'timeStamp'=>date("Y-m-d h:i:sa")]);
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
    //self
    public function getPlayersId() {
        $result = [];
        $players = Player::select('id')->where('team_id' , $this->team1['id'])->orWhere('team_id' , $this->team2['id'])->get();
        foreach ($players as $key => $value) {
            $result[] = $value['id'];
        }
        return $result;
    }    
    public function getAllRules() {
        $result = [];
        $rules = Rule::select('id')->get();
        foreach ($rules as $key => $value) {
            $result[] = $value['id'];
        }
        return $result;
    }

    public function updateScoreTable($gameId, $playerId, $rulesId) {

        try {
            Log::info("Game id ".$gameId." Player ".$playerId." Rule ".$rulesId);
            $scoreTable = new Score;
            $scoreTable->games_id = $gameId;
            $scoreTable->players_id = $playerId
            $scoreTable->rules_id = $rulesId;
            $scoreTable->save();
            Log::info("Score Saved in the Table ".$scoreTable);
        } catch (Exception $e) {
            Log::info("Error occured in storing score table ".$e->getMessage());
        }
    }

    public function updateGameStatus($gameId , $status) {

        try {
            Log::info("Game id ".$gameId." Statua ".$status);

            switch ($status) {
                case 'live':
                    $statusValue = 2;
                    $results1 = 0;
                    $results2 = 0;
                    break;
                case 'finished':
                    $statusValue = 3;
                    $results1 = 0; //write queery to calculate the result
                    $results2 = 0; //write queery to calculate the result
                    break;
                case 'prepare':
                    $statusValue = 1;
                    $results1 = 0;
                    $results2 = 0;
                    break;
                default:
                    $statusValue = 0;
                    $results1 = 0;
                    $results2 = 0;
                    break;
            }

            $gameTable = Game::findOrFail($gameId);
            $gameTable->status = $statusValue
            $gameTable->results1 = 0;
            $gameTable->results2 = 0;
            $gameTable->attack_count = $rulesId;
            $x = DB::table('scores')->select('DB::raw(count(scores.id))')->leftJoin('players','scores.players_id','=','players.id')
            ->leftJoin('teams','players.team_id','=','teams.id')->where('scores.rule_id','=',6)->groupBy('players.team_id');
            dd($x);
            /*  attack_count = select count(id) from scores where rule_id == 6 group by team_id  */
            $gameTable->save();

            Log::info("Game table Updated ".$gameTable);
        } catch (Exception $e) {
            Log::info("Error occured in updating game table ".$e->getMessage());
        }
    }
}