<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Notifications\MemberNews;
use App\User;
use Auth;
use Storage;
use Notification;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function createNews(Request $request)
    // {
    //     $user = Auth::guard('admin')->user();

    //     $request ->validate([
    //         'image' => 'required',
    //         'p1_heading' => 'required',
    //         'p1_main' => 'required',
    //     ]);

    //     $image = $request->file('image');
    //     // $disk = Storage::disk('local');
    //     // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる

    //     $news = new News();
    //     $news->admin_id = $user->id;

    //     if(!$image){
    //         $news->image = null;
    //     }else{
    //         $disk = Storage::disk('s3');

    //         $path = $disk->putFile('news', $image, 'public');
    //         // $filename = ltrim($path, 'public/');

    //         $news->image = $path;
    //     }

    //     $news->p1_heading = request('p1_heading');
    //     $news->p1_main = request('p1_main');
    //     $news->p2_heading = request('p2_heading');
    //     $news->p2_main = request('p2_main');
    //     $p2_link = request('p2_link');
    //     $news->p2_link = 'https://ayaandco.com/products/'.$p2_link;
    //     $news->p3_heading = request('p3_heading');
    //     $news->p3_main = request('p3_main');
    //     $p3_link = request('p3_link');
    //     $news->p3_link = 'https://ayaandco.com/products/'.$p3_link;
    //     $news->p4_heading = request('p4_heading');
    //     $news->p4_main = request('p4_main');
    //     $p4_link = request('p4_link');
    //     $news->p4_link = 'https://ayaandco.com/products/'.$p4_link;
       
    //     $news -> save();

    // }

    public function createNews(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $request ->validate([
            'subject' => 'required',
            'image' => 'required',
            'p1_heading' => 'required',
            'p1_main' => 'required',
            'p1_menu' => 'required'
        ]);

        $news = new News();

        $news->admin_id = $user->id;
        $news->subject = request('subject');
        $news->image = request('image');
        $news->p1_heading = request('p1_heading');
        $news->p1_main = request('p1_main');
        $news->p1_menu = request('p1_menu');
        $news->p2_heading = request('p2_heading');
        $news->p2_main = request('p2_main');

        $p2_link = request('p2_link');
        
        if(!empty($p2_link)){
            $news->p2_link = 'https://ayaandco.com/'.$p2_link;
            $news->p2_btntext = request('p2_btntext');
        }else{
            $news->p2_link = null;
            $news->p2_btntext = null;
        }
        
        $news->p3_heading = request('p3_heading');
        $news->p3_main = request('p3_main');

        $p3_link = request('p3_link');

        if(!empty($p3_link)){
            $news->p3_link = 'https://ayaandco.com/'.$p3_link;
            $news->p3_btntext = request('p3_btntext');
        }else{
            $news->p3_link = null;
            $news->p3_btntext = null;
        }
        
        $news->p4_heading = request('p4_heading');
        $news->p4_main = request('p4_main');
        $p4_link = request('p4_link');

        if(!empty($p4_link)){
            $news->p4_link = 'https://ayaandco.com/'.$p4_link;
            $news->p4_btntext = request('p4_btntext');
        }else{
            $news->p4_link = null;
            $news->p4_btntext = null;
        }

        $news->p5_heading = request('p5_heading');
        $news->p5_main = request('p5_main');
        $p5_link = request('p5_link');

        if(!empty($p5_link)){
            $news->p5_link = 'https://ayaandco.com/'.$p5_link;
            $news->p5_btntext = request('p5_btntext');
        }else{
            $news->p5_link = null;
            $news->p5_btntext = null;
        }

        $news -> save();

        return response() -> json(['news' => $news]);

    }

    public function sendNews(Request $request)
    {
        $request ->validate([
            'news' => 'required',
        ]);

        $news = request('news');
        // DD($news);

        $users = User::where('id', [1, 2])
                    ->where('unsubscribe', 0)
                    ->get();

        // $users = User::where('unsubscribe', 0)->get();


        Notification::send($users, new MemberNews($users, $news));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
