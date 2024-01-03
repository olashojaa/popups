<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builders\PopupBuilder;
use App\Http\Requests\PopupRequest;
use App\Models\Popup;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;


class PopupController extends Controller
{
    public function checkPopup(Request $request)
    {
 //get path
        $previousUrl = Redirect::back()->getTargetUrl();
        $relativeUrl = str_replace(url('/'), '', $previousUrl);
        //call command to check if there is any popup in this page
        Artisan::call('popups:check', ['url' => $relativeUrl]);


        // Retrieve the data from the cache
        $popupData = Cache::get('popupData');

        // Return the data as JSON
        return response()->json(['popupData' => $popupData]);
    }

    public function create()
    {
        
        return view('popups.create');
    }

    public function store(PopupRequest $request)
    {
        
        $validatedData = $request->validated();
       
        $popup = (new PopupBuilder())
        ->setContent(json_encode($validatedData['content']))
        ->setType($validatedData['type'])
            ->setName($validatedData['name'])
            ->setScheduled_pages(json_encode($validatedData['scheduled_pages']))
            ->build();
        return redirect()->route('popups.index')->with('success', 'Popup created successfully.');
    }

    public function index()
    {
        $popups = Popup::all();
        return view('popups.index', compact('popups'));
    }

    public function update(PopupRequest $request, Popup $popup)
    {
        $validatedData = $request->validated();

        $popup->update([
            'content' => json_encode($validatedData['content']),
            'scheduled_pages' => json_encode($validatedData['scheduled_pages']),
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],

        ]);

        return redirect()->route('popups.index')->with('success', 'Popup updated successfully.');
    }

    public function edit(Popup $popup)
    {
        return view('popups.edit', compact('popup'));
    }

   

    
}
