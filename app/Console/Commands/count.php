<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Controllers\PostController;
use \Exception;

class count extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:count {id}'; //'app:...

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда должна возвращать количество статей привязанных
    к тегу с идентификатором {id}. Если тега с данным {id} не существует, то
    необходимо выбросить соответствующее исключение.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try{
            $id = $this->argument('id');
            $tag = Tag::where('id', $id)->first();
            if ($tag == null){
                throw new Exception('Нет тега для заданного id');
            }
            $pst_ctrl = new PostController();
            $count = count($pst_ctrl->get_nums($tag->post_id));
            
            $this->info("Count = {$count}");
        }
        catch(Exception $e){
            $this->error($e->getMessage());
        }
    }
}
