<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        DB::transaction(function () use ($request) {
            $comment = Comment::where('article_id',$request->input('article_id'))->sharedLock()->orderBy('floor','desc')->first();
            $lastFloor = 0;
            if($comment){
                $lastFloor = $comment->floor;
            }
            $floor = ['floor'=>$lastFloor+1];
            $data = array_merge($floor,$request->all());
            return Comment::create($data);
        });
    }


    public function index($article_id,Request $request)
    {
        $order = $request->input('order');
        return CommentCollection::collection(
            Comment::where('article_id',$article_id)->orderBy('created_at',$order)->get()
        );

    }
}
