<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Storage;

class StdNoteController extends Controller
{
    public function StdViewNote(){

        // $notes=Note::all();
          return view('student.view_note');
        
    }//end of method

    public function StdCreateForm(){

        return view('student.file_upload');
      }//end of method

      public function StdFileUpload(Request $req){
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
            return redirect()->route('studentNote')
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
   }//end of method

   public function StdDownload($id)
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
                
                 
                
            }//end of method

}
