<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

use DB;

class ArticleController extends Controller
{
    //Handle Articles

    public function AddArcticle(Request $request)
    {
        $english_title = $request->en_title;
        $french_title = $request->fr_title;
        $presse = $request->press;
        $review = $request->rv;
        $url = $request->url;

        $save = new Article(['title_en' => $english_title, 'title_fr' => $french_title,  'id_presse' => $presse, 'link' => $url, 'id' => $review]);
        $save->save();
        //$message = __('message.suucess_save');

        return redirect('welcome')->with('success', 'success');
    }

    public function DisplayWithIdPresse($id)
    {
        //dd($id);
        //= Articles::where('id', $id)->get();
         $query = DB::table('articles')->join('presses', 'presses.id_presse', '=', 'articles.id_presse')
         ->join('reviews', 'reviews.id', '=', 'articles.id')
         ->where('articles.id', $id)
        ->get(['articles.title_en', 'articles.title_fr', 'articles.id_presse', 'articles.id', 'articles.link', 'articles.id_articles', 'presses.name_presse', 'reviews.*']);

        return $query;

    }

    public function DetailsView(Request $request)
    {
        //dd($request->id);
        return view('admins/articles', [
        'id' => $request->id,
        ]);

    }


    public function EditArticleForm(Request $request)
    {
        return view('admins/edit_article_form', [
            'id' => $request->id_article,
            ]);
    }

    public function GetArticleById($id)
    {
         $query = DB::table('articles')->join('presses', 'presses.id_presse', '=', 'articles.id_presse')
         ->join('reviews', 'reviews.id', '=', 'articles.id')
         ->where('id_articles', $id)
         ->get(['articles.title_en', 'articles.title_fr', 'articles.id_presse', 'articles.id', 'articles.link', 'articles.id_articles', 'presses.name_presse', 'reviews.label', 'reviews.id', 'articles.id_presse']);
         return $query;
    }

    public function EditArticle(Request $request)
    {
        $english_title = $request->en_title;
        $french_title = $request->fr_title;
        $presse = $request->press;
        $review = $request->rv;
        $url = $request->url;

        //dd($request->id_article);
         //modifier les éléments de la table
        if($english_title != null)
        {
            //var_dump("ici");
            $update_sans_fr = DB::table('articles')
                ->where('id_articles', $request->id_article)
                ->update(['title_en' => $english_title]); 
                
        }
        

        if($french_title != null)
        {
             $update_sans_en = DB::table('articles')
                ->where('id_articles', $request->id_article)
                ->update(['title_fr' => $french_title]);
                //dd($update_sans_en);
        }

        $update = DB::table('articles')
                ->where('id_articles', $request->id_article)
                ->update(['id_presse' => $presse, 'link' => $url, 'id' => $review]);
        //dd($update);

        /*$save = new Article(['title_en' => $english_title, 'title_fr' => $french_title,  'id_presse' => $presse, 'link' => $url, 'id' => $review]);
        $save->save();*/

        return redirect('press_review')->with('success', 'Succed');
    }

    public function DeleteArticle(Request $request)
    {
        $id =  $request->id_article;
        
        $deleted = DB::table('articles')->where('id_articles', '=', $id)->delete();

        return redirect('press_review')->with('success', 'Aticle Deleted');  
    }

    public function DisplayAllArticles()
    {
         $query = DB::table('articles')->join('presses', 'presses.id_presse', '=', 'articles.id_presse')
         ->join('reviews', 'reviews.id', '=', 'articles.id')
         ->get(['articles.title_en', 'articles.title_fr', 'articles.id_presse', 'articles.id', 'articles.link', 'articles.id_articles', 'presses.name_presse', 'reviews.*', 'articles.id_presse']);
         return $query;
    }
}
