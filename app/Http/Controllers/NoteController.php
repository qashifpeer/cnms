<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Response;
use  Illuminate\Support\Facades\File;

class NoteController extends Controller
{
    private $notes;
    
    
    public function createForm(){

        return view('admin.file_upload');
      }
      public function fileUpload(Request $req){
            $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
            $fileModel = new Note();
            if($req->file()) {
                $fileName = time().'_'.$req->file->getClientOriginalName();
                //$filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
                $filePath = Storage::putFileAs('uploads', $req->file('file'), $fileName);
                $fileModel->name = time().'_'.$req->file->getClientOriginalName();
                $fileModel->path = '/storage/' . $filePath;
                $fileModel->user_type = $req->user_type;
                $fileModel->user_id = $req->user_id;
                $fileModel->description = $req->description;
                //$fileModel->user_name = $req->user_name;

                $fileModel->save();
                return redirect()->route('myNote')
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
            }
       }//end of method
            public function ViewNote(){

                // $notes=Note::all();
                  return view('admin.view_note');
                
            }//end of method


            public function Download($id)
            {
              
                 $note=Note::find($id);
                 $path=$note->path;
               
                 $file = public_path().$path;
                 $fileName=$note->name;
                 $headers = ['Content-Type: application/pdf'];
                if(file_exists($file)) {
                    return response()->download($file, $fileName, $headers);

                }else {
                    echo('File not found.');
                }
                
                 //dd( $fileName);
               // echo mime_content_type($path);
                //exit();
            
                     
                     
                      //return Storage::download($path,$fileName, $headers);
                
            }//end of method

            // public function removeFile($id)
            // {
            //     $note=Note::find($id);
            //     $path=$note->path;
              
            //     $file = public_path().$path;
            //     return response()->delete($file);
               
            //     // if($file::exists(public_path($path))){
            //     //     $file::delete(public_path($path));
            //     // }else{
            //     //     dd('File does not exists.');
            //     // }
            // }//end of method
 }