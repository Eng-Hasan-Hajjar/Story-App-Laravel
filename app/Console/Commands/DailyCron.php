<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Story;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DailyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Daily:Cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Stories Where Created > 24 Hour';

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
     * @return mixed
     */
    public function handle()
    {
        //
        
        $Date=Carbon::now()->subDays();
        //$this->alert($Date);
        //Get All Stories Where Created_At < 24 Hour
        $getSories=Story::where([['created_at','<',$Date],['created_at','!=',Carbon::today()]])->get();
        //$this->alert($getSories->count());
        foreach($getSories as $StoryF){
        
           //get File From DB
           $getFile=File::find($StoryF['FileId']); 
          
           //get File From Storage 
           $test=Storage::delete('/public'.'/'.$getFile['FileBaseName']);

           //Delete File From Storage And From DB
           $getFile->delete();


           //Delete Story From DB 
           $getStory=Story::find($StoryF['id']);
           $getStory->delete();

          $this->alert('Done');
        }
   





    }
}
