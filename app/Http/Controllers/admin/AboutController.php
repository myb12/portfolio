<?php

namespace App\Http\Controllers\admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\About\AboutStoreRequest;
use App\Http\Requests\About\AboutUpdateRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $abouts = About::all();
      return view('admin.about.index',compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutStoreRequest $request,  About $about)
    {
       $about->name = $request->name;
       $about->designation = $request->designation;
       $about->note = $request->note;
       $about->description = $request->description;
       if($request->hasFile('image')){

           $path = $request->image->store('public/images/about');
           $about->image = $path;
       }
       $about->save();
       return redirect()->route('about.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $about = About::find($request->id);
        // dd($about->name);
        $about->name = $request->name;
        $about->designation = $request->designation;
        $about->note = $request->note;
        $about->description = $request->description;
        if($request->hasFile('image')){
            Storage::delete('/'.$request->old_image);
            $path = $request->image->store('public/images/about');
            $about->image = $path;
        }else{
            $about->image =$request->old_image;
        }
        $about->save();
        return redirect()->route('about.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if($about->image){
            Storage::delete('/'.$about->image);
        }
        $about->delete();
        return redirect()->route('about.index');

    }

    public function editAbout(Request $request){
        $about = About::find($request->id);
        // dd($about);
        $html='';
        $html = '
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                 <input type="hidden" id="id_edit" name="id" value="'. $about->id .'">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Title..." value="'. $about->name .'">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    placeholder="Enter Title..." value="'. $about->designation .'">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note"
                                    placeholder="Enter Title..." value="'. $about->note .'">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                    <label for="message">Description</label>
                                <textarea id="summary-ckeditor"  style="height: 150px;" class="textarea form-control" placeholder="Place Service Description here..."
                                        name="description">'. $about->description .'</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label  for="old_image">Old Image</label>
                                <img class="form-control-file" height="150px"  id="old_image" src="'.Storage::url($about->image).'" alt="">
                                <input type="hidden" name="old_image" value=" '.$about->image.'">
                            </div>
                        </div>    

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Upload Your Image</label>
                            
                                <input type="file" name="image" id="image" class="form-control-file"  placeholder="Enter image name..." value="'.$about->image.'" onchange="previewFile(this);">
                                </p>
                                <img style="width:100px;" id="previewImg" src="">
                                <p>
                            </div>
                        </div>
                </div>
        ';
        return response()->json([
            'data' => $html,
        ]);
    }
}
