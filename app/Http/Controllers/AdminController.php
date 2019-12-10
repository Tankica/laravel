<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\userUpdate;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $chart = new DashboardChart();
        $days = $this->genreteDAtaRange(Carbon::now()->subDays(30), Carbon::now());
        $comments = [];
        foreach ($days as $day) {
            $comments[] = Comment::whereDate('created_at', $day)->count();
        }
        $chart->dataset('Comments', 'line', $comments);
        $chart->labels($days);
        return view('admin.dashboard', compact('chart'));
    }

    private function genreteDAtaRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editPost($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.editPost', compact('post'));
    }

    public function postEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        return back()->with('success', 'Post is successfully changed.');
    }

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->first()->delete();
        return back()->with('success', 'Post is successfully deleted.');
    }

    public function commentDelete($id)
    {
        $comment = Comment::where('id', $id)->first()->delete();
        return back()->with('success', 'Comment is successfully deleted.');

    }

    public function usersDelete($id)
    {
        $user = User::where('id', $id)->first()->delete();
        return back()->with('success', 'Post is successfully deleted.');
    }

    public function editUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.editUser', compact('user'));
    }

    public function userEditUser(userUpdate $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request['author'] == 1) {
            $user->author = true;
        } else if ($request['admin'] == 1) {
            $user->admin = true;
        }
        $user->save();
        return back()->with('success', 'User is successfully updated.');

    }


}
