<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;
use App\File;
use App\Story;

class CpanelController extends Controller
{
    //

    public function LoginGet()
    {
        if (!empty(Auth::guard('Author')->user())) {
            //
             return redirect()->route('CpanelGet');

        }
        //
        return View('Cpanel.Login');
    }

    public function LoginPost(Request $request)
    {
        //
        //validate Inputs 
        $validate=$request->validate([
            'UserNameI'=>'required',
            'PasswordI'=>'required'
        ]);

        //Check Author
        if(Auth::guard("Author")->attempt(
            array(
            'UserName'=>$validate['UserNameI'],
            'password'=>$validate['PasswordI']
            )
        )){
          return redirect()->route('CpanelGet');
          }
          else{
              return redirect()->route("CpanelLoginGet")
              ->With('err',['err'=>'0','message'=>'Wrong UserName Or Password']);
          }

    }

    public function CpanelGet()
    {
        
        //Get Stories
        $getStories=Story::all();
        $getStories->load('File');
        $getStories->load('Author');

        //Count Stories
        $CountStories=Story::count();
        
        
        return View('Cpanel.Main',['Stories'=>$getStories,'Count'=>$CountStories]);


    }

    public function CpanelLogout()
    {
        //
        Auth::guard('Author')->logout();
    }

    public function SaveStatus(Request $request)
    {
        //
    
        //Check File Input
       if($request->hasFile("FileI")){

        //get Orgenal FIle Name 
        $OFilename=$request->file('FileI')->getClientOriginalName();
        $dir='/public';
        
       //Upload File To Public Folder 
       $File=$request->file("FileI");
               
       //get Uploaded File Info (Type,Name,Ext,BaseName)
       $OName=$File->getClientOriginalName();
       $fileName=pathinfo($OName, PATHINFO_FILENAME);
       $fileExt=$request->file("FileI")->getClientOriginalExtension();
     
       $fileToStore='file'.time().'.'.$fileExt;
       $UploadPath=$request->file("FileI")->StoreAs($dir,$fileToStore);
        //$filename=Storage::put($dir,$request->file("FileI"),file_get_contents($request->file('FileI')));

        //get Uploaded File BaseName 
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::listContents($dir, $recursive));
        
        $file = $contents
            ->where('type', '=', 'file')
            ->where('basename', '=', $fileToStore)
            ->where('extension', '=', $fileExt)
            ->first(); // there can be duplicate file names! 

        //get Author
        $Author=Auth::guard('Author')->user();
        
        //Save Uploaded File			
        $SaveFile=new File([
            'FileName'=>$fileName,
            'FileBaseName'=>$fileToStore,
            'FileExt'=>$fileExt,
        ]);
        $SaveFile->save();
        

        //Save Status 
        $SaveStory=new Story([
            'FileId'=>$SaveFile['id'],
            'AuthorId'=>$Author['id'],
            'StoryValue'=>$request->input('StoryValueI'),
            'ViewNum'=>0
        ]);
        $SaveStory->save();

        return 'Uploaded';

       }
       else{
           return 'no File';
       }

   







    }





}
