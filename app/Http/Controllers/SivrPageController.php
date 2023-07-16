<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SivrPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    function index()
    {

        $sivrPages = SivrPage::with('children')->whereNull('parent_page_id')->get();

        $allPages = SivrPage::with('children', 'pageElements')->get();
        $sivrPagesJson = $allPages->toJson();

        return view('sivr.sivrPages.index', compact('sivrPages', 'sivrPagesJson'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {

        SivrPage::query()->create([

            'parent_page_id' => $request->parent_page_id,

            'vivr_id' => $request->vivr_id,
            'page_heading_ban' => $request->page_heading_ban,
            'page_heading_en' => $request->page_heading_en,
            'task' => $request->task,
            'has_previous_menu' => $request->has_previous_menu,
            'has_main_menu' => $request->has_main_menu,

            'service_title_id' => $request->service_title_id,

        ]);
        return redirect(route('sivr-pages.index'));
    }

    public function saveAudio(Request $request)
    {
        $pageId=$request->page_id;
        $sivrPage=SivrPage::find($pageId);
        $audio_file_ban = $request->file('audio_file_ban');
        $audio_file_en = $request->file('audio_file_en');

        // Validate and store the audio files
        if ($audio_file_ban && $audio_file_en) {
            $path_ban = $audio_file_ban->storeAs('audio_files', $audio_file_ban->getClientOriginalName());
            $path_en = $audio_file_en->storeAs('audio_files', $audio_file_en->getClientOriginalName());



            // Save the file paths to the database
          $updated=  $sivrPage->update([
                'audio_file_ban' => $path_ban,
                'audio_file_en' => $path_en,
            ]);
if ($updated){
    return redirect()->back();
}
else{
    echo "audio file upload failed";
}

        }

        return redirect()->back()->withErrors('Please upload both audio files.');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request)
    {

    }


    public function update(Request $request, SivrPage $sivrPage)
    {

        $updated = $sivrPage->update([


            'vivr_id' => $request->vivr_id,
            'page_heading_ban' => $request->page_heading_ban,
            'page_heading_en' => $request->page_heading_en,
            'task' => $request->task,
            'has_previous_menu' => $request->has_previous_menu,
            'has_main_menu' => $request->has_main_menu,
            'service_title_id' => $request->service_title_id,

        ]);
        if ($updated) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(SivrPage $sivrPage)
    {
        $sivrPage->forceDelete();
        return redirect(route('sivr-pages.index'));
    }
}







