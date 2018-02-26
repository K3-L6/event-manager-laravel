<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Image;
use Flashy;
use File;
use Auth;
use Carbon\Carbon;


use App\User;
use App\Event;
use App\Subevent;
use App\Guest;
use App\Audit;
use PDF;
use QrCode;

class AdminController extends Controller
{

    public function audit()
    {
        return view('audit');
    }

    public function audit_api()
    {
        $audit = Audit::with('user')->get();

        return Datatables::of($audit)
        ->editColumn('user', function($audit){
            return ucwords($audit->user->firstname . ' ' . $audit->user->lastname);
        })
        ->editColumn('role', function($audit){
            return ucwords($audit->user->role->name);
        })
        ->editColumn('description', function($audit){
            return ucwords($audit->description);
        })
        ->editColumn('time', function($audit){
            return Carbon::parse($audit->time)->diffForHumans();
        })
        ->make(true);
    }

    public function allguest()
    {
        return view('allguest');
    }

    public function allguest_api()
    {
        $guest = Guest::all();

        return Datatables::of($guest)
        ->editColumn('name', function($guest){
            return ucwords($guest->firstname . ' ' . $guest->middlename . ' ' . $guest->lastname);
        })
        ->editColumn('designation', function($guest){
            return ucwords($guest->designation);
        })
        ->editColumn('companyname', function($guest){
            return ucwords($guest->companyname);
        })
        ->addColumn('action', function($guest){
            return '
                <div class="btn-group" role="group">
                    <form action="/admin/guest/' . $guest->id . '" method="get">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>  
                    </form>

                    <form action="/admin/guest/print/' . $guest->id . '" method="post">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-print"></i></button>  
                    </form>

                    <form action="/admin/guest/delete/' . $guest->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            ';
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function guest($id)
    {
        $guest = Guest::find($id);
        return view('guest')->withGuest($guest);
    }

    public function guest_print($id)
    {
       $guest = Guest::find($id);
       $papersize = array(0, 0, 360, 360);
       $pdf = PDF::loadView('pdf.badge', array(
        'name' => $guest->firstname . ' ' . $guest->middlename . ' ' . $guest->lastname,
        'companyname' => $guest->companyname,
        'designation' => $guest->designation,
        'qrcode' => $guest->qrcode
       ));

       $user = User::find(aUTH::user()->id);
       $audit = new Audit;
       $audit->description = 'printed a guest badge for ' . $guest->firstname . ' ' . $guest->lastname;  
       $audit->user_id = $user->id;
       $audit->time = Carbon::now();;
       $audit->save();

       return $pdf->download($guest->firstname . '_' . $guest->lastname . '_badge.pdf');
    }

    public function guest_register_show()
    {
        return view('guest_register');
    }

    public function guest_register(Request $request)
    {
        $this->validate($request,
            [
                'lastname' => 'required|max:50',
                'middlename' => 'max:50',
                'firstname' => 'required|max:50',
                'email' => 'required|max:100',
                'mobilenumber' => 'required|max:11',

                'companyname' => 'required|max:100',
                'designation' => 'required|max:50',
                'officetelnumber' => 'required|max:7',
                'officeaddress' => 'required|max:180',


                'idcard' => 'required|max:180',
            ],
            [
                'lastname.required' => 'Lastname is required',
                'lastname.max' => 'Lastname must not be greater than 50',

                'middlename'=> 'Middlename must not be greater than 50',

                'firstname.required' => 'Firstname is required',
                'firstname.max' => 'Firstname must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 100',

                'mobilenumber.required' => 'Mobilenumber is required',
                'mobilenumber.max' => 'Mobilenumber must not be greater than 11',

                'companyname.required' => 'Company Name is required',
                'companyname.max' => 'Company Name must not be greater than 100',

                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation must not be greater than 50',

                'officetelnumber.required' => 'Office Tel Number is required',
                'officetelnumber.max' => 'Office Tel Number must not be greater than 7',

                'officeaddress.required' => 'Office Address is required',
                'officeaddress.max' => 'Office Address must not be greater than 180',

                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
            ]
        );

        $guest = new Guest;
        $qrimagename = time() . '_' . $request->idcard . '.png';
        QrCode::format('png')->backgroundColor(34, 49, 63)->color(228, 241, 254)->size(300)->errorCorrection('H')->generate($request->idcard, '../public/img/guest/'. $qrimagename);

        $guest->lastname = $request->lastname;
        $guest->middlename = $request->middlename;
        $guest->firstname = $request->firstname;
        $guest->email = $request->email;
        $guest->mobilenumber = $request->mobilenumber;
        $guest->companyname = $request->companyname;
        $guest->designation = $request->designation;
        $guest->officetelnumber = $request->officetelnumber;
        $guest->officeaddress = $request->officeaddress;
        $guest->idcard = $request->idcard;
        $guest->qrcode = $qrimagename;
        $guest->type = $request->type;
        $guest->save();

        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'created a guest account for ' . $request->firstname . ' ' . $request->lastname;  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        Flashy::success('Successfully Created Guest', '#');
        return redirect()->to('/admin/guest');
    }

    public function guest_update($id, Request $request)
    {
        $this->validate($request,
            [
                'lastname' => 'required|max:50',
                'middlename' => 'max:50',
                'firstname' => 'required|max:50',
                'email' => 'required|max:100',
                'mobilenumber' => 'required|max:11',

                'companyname' => 'required|max:100',
                'designation' => 'required|max:50',
                'officetelnumber' => 'required|max:7',
                'officeaddress' => 'required|max:180',


                'idcard' => 'required|max:180',
            ],
            [
                'lastname.required' => 'Lastname is required',
                'lastname.max' => 'Lastname must not be greater than 50',

                'middlename'=> 'Middlename must not be greater than 50',

                'firstname.required' => 'Firstname is required',
                'firstname.max' => 'Firstname must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 100',

                'mobilenumber.required' => 'Mobilenumber is required',
                'mobilenumber.max' => 'Mobilenumber must not be greater than 11',

                'companyname.required' => 'Company Name is required',
                'companyname.max' => 'Company Name must not be greater than 100',

                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation must not be greater than 50',

                'officetelnumber.required' => 'Office Tel Number is required',
                'officetelnumber.max' => 'Office Tel Number must not be greater than 7',

                'officeaddress.required' => 'Office Address is required',
                'officeaddress.max' => 'Office Address must not be greater than 180',

                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
            ]
        );

        $guest = Guest::find($id);
        $qrimagename = time() . '_' . $request->idcard . '.png';
        QrCode::format('png')->size(300)->errorCorrection('H')->generate($request->idcard, '../public/img/guest/'. $qrimagename);
        
        $guest->lastname = $request->lastname;
        $guest->middlename = $request->middlename;
        $guest->firstname = $request->firstname;
        $guest->email = $request->email;
        $guest->mobilenumber = $request->mobilenumber;
        $guest->companyname = $request->companyname;
        $guest->designation = $request->designation;
        $guest->officetelnumber = $request->officetelnumber;
        $guest->officeaddress = $request->officeaddress;
        $guest->idcard = $request->idcard;
        $guest->qrcode = $qrimagename;
        $guest->type = $request->type;
        $guest->save();

        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'updated a guest account for ' . $request->firstname . ' ' . $request->lastname;  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        Flashy::success('Successfully Updated Guest', '#');
        return redirect()->to('/admin/guest');
    }

    public function guest_delete($id)
    {
        $guest = GUest::find($id);
        
        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'deleted ' . $guest->firstname . ' ' . $guest->lastname . ' guest account';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        $guest->delete();
        Flashy::success('Successfully Deleted Guest', '#');
        return redirect()->to('/admin/guest');
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


    	$event = Event::where('status', 1)->first();
    	if($request->hasFile('img'))
    	{
    		$background = $request->file('img');
    		$filename = time() . '_' . $background->getClientOriginalName();
    		Image::make($background)->save( public_path('/img/event/' . $filename) );
    		$event->background = $filename;
    	}
    	
    	$event->title = $request->title;
    	$event->title_font = str_replace('+', ' ', $request->title_font);
    	$event->title_size = $request->title_size;
        $event->title_color = $request->title_color;

    	$event->description = $request->description;
    	$event->description_font = str_replace('+', ' ', $request->description_font);
    	$event->description_size = $request->description_size;
        $event->description_color = $request->description_color;

    	$event->save();
        
        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'updated the event information';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

    	Flashy::success('Successfully Updated Event', '#');
    	return redirect()->to('/admin/event');
    }




    public function allsubevent_api()
    {
        $event = Event::where('status', '1')->first();
        $subevent = Subevent::where('event_id', $event->id)->with('user')->get();

        return Datatables::of($subevent)
        ->editColumn('exhibitor', function($subevent){
            $user = User::find($subevent->user_id);
            return $user->firstname . ' ' . $user->lastname;
        })
        ->addColumn('action', function($subevent){
            return '
                <div class="btn-group" role="group">
                    
                    <form action="/admin/subevent/' . $subevent->id . '" method="get">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>  
                    </form>

                    <form action="/subevent/entrance/' . $subevent->id . '" method="get">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-forward"></i></button>  
                    </form>

                    <form action="/admin/subevent/delete/' . $subevent->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
                
            ';
        })
        ->make(true);
    }

    public function subevent($id)
    {
        $users = User::where('role_id', 3)->get();
        $subevent = Subevent::find($id);
        return view('subevent')->withUsers($users)->withSubevent($subevent);
    }

    public function subevent_update($id, Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|max:150',
                'description' => 'max:500',
                'exhibitor' => 'required',
                'img' => 'image',

            ],
            [
                'title.required' => 'Subevent title is required',
                'title.max' => 'Subevent title must not be greater than 150',
                
                'description.max' => 'Subevent description must not be greater than 500',

                'exhibitor.required' => 'Exhibitor is required',

                'img.image' => 'Background must be an image',
            ]
        );

        $event = Event::where('status', 1)->first();
        $subevent =  Subevent::find($id);

        if($request->hasFile('img'))
        {
            $background = $request->file('img');
            $filename = time() . '_' . $background->getClientOriginalName();
            Image::make($background)->save( public_path('/img/subevent/' . $filename) );
            $subevent->background = $filename;
        }
        
        $subevent->title = $request->title;
        $subevent->title_font = str_replace('+', ' ', $request->title_font);
        $subevent->title_size = $request->title_size;
        $subevent->title_color = $request->title_color;

        $subevent->description = $request->description;
        $subevent->description_font = str_replace('+', ' ', $request->description_font);
        $subevent->description_size = $request->description_size;
        $subevent->description_color = $request->description_color;

        $subevent->event_id = $event->id;
        $subevent->user_id = $request->exhibitor;

        $subevent->save();

        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'updated the ' . $request->title . ' information';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        
        Flashy::success('Successfully Updated Subevent', '#');
        return redirect()->to('/admin/subevent/' . $subevent->id);
    }

    public function subevent_delete($id)
    {
        $subevent = Subevent::find($id);
        
        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'deleted the ' . $subevent->title . ' sub event';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        $subevent->delete();
        Flashy::success('Successfully Deleted Subevent', '#');
        return redirect()->to('/admin/subevent');
    }

    public function allsubevent()
    {
        return view('allsubevent');
    }

    public function subevent_register_show()
    {
        $users = User::where('role_id', 3)->get();
        return view('subevent_register')->withUsers($users);
    }

    public function subevent_register(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|max:150',
                'description' => 'max:500',
                'exhibitor' => 'required',
                'img' => 'required|image',

            ],
            [
                'title.required' => 'Subevent title is required',
                'title.max' => 'Subevent title must not be greater than 150',
                
                'description.max' => 'Subevent description must not be greater than 500',

                'exhibitor.required' => 'Exhibitor is required',

                'img.required' => 'Background is required',
                'img.image' => 'Background must be an image',
            ]
        );

        $event = Event::where('status', 1)->first();
        $subevent = new Subevent;
        
        $background = $request->file('img');
        $filename = time() . '_' . $background->getClientOriginalName();
        Image::make($background)->save( public_path('/img/subevent/' . $filename) );
        $subevent->background = $filename;
        
        $subevent->title = $request->title;
        $subevent->title_font = str_replace('+', ' ', $request->title_font);
        $subevent->title_size = $request->title_size;
        $subevent->title_color = $request->title_color;

        $subevent->description = $request->description;
        $subevent->description_font = str_replace('+', ' ', $request->description_font);
        $subevent->description_size = $request->description_size;
        $subevent->description_color = $request->description_color;

        $subevent->event_id = $event->id;
        $subevent->user_id = $request->exhibitor;

        $subevent->save();

        $user = User::find(aUTH::user()->id);
        $audit = new Audit;
        $audit->description = 'registered a new sub event with the title of ' . $request->title;
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();
        
        Flashy::success('Successfully Created Subevent', '#');
        return redirect()->to('/admin/subevent');
    }


    public function index()
    {
        return view('admin');
    }
    
}
