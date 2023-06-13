<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//
Route::get('/', function () {
    $articles = Article::latest()->paginate(5);
    return view('welcome',compact('articles'));
});
//Route for viewing an article with comments
Route::get('/view/{id}',function($id){
   $article = Article::findOrFail($id);
   //$comments = Comment::where('comment_for',$id)->get();
   $comments = DB::table('comments')->where('comment_for',$id)->join('users','users.id','=','comments.comment_by')->get();
   return view('view_article',compact('article','comments'));
})->name('viewArticle')->middleware('auth');

//route for adding a comment for an article
Route::post('/view/{id}',function(Request $req,$id){

    $req->validate([
         'comment_desc'=>['required|max:255']
    ]);

    $comment = new Comment();
    $comment->comment_for = $id; 
    $comment->comment_by = Auth::id();
    $comment->comment_desc = $req->comment;
    $comment->save();
   return redirect()->back()->with('message','Comment added successfully');
});



//Route for accessing the edit-profile page
Route::get('/profile',[ProfileController::class,'edit'])->name('edit-profile');

//Route to save the changes to  db
Route::put('/profile',[ProfileController::class,'update'])->name('update-profile');

//custom function call by auth middleware
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Routes for logins with the specific middlewares attached
Route::get('/admin',function(){
   return view('admin.dashboard');
})->name('admin')->middleware('admin');

Route::get('author',function(){
    return view('articles.dashboard');
})->name('author')->middleware('author');

Route::get('posts',function(){
    return view('posts');
})->name('posts')->middleware('subscriber');



//Applying the author middleware to all the author routes
    Route::resources([
        '/articles'=>ArticleController::class,
        '/admin/users'=>UserController::class
    ]);



