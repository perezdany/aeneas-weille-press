<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class FileManager extends Controller
{
    //Download File Managing

    public function DownloadFile(Request $request)
    {
        //return Storage::download($request->file);
        /*$path = Storage::url($request->file);
        $content = Storage::get($path);
        dd($content);*/
        //dd(Storage::disk('public')->exists($request->file) );
        //dd($request->file);
        if(Storage::disk('local')->exists($request->file))
        {
            return Storage::download($request->file);
        }
        else
        {
            return redirect('customer_welcome')->with('error', 'File does not exist');
        }

        /*if(Storage::disk('public')->exists($request->file))
        {
            $path = Storage::disk('public')->path($request->file);
            //dd($path);
            //$use_include_path = false;
            $content = file_get_contents($path);
            return response()->file($path);
            /*return response($path)->withHeaders([
                'Content-Type' => mime_content_type($path)

            ]);
            //dd($content);
            //return Storage::download($content);
        }
        else
        {
            return redirect('customer_welcome')->with('error', 'File does not exist');
        }*/
    }

    public function BhiDownload(Request $request)
    {
         //return Storage::download($request->file);
        /*$path = Storage::url($request->file);
        $content = Storage::get($path);
        dd($content);*/
        //dd(Storage::disk('public')->exists($request->file) );
        //dd($request->file);
        //dd('ici');
        if(Storage::disk('local')->exists($request->file))
        {
            return Storage::download($request->file);
        }
        else
        {
            return back()->with('error', 'File does not exist');
        }

    }
}
