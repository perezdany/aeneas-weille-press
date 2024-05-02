<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use DB;

use App\Models\Bhi;

class BhiController extends Controller
{
    //

    Public function AddBhi(Request $request)
    {
        $name = $request->title;
        $file = $request->bhi_file;

        $date = Date('Y-m-d');

        //dd($file);

        if($file == null)
        {
            $save = new Bhi(['name_file' => $name, 'date_added' => $date]);
            $save->save();
            
            return redirect()->route('bhi')->with('success', 'ok');
        }
        else{
               
            $file_name = $file->getClientOriginalName();

            $file_path = 'BHIS/'. $file_name;    

            $path = $request->file('bhi_file')->storeAs(
                'BHIS/', $file_name
            );

            $save = new Bhi(['name_file' => $name, 'file_path' =>  $file_path, 'date_added' => $date]);
            $save->save();

        }
      

        return redirect()->route('bhi')->with('success', 'ok');

    }

    public function displayAllBhi()
    {
        $get = Bhi::All();
        
        return $get;
    }

    public function GetTheLastestBhi()
    {
        $get = DB::table('bhis')
                ->latest('id')
                ->first(['bhis.*']);
                
        return $get;
    }

    public function SearchBhi(Request $request)
    {
         $get = DB::table('bhis')
                ->where('date_added', $request->date)
                ->latest('id')
                ->get()
                ->take(1);
        //dd($get);
        if($get->count() == 0)
        {
            //dd('yeay');
            return back()->with('error_search', 'No Element Found');

        }
        else
        {
            //dd('ok');
            foreach($get as $get)
            {

                return view('customers/dld_bhi', ['id' => $get->id, 'name_file' => $get->name_file, 'file_path' => $get->file_path, 'date_added' => $get->date_added]);
            }
        }
    }

    public function DeleteBhi(Request $request)
    {
         //SUPPRIMER LES DEUX VERSIONS DES FICHIERS 

        //recupérer le chemain d'accès
        $path_get = Bhi::where('id', $request->id)->first();
        //dd($path_get->path_file_en);

        //SUPPRIMER L'ANCIER FICHIER
        $fichier = storage_path().'/app/'.$path_get->file_path;

        $id =  $request->id;
        
        $deleted = DB::table('bhis')->where('id', '=', $id)->delete();

        return back()->with('success_del', 'Press review Deleted');  
    }

    public function FormEditBhi(Request $request)
    {
        return view('admins/edit_bhi_form', [
            'id' => $request->id_bhi,
            ]);
    }

    public function GetBhiById($id)
    {
        $get = Bhi::where('id', $id)->get();

        return $get;
    }

    public function EditBhi(Request $request)
    {
        if($request->bhi_file)
        {
           //dd('idi');
            //recupérer le chemain d'accès
            $path_get = Bhi::where('id', $request->id)->first();

            //SUPPRIMER L'ANCIER FICHIER
            $fichier = storage_path().'/app/'.$path_get->file_path;
            //dd($fichier);
            $var = File::delete($fichier);

            //Nouveau chemin du fichier a remlir dans la base
            $file_name_fr = $request->bhi_file->getClientOriginalName();
            $file_path1 = 'reviews/FR/'. $file_name_fr;
        
            $path = $request->file('file')->storeAs(
            'reviews/FR', $file_name_fr
            );

            //Mise a jour du nom
            $affected = DB::table('bhis')
              ->where('id', $request->id)
              ->update(['name_file' => $request->title]);
            
            $affectedpathF = DB::table('bhis')
              ->where('id', $request->id)
              ->update(['file_path' => $path]);
             // dd('yeah');
        }
        else
        {
            //Mise a jour du nom
            $affected = DB::table('bhis')
              ->where('id', $request->id)
              ->update(['name_file' => $request->title]);
        }
        //view('admins/bhi_manage')

        return view('admins/bhi_manage')->with('edit_success', 'success');
    }
}
