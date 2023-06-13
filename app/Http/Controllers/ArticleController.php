<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{

    public function __construct(){
        //protect all routes from unwanted access
        $this->middleware(['auth','author']);
    }    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get currently logged in author id
        $author = auth()->id();
        $articles = Article::where('created_by',$author)->latest()->paginate(6);
        return view("articles.index",compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //go to the form thet creates the article
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
         //validates the records from the input fields in the ArticleRequest file
        //$request->validated();
        //insert a new record
        $articleData = $request->uploadFile();
        Article::create($articleData);
        return redirect()->route("articles.index")->with('message','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //get article by id
        // $article = Article::findorFail($id);
        $comments = DB::table('comments')->where('comment_for',$article->id)->join('users','users.id','=','comments.comment_by')->get();
        return view("articles.show",compact("article","comments"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        return view("articles.edit",compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        
        //validates the records from the input fields in the ArticleRequest file
        $request->validated();
        $article->update($request->all());
        return redirect()->route("articles.index")->with('message','Article Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
       //$filename =
       $filename =  $article->image;
       $image_path = public_path('upload/').$filename;

        //find the image where it is located and delete it
        if(File::exists($image_path)){
             File::delete($image_path);
        }
        $article->delete();
        return redirect()->route("articles.index")->with('message','Article Deleted successfully');
    }
}
