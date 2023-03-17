<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function get_nums($string) : array
    {
        $string = substr($string, 1, strlen($string)-2);
        $array = explode(", ", $string);

        return $array;
    }
    
    public function index(Request $request, $page=1){

        $title_req = $request->input('title');
        $code_req = $request->input('code');
        $tag_req = $request->input('tag');
        

        $paginate = 10;

        $skip = ($page*$paginate) - $paginate;

        $prev_url = $next_url = '';

        if ($skip > 0){
            $prev_url = $page - 1;
        }

        $posts = Post::query();

        
        if (($title_req!= null)){
            $posts = $posts->where('title', $title_req);
        }
        if (($code_req!= null)){
            $posts = $posts->where('code', $code_req);
        }
        if (($tag_req!= null)){
            $posts_ids = $posts->get()->pluck('id');

            $tag = Tag::whereIn('id', $posts_ids)->where('name', $tag_req)->first();

            $nums = $this->get_nums($tag->post_id);

            $posts = $posts->whereIn('id', $nums);
        }
        

        $posts = $posts->skip($skip)->take($paginate)->get();

        if ($posts->count() > 0){
            if($posts->count() >= $paginate){
                $next_url = $page + 1;
            }

            return view('post', compact('posts','prev_url', 'next_url'));
        }
        
        abort('404'); //Если пусто, то прихлопнуть приложение с 404ой ошибкой.
    }

    public function code(Request $request, $code){
        $posts = Post::where('code', $code);
        $post_id = $posts->first()->id;

        $tags = Tag::all();

        $selected_tags = [];

        foreach ($tags as $tag) {
            $taglist = $this->get_nums($tag);
            foreach($taglist as $taglist_elem){
                if((int) $taglist_elem == $post_id){
                    $selected_tags[] = $tag->name;
                }
            }
        }

        natsort($selected_tags);

        echo("Тэги: <br/>");

        print_r($selected_tags);

        if ($posts->count() > 0){
            $posts_get = Post::where('code', $code)->get();

            return view('posts', ['posts'=>$posts_get]);
        }
        
        abort('404'); //Если пусто, то прихлопнуть приложение с 404ой ошибкой.
    }

    function show(){
        $data = Post::all();
        return view('post', ['posts'=>$data]);
    }
}
