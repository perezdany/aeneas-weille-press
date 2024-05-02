<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use DB;
use App\Models\Presse;
use App\Models\Review;

class ReviewController extends Controller
{
    //Handle newspaper and press reviews

    public function AddNewspaper(Request $request)
    {
        $query = new Presse(['name_presse' => $request->name_newspaper, 'url_address' => $request->web]);
        $query->save();

        return redirect('press_review')->with('success', 'Success');
    }

    public function AddPressReview(Request $request)
    {
        //Créer une revue de presse et l'ajouter dans la base

        $le_nom = $request->title;
        $fr = $request->fr_file;
        $en = $request->en_file;
        //dd($fr);
        $date = date('Y-m-d');
        $heure = date('H:i:s');

        //on passe à la sauvegarde maintenant
        $save = new Review(['label' => $le_nom, 'date_added' => $date,  'hour_added' => $heure]);
        $save->save();
        //dd($image);

        //stocker l'image
        //Storage::disk('public')->put('articles', $image);


        //enregistrement des fichier dans la base

        if($fr)
        {
            $file_name_fr = $fr->getClientOriginalName();

            $file_path1 = 'reviews/FR/'. $file_name_fr;

            $path = $request->file('fr_file')->storeAs(
                'reviews/FR', $file_name_fr
            );

            $id = Review::where('label', $le_nom)->first();

            //MODIFICATION DE L'ENREGISTREMENT OU AJOUT DU CHEMIN D'ACCES
            $addpathFR = DB::table('reviews')
              ->where('id', $id->id)
              ->update(['path_file_fr' =>  $file_path1]);

        }

        if($en)
        {
            $file_name_en = $en->getClientOriginalName();

       
            $file_path2 = 'reviews/EN/'. $file_name_en;
                    
          

            $path2 = $request->file('en_file')->storeAs(
                'reviews/EN', $file_name_en
            );

            $id = Review::where('label', $le_nom)->first();

            //MODIFICATION DE L'ENREGISTREMENT OU AJOUT DU CHEMIN D'ACCES
            $addpathEN = DB::table('reviews')
              ->where('id', $id->id)
              ->update(['path_file_en' =>  $file_path2]);

        }

       
        return redirect('press_review')->with('success', 'Registering Succed!');


    }

    public function displayAllReviews()
    {
        $get = Review::all();

        return $get;
    }

    public function displayAllNewsPaper()
    {
        $get = Presse::all();

        return $get;
    }

    public function EditFormPr(Request $request) {
          
        return view('admins/edit_review_form', [
            'id' => $request->id_press_review,
            ]);
        
    }

    public function SelectById($id)
    {
        $get = Review::where('id', $id)->get();

        return $get;
    }

    public function EditReview(Request $request)
    {
     
       
        //$file_name_fr = $request->fr_file->getClientOriginalName()
        //$file_name_en = $request->en_file->getClientOriginalName();  
        //dd($request->en_file);

        if($request->fr_file)
        {
           //dd('idi');
            //recupérer le chemain d'accès
            $path_get = Review::where('id', $request->id)->first();

            //SUPPRIMER L'ANCIER FICHIER
            $fichier = storage_path().'/app/'.$path_get->path_file_fr;
            //dd($fichier);
            $var = File::delete($fichier);

            //Nouveau chemin du fichier a remlir dans la base
            $file_name_fr = $request->fr_file->getClientOriginalName();
            $file_path1 = 'reviews/FR/'. $file_name_fr;
        
            $path = $request->file('fr_file')->storeAs(
            'reviews/FR', $file_name_fr
            );
             //Mise a jour du nom
            $affected = DB::table('reviews')
              ->where('id', $request->id)
              ->update(['label' => $request->title]);
            
            $affectedpathF = DB::table('reviews')
              ->where('id', $request->id)
              ->update(['path_file_fr' => $path]);
             // dd('yeah');
        }

        if($request->en_file)
        {
            //dd('idi');
            //recupérer le chemain d'accès
            $path_get = Review::where('id', $request->id)->first();

            //SUPPRIMER L'ANCIER FICHIER
            $fichier = storage_path().'/app/'.$path_get->path_file_en;

            $var = File::delete($fichier);

            //Nouveau chemin du fichier a remlir dans la base
            $file_name_en = $request->en_file->getClientOriginalName();
            $file_path2 = 'reviews/EN/'. $file_name_en;

            $path2 = $request->file('en_file')->storeAs(
                'reviews/EN', $file_name_en
            );
             //Mise a jour du nom
            $affected = DB::table('reviews')
              ->where('id', $request->id)
              ->update(['label' => $request->title]);

            $affectedpathE = DB::table('reviews')
              ->where('id', $request->id)
              ->update(['path_file_en' => $path2]);
        }

        return redirect('press_review')->with('success', 'Updating Succed');
    }

    public function DeletReview(Request $request)
    {
        //SUPPRIMER LES DEUX VERSIONS DES FICHIERS 

        //recupérer le chemain d'accès
        $path_get = Review::where('id', $request->id)->first();
        //dd($path_get->path_file_en);

        //SUPPRIMER L'ANCIER FICHIER
        $fichier = storage_path().'/app/'.$path_get->path_file_en;

        $var = File::delete($fichier);

        //recupérer le chemain d'accès
        $path_get = Review::where('id', $request->id)->first();

        //SUPPRIMER L'ANCIER FICHIER
        $fichier = storage_path().'/app/'.$path_get->path_file_fr;
        //dd($fichier);
        $var = File::delete($fichier);

        $id =  $request->id;
        
        $deleted = DB::table('reviews')->where('id', '=', $id)->delete();



        return redirect('press_review')->with('success', 'Press review Deleted');  
    }
   

    public function GetTheLastReview()
    {
        $get = DB::table('reviews')
                ->latest('id')
                ->first(['reviews.*']);
                
        return $get;
                
    }

    public function SerachReview(Request $request)
    {
        $get = DB::table('reviews')
                ->where('date_added', $request->date)
                ->latest('id')
                ->get()
                ->take(1);
        //dd($get);
        if($get->count() == 0)
        {
            //dd('yeay');
            return redirect('customer_welcome')->with('error_search', 'No Element Found');

        }
        else
        {
            foreach($get as $get)
            {

                return view('customers/customer_welcome', ['id' => $get->id, 'path_en' => $get->path_file_en, 'path_fr' => $get->path_file_fr, 'date_added' => $get->date_added]);
            }
        }
        
        
    }

    public function AdminSerachReview(Request $request)
    {
        $get = DB::table('reviews')
                ->where('id', $request->review)
                ->latest('id')
                ->get()
                ->take(1);
        //dd($get);
        if($get->count() == 0)
        {
            //dd('yeay');
            return redirect('articles_view')->with('error', 'No Element Found');

        }
        else
        {
            foreach($get as $get)
            {

                return view('admins/articles_view', ['id' => $get->id, 'path_en' => $get->path_file_en, 'path_fr' => $get->path_file_fr]);
            }
        }
        
        
    }
}
