<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Audit;
use App\User;
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
                'idcard' => 'required|max:180',
            ],
            [
                'idcard.required' => 'ID Card is required',
                'idcard.max' => 'ID card must not be greater than 180',
            ]
        );

        $qrimagename = time() . '_' . $request->idcard . '.png';
        QrCode::format('png')->backgroundColor(34, 49, 63)->color(228, 241, 254)->size(300)->errorCorrection('H')->generate($request->idcard, '../public/img/guest/'. $qrimagename);
        
        $user = User::find(Auth::user()->id);
        $data = Guest::find($id);
        $data->idcard = $request->idcard;
        $data->qrcode = $qrimagename;
        $data->save();

        $pdf = PDF::loadView('pdf.badge', array(
        'name' => $request->fname . ' ' . $request->mname . ' ' . $request->lname,
        'companyname' => $request->cname,
        'designation' => $request->designation,
        'qrcode' => $qrimagename
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
    	        'mobilenum' => 'required|regex:/(09)[0-9]{9}/',
    	        'telnum' => 'required|max:180',
    	        

    	    ],
    	    [
    	        'fname.required' => 'First Name is required',
    	        'fname.max' => 'First Name must not be greater than 180',
    	        
    	        'mname.max' => 'Middle Name must not be greater than 180',

    	        'lname.required' => 'Last Name is required',
    	        'lname.max' => 'Last Name must not be greater than 180',

    	        'email.required' => 'Email is required',
    	        'email.max' => 'Email must not be greater that 180',
    	        'email.unique' => 'This Email is already in use',

    	        'designation.required' => 'Designation is required',
    	        'designation.max' => 'Designation must not be greater than 180',

    	        'cname.required' => 'Company Name is required',
    	        'cname.max' => 'Company Name must not be greater than 180',

    	        'addr.required' => 'Office Address is required',
    	        'addr.max' => 'Office Address must not be greater than 180',

    	        'mobilenum.required' => 'Mobile Number is required',
    	        'mobilenum.max' => 'Mobile Number format 09XXXXXXXXX',

    	        'telnum.required' => 'Office Telephone Number is required',
    	        'telnum.max' => 'Office Telephone format XXX-XXXX',
    	    ]
    	);

    	    $user = User::find(Auth::user()->id);
    		$data = new Guest;
    	    $qrimagename = time() . '_' . $request->idcard . '.png';
    	    QrCode::format('png')->backgroundColor(34, 49, 63)->color(228, 241, 254)->size(300)->errorCorrection('H')->generate($request->idcard, '../public/img/guest/'. $qrimagename);
    	    $papersize = array(0, 0, 360, 360);
    	    $data->idcard = $request->idcard;
    		$data->firstname = $request->fname;
    		$data->middlename = $request->mname;
    		$data->lastname = $request->lname;
    		$data->designation = $request->designation;
    		$data->email =$request->email;
    		$data->companyname = $request->cname;
    		$data->officeaddress = $request->addr;
    		$data->mobilenumber = $request->mobilenum;
    		$data->officetelnumber = $request->telnum;
    		$data->type = "2";
    		$data->qrcode = $qrimagename;
    	    $data->save(); 
    	   
    	    $pdf = PDF::loadView('pdf.badge', array(
    	    'name' => $request->fname . ' ' . $request->mname . ' ' . $request->lname,
    	    'companyname' => $request->cname,
    	    'designation' => $request->designation,
    	    'qrcode' => $qrimagename
    	    ));

    	    $audit = new Audit;
    	    $audit->description = 'created a guest account for ' . $data->fname . ' ' . $data->lname;  
    	    $audit->user_id = $user->id;
    	    $audit->time = Carbon::now();;
    	    $audit->save();

    	    Flashy::success('Successfully Registered the Guest', '#');
    	    return $pdf->download($guest->firstname . '_' . $guest->lastname . '_badge.pdf');
    }
}
