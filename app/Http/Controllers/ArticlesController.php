<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class ArticlesController extends Controller
{
    public function articleLists() {
        $articles = Article::where('public', '1')->get();

        return view('articles.articles', compact('articles'));
    }

    public function articleRead(Article $article) {
        $style_unauth = "";
        $style_auth = "display: none;";

        if(isset(auth()->user()->id)) {
            $style_unauth = "display: none;";
            $style_auth = "";
        }

        $latest_article = Article::where('public', '1')->limit(5)->orderByDesc('created_at')->get();

        return view('articles.article', compact('style_unauth', 'style_auth', 'article', 'latest_article'));
    }

    public function index()
    {
        $count = Article::count();

        $articles = Article::select('articles.*')
                            ->paginate(5);
        $articles = $articles->all();

        return view('librarian.data-article', compact('count', 'articles'));
    }

    
    public function create()
    {
        return view('articles.create-article');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'editor' => 'required',
            'synopsis' => 'required',
            'file' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $file = $request->file('file');

        if($file) $image = $file->getClientOriginalName();
        else $image = "article-default.jpg";

        $is_public = '1';

        if($request->is_private) {
            $is_public = '0';
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->editor,
            'synopsis' => $request->synopsis,
            'written_by' => auth()->user()->name,
            'image' => $image,
            'public' => $is_public,
        ]);

        if($image != 'article-default.jpg') {
            Article::where('id', $article->id)
                ->update([
                    'image' => $article->id.'/'.$image,
                    ]);
        }

        if($file) $file->move(public_path('uploaded_files/article-image/'.$article->id.'/'),$file->getClientOriginalName());

        return redirect('/article-management')->with('success', 'Data berhasil ditambah');
    }   
    public function edit(Article $article)
    {
        return view('articles.edit-article', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'editor' => 'required',
            'synopsis' => 'required',
            'file' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $file = $request->file('file');

        if($file) $image = $article->id.'/'.$file->getClientOriginalName();
        else $image = $article->image;

        $is_public = $article->public;

        if($request->is_private) {
            $is_public = '0';
        } else {
            $is_public = '1';
        }

        $new_article = Article::where('id', $article->id)
                        ->update([
                            'title' => $request->title,
                            'content' => $request->editor,
                            'synopsis' => $request->synopsis,
                            'image' => $image,
                            'public' => $is_public,
                        ]);

        if($file) {
            if($article->image != "article-default.jpg") File::delete(public_path('uploaded_files/article-image/'.$article->image));
            $file->move(public_path('uploaded_files/article-image/'.$article->id.'/'),$file->getClientOriginalName());
        }

        return redirect('/article-management')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        if($article->image != "article-default.jpg") {
            File::deleteDirectory(public_path('uploaded_files/article-image/'.$article->id));
        }

        return redirect('/article-management')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request) {
        $keyword = '%'.$request->search.'%';

        $articles = Article::where('public', '1')
                            ->where('title', 'like', $keyword)
                            ->get();

        return view('articles.articles', compact('articles'));
    }

    public function searchFromLibrarian(Request $request) {
        $keyword = '%'.$request->search.'%';

        $articles = Article::where('title', 'like', $keyword)
                            ->get();

        $count = Article::where('title', 'like', $keyword)
                        ->count();

        return view('librarian.data-article', compact('count', 'articles'));
    }
}
