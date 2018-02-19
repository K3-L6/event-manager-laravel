<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Flashy;
use File;

use App\Event;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin');
    }

    public function event()
    {
    	$event = Event::where('status', 1)->first();
    	return view('event')->withEvent($event);
    }

    public function event_update(Request $request)
    {
    	$this->validate($request,
    	    [
    	        'title' => 'required|max:150',
    	        'description' => 'max:500',
    	        'img' => 'image',

    	    ],
    	    [
    	        'title.required' => 'Event title is required',
    	        'title.max' => 'Event title must not be greater than 150',
    	        
    	        'description.max' => 'Event description must not be greater than 500',

    	        'img.image' => 'Background must be an image',
    	    ]
    	);


    	$data = Event::where('status', 1)->first();
    	if($request->hasFile('img'))
    	{
    		$background = $request->file('img');
    		$filename = time() . '_' . $background->getClientOriginalName();
    		Image::make($background)->save( public_path('/img/event/' . $filename) );
    		$data->background = $filename;
    	}
    	
    	$data->title = $request->title;
    	$data->title_font = str_replace('+', ' ', $request->title_font);
    	$data->title_size = $request->title_size;

    	$data->description = $request->description;
    	$data->description_font = str_replace('+', ' ', $request->description_font);
    	$data->description_size = $request->description_size;

    	$data->save();
    	
    	Flashy::success('Successfully Updated Event', '#');
    	return redirect()->to('/admin/event');
    }
}
