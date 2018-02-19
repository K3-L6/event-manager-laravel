<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
    	$event = Event::first();
    	return view('event')->withEvent($event);
    }

    public function show_save()
    {
    	return view('event_register');
    }

    public function save(Request $request)
    {
    	$this->validate($request,
    	    [
    	        'title' => 'required|max:150',
    	        'description' => 'max:500',
    	        'background' => 'required|image',

    	    ],
    	    [
    	        'title.required' => 'Event title is required',
    	        'title.max' => 'Event title must not be greater than 150',
    	        
    	        'description.max' => 'Event description must not be greater than 500',

    	        'background.required' => 'Background image is required',
    	        'background.image' => 'Must be an image',

    	    ]
    	);

    	$background = $request->file('background');
    	$filename = time() . '_' . $background->getClientOriginalName();
    	Image::make($background)->save( public_path('/img/event/' . $filename) );

    	$data = new Event;
    	$data->title = $request->title;
    	$data->description = $request->description;
    	$data->background = $filename;
    	$data->save();
    	
    	Flashy::success('Successfully Created Event', '#');
    	return redirect()->to('/admin/event');
    }

    public function show_update()
    {
    	$event = Event::first();
    	return view('event_update')->withEvent($event);
    }

    public function update(Request $request)
    {
    	$this->validate($request,
    	    [
    	        'title' => 'required|max:150',
    	        'description' => 'max:500',
    	    ],
    	    [
    	        'title.required' => 'Event title is required',
    	        'title.max' => 'Event title must not be greater than 150',
    	        
    	        'description.max' => 'Event description must not be greater than 500',
    	    ]
    	);
    	
    	$data = new Event;
    	if($request->hasFile('background'))
    	{
    		$background = $request->file('background');
    		$filename = time() . '_' . $background->getClientOriginalName();
    		Image::make($background)->save( public_path('/img/event/' . $filename) );
    		$data->background = $filename;	
    	}
    	
    	$data->title = $request->title;
    	$data->description = $request->description;
    
    	$data->save();
    	
    	Flashy::success('Successfully Updated Event', '#');
    	return redirect()->to('/admin/event');
    }
}
