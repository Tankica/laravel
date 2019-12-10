<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('checkRole:author');
        $this->middleware('auth');
    }

    public function dashboard(){

        $chart = new DashboardChart();
        $days = $this->genreteDAtaRange(Carbon::now()->subDays(30),Carbon::now());
        $posts = [];
        foreach ($days as $day){
            $posts[] = Post::whereDate('created_at',$day)->where('user_id',Auth::id())->count();
        }
        $chart->dataset('Posts','line',$posts);
        $chart->labels($days);


        $posts = DB::table('posts')->where('user_id', Auth::id())->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id', $posts)->get();

        $todayComments = $comments->where('created_at','>=',\Carbon\Carbon::today())->count();
        return view('author.dashboard',compact('comments','todayComments','chart'));
    }

    private function genreteDAtaRange(Carbon $start_date, Carbon $end_date){
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()){
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }
    public function posts(){
        return view('author.posts');
    }
    public function comments(){
        $post = Post::where('user_id',Auth::id())->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id',$post)->get();
        return view('author.comments',compact('comments'));
    }
    public function newPost(){
        return view('author.newPost');
    }
    public function createPost(CreatePost $request){
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        return back()->with('success','Post is successfully created.');
    }
    public function editPost($id){
        $post = Post::where('id',$id)->where('user_id',Auth::id())->first();
        return view('author.editPost',compact('post'));
    }
    public function postEditPost(CreatePost $request,$id){
        $post = Post::where('id',$id)->where('user_id',Auth::id())->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        return back()->with('success','Post is successfully changed.');
    }
    public function deletePost($id){
        $post = Post::where('id',$id)->where('user_id',Auth::id())->first()->delete();
        return back()->with('success','Post is successfully deleted.');
    }
}
