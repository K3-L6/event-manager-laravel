<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Audit;
use App\User;
use App\Event;
use Flashy;
use PDF;
use QrCode;
use Auth;
use Carbon\Carbon;

class RegistratorController extends Controller
{
    public function index()
    {
    	return view('registrator');
    }

    public function prereg()
    {
        $guest = Guest::where('type',1)->get();
        return view('guest_prereg_list')->withGuest($guest);
    }

    public function prereg_update_show($id)
    {
        $guest = Guest::find($id);
        return view('guest_prereg_update')->withGuest($guest);
    }

    public function prereg_update($id, Request $request)
    {
        $this->validate($request,
            [
                'idcard' => 'required|max:180|unique:guests, "idcard", ' . $id,
            ],
            [
                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
                'idcard.unique' => 'RFID Card is already taken',
            ]
        );

        $user = User::find(Auth::user()->id);
        $data = Guest::find($id);
        $qrimagename = time() . '_' . $request->idcard . '.png';
       
        // All guest data into QrCode
        QrCode::format('png')
        ->size(300)
        ->errorCorrection('H')
        ->generate(
            'Name : ' . ucwords($data->firstname . ' ' . $data->middlename . ' ' . $data->lastname) . '/' .
            'Email : ' . $data->email . '/' .
            'Mobile Number : ' . $data->mobilenumber . '/' . 
            'Designation : ' . $data->designation . '/' . 
            'Company : ' . $data->companyname . '/' . 
            'Office Tel Number : ' . $data->officetelnumber . '/'
        , '../public/img/guest/'. $qrimagename);
          
        $data->idcard = $request->idcard;
        $data->qrcode = $qrimagename;
        $data->save();

        $event = Event::first();
        $pdf = PDF::loadView('pdf.badge', array(
        'name' => $request->fname . ' ' . $request->mname . ' ' . $request->lname,
        'companyname' => $request->cname,
        'designation' => $request->designation,
        'qrcode' => $qrimagename,
        'eventname' => $event->title,
        'idcard' => $request->idcard,
        'status' => $event->status
        ));

        $audit = new Audit;
        $audit->description = 'Updated a guest account for ' . $data->firstname . ' ' . $data->lastname;  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();
        
        Flashy::success('Successfully Updated the Guest', '#');
        return $pdf->download($data->firstname . '_' . $data->lastname . '_badge.pdf');
    }

    public function  walkin()
    {
      return view('guest_register_walkin'); 
    }

    public function guest_register(Request $request)
    {
    	$this->validate($request,
    	    [
    	        'fname' => 'required|max:180',
    	        'mname' => 'max:180',
    	        'lname' => 'required|max:180',
    	        'email' => 'required|unique:guests',
    	        'designation' => 'required|max:180',
    	        'cname' => 'required|max:180',
    	        'addr' => 'required|max:180',
    	        'mobilenum' => 'required|max:20',
    	        'telnum' => 'required|max:20',
    	        'idcard' => 'required|max:180|unique:guests',
    	    ],
    	    [
    	        'fname.required' => 'First Name is required',
    	        'fname.max' => 'First Name must not be greater than 180',
    	        
    	        'mname.max' => 'Middle Name must not be greater than 180',

    	        'lname.required' => 'Last Name is required',
    	        'lname.max' => 'Last Name must not be greater than 180',

    	        'email.required' => 'Email is required',
    	        'email.max' => 'Email must not be greater that 180',
    	        'email.unique' => 'Email is already taken',

    	        'designation.required' => 'Designation is required',
    	        'designation.max' => 'Designation must not be greater than 180',

    	        'cname.required' => 'Company Name is required',
    	        'cname.max' => 'Company Name must not be greater than 180',

    	        'addr.required' => 'Office Address is required',
    	        'addr.max' => 'Office Address must not be greater than 180',

    	        'mobilenum.required' => 'Mobile Number is required',
    	        'mobilenum.max' => 'Mobile Number must not be greater than 20',

    	        'telnum.required' => 'Office Tel # is required',
    	        'telnum.max' => 'Office Tel # must not be greater than 20',

                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
                'idcard.unique' => 'RFID Card is already taken',
    	    ]
    	);

    	    $user = User::find(Auth::user()->id);
    		$guest = new Guest;
    	    $qrimagename = time() . '_' . $request->idcard . '.png';
            // All guest data into QrCode
            QrCode::format('png')
            ->size(300)
            ->errorCorrection('H')
            ->generate(
                'Name : ' . ucwords($request->fname . ' ' . $request->mname . ' ' . $request->lname) . '/' .
                'Email : ' . $request->email . '/' .
                'Mobile Number : ' . $request->mobilenum . '/' . 
                'Designation : ' . $request->designation . '/' . 
                'Company : ' . $request->cname . '/' . 
                'Office Tel Number : ' . $request->telnum . '/'
            , '../public/img/guest/'. $qrimagename);

    	    $papersize = array(0, 0, 360, 360);
    	    $guest->idcard = $request->idcard;
    		$guest->firstname = $request->fname;
    		$guest->middlename = $request->mname;
    		$guest->lastname = $request->lname;
    		$guest->designation = $request->designation;
    		$guest->email =$request->email;
    		$guest->companyname = $request->cname;
    		$guest->officeaddress = $request->addr;
    		$guest->mobilenumber = $request->mobilenum;
    		$guest->officetelnumber = $request->telnum;
    		$guest->type = "2";
    		$guest->qrcode = $qrimagename;
    	    $guest->save(); 
    	   
            $event = Event::first();
    	    $pdf = PDF::loadView('pdf.badge', array(
    	    'name' => $request->fname . ' ' . $request->mname . ' ' . $request->lname,
    	    'companyname' => $request->cname,
    	    'designation' => $request->designation,
    	    'qrcode' => $qrimagename,
            'eventname' => $event->title,
            'idcard' => $request->idcard,
            'status' => $event->status
    	    ));

    	    $audit = new Audit;
    	    $audit->description = 'created a guest account for ' . $guest->fname . ' ' . $guest->lname;  
    	    $audit->user_id = $user->id;
    	    $audit->time = Carbon::now();;
    	    $audit->save();

    	    Flashy::success('Successfully Registered the Guest', '#');
    	    return $pdf->download($guest->firstname . '_' . $guest->lastname . '_badge.pdf');
    }
}
