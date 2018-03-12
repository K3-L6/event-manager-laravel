<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Image;
use Flashy;
use File;
use Auth;
use Carbon\Carbon;
use PDF;
use QrCode;
use Excel;

use App\User;
use App\Access;
use App\Event;
use App\Role;
use App\Subevent;
use App\Guest;
use App\Audit;
use App\Eventlog;
use App\Subeventlog;

class AdminController extends Controller
{

    public function roles_show()
    {
        $administratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'administrator');
            });
        })->get());
        $exhibitorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get());
        $registratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'registrator');
            });
        })->get());
        return view('roles')
        ->withAdministratorcount($administratorcount)
        ->withExhibitorcount($exhibitorcount)
        ->withRegistratorcount($registratorcount);
    }

    public function roles_api()
    {
        $role = Role::with('access')->get();

        return Datatables::of($role)
        ->editColumn('name', function($role){
            return ucwords($role->name);
        })
        ->editColumn('description', function($role){
            return ucwords($role->description);
        })
        ->editColumn('modules', function($role){
            $x = '';
            foreach ($role->access as $access) {
                $x .= ucwords($access->module) . ', ';
            }
            return substr($x, 0, -2);
        })
        ->addColumn('action', function($role){
            return '
                <div class="btn-group" role="group">
                    
                    <form action="/admin/usersetting/roles/delete/' . $role->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>

                </div>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function roles_register(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|max:20',
                'description' => 'required|max:150',
            ],
            [
                'name.required' => 'Role name is required',
                'name.max' => 'Role name must not be greater than 20',

                'description.required' => 'Description is required',
                'description.max' => 'Description must not be greater than 150',
            ]
        );

        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        $theresmodule = false;
        if ($request->administrator == 1) {
            $access = new Access;
            $access->module = 'administrator';
            $access->role_id = $role->id;
            $access->save();
            $theresmodule = true;
        }
        if ($request->exhibitor == 1) {
            $access = new Access;
            $access->module = 'exhibitor';
            $access->role_id = $role->id;
            $access->save();
            $theresmodule = true;
        }
        if ($request->registrator == 1) {
            $access = new Access;
            $access->module = 'registrator';
            $access->role_id = $role->id;
            $access->save();
            $theresmodule = true;
        }
        if (!$theresmodule) {
            $role->delete();
            Flashy::error('Required Atleast One Module', '#');
            return redirect()->back();
        }

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'created a new role named ' . $role->name;
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        Flashy::success('Successfully Created Role', '#');
        return redirect()->back();
    }

    public function roles_delete($id)
    {
        $role = Role::find($id);
        $role->delete();

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'delete a role named ' . $role->name;
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        Flashy::success('Successfully Deleted Role', '#');
        return redirect()->back();
    }

    public function guest_import(Request $request)
    {
        if ($request->hasFile('myexcel')) 
        {
            $path = $request->file('myexcel')->getRealPath();
            $data = \Excel::load($path)->get();
            if ($data->count()) 
            {   
                foreach ($data as $key => $value) 
                {
                    
                    $arr[] = ['email' => $value['username'],
                              'firstname' => $value['first_name'],
                              'middlename' => $value['middle_name'],
                              'lastname' => $value['last_name'],
                              'designation' => $value['designation'],
                              'companyname' => $value['company_name'],
                              'officeaddress' => $value['office_address'],
                              'mobilenumber' => $value['mobile_number_format_09xx_xxxxxxx'],
                              'officetelnumber' => $value['office_tel._no._format_02_xxxxxxx'],
                              'type' => 1

                             ];
                }

                if(!empty($arr))
                {
                    try{
                        \DB::table('guests')->insert($arr);

                        Flashy::success('Successfully imported data', '#');
                        return redirect()->to('/admin/guest');
                    }catch(\Exception $e){
                        Flashy::error('Invalid Data File', '#');
                        return redirect()->to('/admin/guest');
                    }
                    
                }

                Flashy::error('Invalid Data File', '#');
            }
        }
        return "no file";
    }

    public function usersetting()
    {
        $administratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'administrator');
            });
        })->get());
        $exhibitorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get());
        $registratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'registrator');
            });
        })->get());
        return view('usersetting')
        ->withAdministratorcount($administratorcount)
        ->withExhibitorcount($exhibitorcount)
        ->withRegistratorcount($registratorcount);
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        $user->delete();

        Flashy::success('Successfully Deleted A User');
        return redirect()->to('/admin/usersetting');
    }

    public function user_update_show($id)
    {
        $role = Role::all();
        $user = User::find($id);
        return view('user_update')->withUser($user)->withRole($role);
    }

    public function user_update($id, Request $request)
    {
        $this->validate($request,
            [
                'lastname' => 'required|max:50',
                'middlename' => 'max:50',
                'firstname' => 'required|max:50',

                'email' => 'required|max:50|unique:users, "email", ' . $id,
                'password' => 'sometimes|nullable|min:6|max:50|confirmed',

                'role' => 'required',

            ],
            [
                'lastname.required' => 'Last name is required',
                'lastname.max' => 'Last name must not be greater than 50',

                'middlename.max' => 'Middle name must not be greater than 50',

                'firstname.required' => 'First name is required',
                'firstname.max' => 'First name must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 50',
                'email.unique' => 'Email is already in use',

                'password.min' => 'Password must not be less than 6',
                'password.max' => 'Password must not be greater than 50',
                'password.confirmed' => 'Password does not match',

                'role.required' => 'Role is required',

            ]
        );

        $user = User::find($id);
        
        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $filename = time() . '_' . $img->getClientOriginalName();
            Image::make($img)->save( public_path('/img/user/' . $filename) );
            $user->avatar = $filename;    
        }

        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);
        }

        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->save();

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'updated user information for ' . $request->lastname . ' ' . $request->middlename . ' ' . $request->lastname;
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();

        Flashy::success('Successfully Upadated a User', '#');
        return redirect()->to('/admin/usersetting');
    }

    public function user_register_show()
    {
        $role = Role::all();
        return view('user_register')
        ->withRole($role);
    }

    public function user_register(Request $request)
    {
        $this->validate($request,
            [
                'lastname' => 'required|max:50',
                'middlename' => 'max:50',
                'firstname' => 'required|max:50',

                'email' => 'required|max:50|unique:users',
                'password' => 'required|min:6|max:50|confirmed',

                'role' => 'required',

            ],
            [
                'lastname.required' => 'Last name is required',
                'lastname.max' => 'Last name must not be greater than 50',

                'middlename.max' => 'Middle name must not be greater than 50',

                'firstname.required' => 'First name is required',
                'firstname.max' => 'First name must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 50',
                'email.unique' => 'Email is already in use',

                'password.required' => 'Password is required',
                'password.min' => 'Password must not be less than 6',
                'password.max' => 'Password must not be greater than 50',
                'password.confirmed' => 'Password does not match',

                'role.required' => 'Role is required',

            ]
        );


        $user = new User;

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $filename = time() . '_' . $img->getClientOriginalName();
            Image::make($img)->save( public_path('/img/user/' . $filename) );
            $user->avatar = $filename;    
        }else{
            $user->avatar = 'noimg.jpg';
        }
        
        
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;

        $user->save();

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'registered a new user named ' . $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname;
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();;
        $audit->save();
        
        Flashy::success('Successfully Created a User', '#');
        return redirect()->to('/admin/usersetting');
    }

    

    public function usersetting_api()
    {
        $user = User::with('role')->get();

        return Datatables::of($user)
        ->editColumn('avatar', function($user){
            return '
                <img src="'. asset('img/user/' . $user->avatar) .'" style="height: 50px; width: 50px;">
            ';
        })
        ->editColumn('name', function($user){
            return ucwords(ucwords($user->firstname) . ' ' . ucwords($user->middlename) . ' ' . ucwords($user->lastname));
        })
        ->editColumn('role', function($user){
            return ucwords($user->role->name);
        })
        ->addColumn('action', function($user){
            return '
                <div class="btn-group" role="group">
                    
                    <form action="/admin/user/update/' . $user->id . '" method="get">
                        <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i></button>  
                    </form>
                    <form action="/admin/user/delete/' . $user->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            ';
        })
        ->rawColumns(['avatar', 'action'])
        ->make(true);
    }

    //reports
    public function report_audit()
    {
        return view('report_audit');
    }

    public function report_audit_print()
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed audit trail report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Audit Trail Report');
        return redirect()->back();
    }

    public function report_audit_excel()
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel audit trail report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Audit Trail Report');
        return redirect()->back();
    }

    public function report_auditapi()
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
            return Carbon::parse($audit->time)->format('F d, Y g:i A');
        })
        ->make(true);   
    }

    public function report_subeventlist()
    {
        return view('report_subeventlist');
    }

    public function report_subeventlist_print()
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed subevent list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Subevent List Report');
        return redirect()->back();
    }

    public function report_subeventlist_excel()
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel subevent list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Subevent List Report');
        return redirect()->back();
    }

    public function report_subeventlistapi()
    {
        $event = Event::where('status', '1')->first();
        $subevent = Subevent::where('event_id', $event->id)->with('user')->get();

        return Datatables::of($subevent)
        ->editColumn('exhibitor', function($subevent){
            $user = User::find($subevent->user_id);
            return $user->firstname . ' ' . $user->lastname;
        })
        ->make(true);   
    }
    public function report_subevent_alllogs($id)
    {
        $subevent = Subevent::find($id);
        return view('report_alltypeguestlogs_subevent')->withSubevent($subevent);
    }

    public function report_subevent_alllogs_print($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed all type guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed All Type Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }

    public function report_subevent_alllogs_excel($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel all type guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel All Type Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }

    public function report_subevent_prereglogs($id)
    {
        $subevent = Subevent::find($id);
        return view('report_preregguestlogs_subevent')->withSubevent($subevent);
    }

    public function report_subevent_prereglogs_print($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed pre registered guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Pre Registered Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }

    public function report_subevent_prereglogs_excel($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel pre registered guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Pre Registered Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }

    public function report_subevent_walkinlogs($id)
    {
        $subevent = Subevent::find($id);
        return view('report_walkinguestlogs_subevent')->withSubevent($subevent);
    }

    public function report_subevent_walkinlogs_print($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed walk in guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Walk In Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }

    public function report_subevent_walkinlogs_excel($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel walk in guest logs report from ' . $subevent->title . ' subevevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Walk In Guest Logs Report From ' . $subevent->title . ' Subevent', '#');
        return redirect()->back();
    }


    public function report_subevent_alllogs_api($id)
    {
        $subeventlogs = Subeventlog::where('subevent_id', $id)->get();

        return Datatables::of($subeventlogs)
        ->editColumn('name', function($subeventlogs){
            return ucwords($subeventlogs->guest->firstname . ' ' . $subeventlogs->guest->middlename . ' ' . $subeventlogs->guest->lastname);
        })
        ->editColumn('email', function($subeventlogs){
            return ucwords($subeventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($subeventlogs){
            return ucwords($subeventlogs->guest->designation);
        })
        ->editColumn('companyname', function($subeventlogs){
            return ucwords($subeventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($subeventlogs){
            return ucwords($subeventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('F d, Y');
        })
        ->editColumn('type', function($subeventlogs){
            if ($subeventlogs->guest->type == 2) {
                return 'Walk-In Guest';
            }else{
                return 'Pre-Registered Guest';
            }
        })
        ->make(true);
    }

    public function report_subevent_prereglogs_api($id)
    {
        $subeventlogs = Subeventlog::where('subevent_id', $id)->whereHas('guest', function($guest){
            $guest->where('type', 1);
        })->get();

        return Datatables::of($subeventlogs)
        ->editColumn('name', function($subeventlogs){
            return ucwords($subeventlogs->guest->firstname . ' ' . $subeventlogs->guest->middlename . ' ' . $subeventlogs->guest->lastname);
        })
        ->editColumn('email', function($subeventlogs){
            return ucwords($subeventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($subeventlogs){
            return ucwords($subeventlogs->guest->designation);
        })
        ->editColumn('companyname', function($subeventlogs){
            return ucwords($subeventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($subeventlogs){
            return ucwords($subeventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('F d, Y');
        })
        ->make(true);
    }

    public function report_subevent_walkinlogs_api($id)
    {
        $subeventlogs = Subeventlog::where('subevent_id', $id)->whereHas('guest', function($guest){
            $guest->where('type', 2);
        })->get();

        return Datatables::of($subeventlogs)
        ->editColumn('name', function($subeventlogs){
            return ucwords($subeventlogs->guest->firstname . ' ' . $subeventlogs->guest->middlename . ' ' . $subeventlogs->guest->lastname);
        })
        ->editColumn('email', function($subeventlogs){
            return ucwords($subeventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($subeventlogs){
            return ucwords($subeventlogs->guest->designation);
        })
        ->editColumn('companyname', function($subeventlogs){
            return ucwords($subeventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($subeventlogs){
            return ucwords($subeventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($subeventlogs){
            return ucwords($subeventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($subeventlogs){
            return Carbon::parse($subeventlogs->time)->format('F d, Y');
        })
        ->make(true);
    }

    public function report_subevent()
    {
        return view('report_subevent');
    }
    public function report_subevent_api()
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
                    
                    <form action="/admin/report/subevent/all/' . $subevent->id . '" method="get">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-chevron-right"></i></button>  
                    </form>

                </div>
                
            ';
        })
        ->make(true);
    }

    public function report_alltypeguestlist()
    {
        return view('report_alltypeguestlist');
    }

    public function report_alltypeguestlist_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed all type guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed All Type Guest List Report');
        return redirect()->back();
    }

    public function report_alltypeguestlist_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel all type guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel All Type Guest List Report');
        return redirect()->back();
    }

    public function report_walkinguestlist()
    {
        return view('report_walkinguestlist');
    }

    public function report_walkinguestlist_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed walk in guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Walk In Guest List Report');
        return redirect()->back();
    }

    public function report_walkinguestlist_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel walk in guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Walk In Guest List Report');
        return redirect()->back();
    }

    public function report_preregguestlist()
    {
        return view('report_preregguestlist');
    }

    public function report_preregguestlist_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed pre registered guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Pre Registered Guest List Report');
        return redirect()->back();
    }

    public function report_preregguestlist_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel pre registered guest list report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Pre Registered Guest List Report');
        return redirect()->back();
    }


    public function report_alltypeguestlogs()
    {
        return view('report_alltypeguestlogs');
    }

    public function report_alltypeguestlogs_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed all type guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed All Type Guest Attendance Report');
        return redirect()->back();
    }

    public function report_alltypeguestlogs_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel all type guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel All Type Guest Attendance Report');
        return redirect()->back();
    }

    public function report_walkinguestlogs()
    {
        return view('report_walkinguestlogs');
    }

    public function report_walkinguestlogs_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed walk in guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Walk In Guest Attendance Report');
        return redirect()->back();
    }

    public function report_walkinguestlogs_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel walk in guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Walk In Guest Attendance Report');
        return redirect()->back();
    }

    public function report_preregguestlogs()
    {
        return view('report_preregguestlogs');
    }

    public function report_preregguestlogs_print(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'printed pre registered guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Printed Pre Registered Guest Attendance Report');
        return redirect()->back();
    }

    public function report_preregguestlogs_excel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'exported to excel pre registered guest attendance report';  
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

        Flashy::success('Successfully Exported To Excel Pre Registered Guest Attendance Report');
        return redirect()->back();
    }

    // reports api
    public function report_alltypeguestlistapi()
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
        ->editColumn('type', function($guest){
            if ($guest->type == 2) {
                return 'Walk-In Guest';
            }else{
                return 'Pre-Registered Guest';
            }
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function report_walkinguestlistapi()
    {
        $guest = Guest::where('type', 2)->get();

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
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function report_preregguestlistapi()
    {
        $guest = Guest::where('type', 1)->get();

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
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function report_alltypeguestlogsapi()
    {
        $eventlogs = Eventlog::all();

        return Datatables::of($eventlogs)
        ->editColumn('name', function($eventlogs){
            return ucwords($eventlogs->guest->firstname . ' ' . $eventlogs->guest->middlename . ' ' . $eventlogs->guest->lastname);
        })
        ->editColumn('email', function($eventlogs){
            return ucwords($eventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($eventlogs){
            return ucwords($eventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($eventlogs){
            return ucwords($eventlogs->guest->designation);
        })
        ->editColumn('companyname', function($eventlogs){
            return ucwords($eventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($eventlogs){
            return ucwords($eventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($eventlogs){
            return ucwords($eventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('F d, Y');
        })
        ->editColumn('type', function($eventlogs){
            if ($eventlogs->guest->type == 2) {
                return 'Walk-In Guest';
            }else{
                return 'Pre-Registered Guest';
            }
        })
        ->make(true);
    }

    public function report_walkinguestlogsapi()
    {
        $eventlogs = Eventlog::whereHas('guest', function($guest){
            $guest->where('type', 2);
        })->get();
        return Datatables::of($eventlogs)
        ->editColumn('name', function($eventlogs){
            return ucwords($eventlogs->guest->firstname . ' ' . $eventlogs->guest->middlename . ' ' . $eventlogs->guest->lastname);
        })
        ->editColumn('email', function($eventlogs){
            return ucwords($eventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($eventlogs){
            return ucwords($eventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($eventlogs){
            return ucwords($eventlogs->guest->designation);
        })
        ->editColumn('companyname', function($eventlogs){
            return ucwords($eventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($eventlogs){
            return ucwords($eventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($eventlogs){
            return ucwords($eventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('F d, Y');
        })
        ->make(true);
    }

    public function report_preregguestlogsapi()
    {
        $eventlogs = Eventlog::whereHas('guest', function($guest){
            $guest->where('type', 1);
        })->get();
        return Datatables::of($eventlogs)
        ->editColumn('name', function($eventlogs){
            return ucwords($eventlogs->guest->firstname . ' ' . $eventlogs->guest->middlename . ' ' . $eventlogs->guest->lastname);
        })
        ->editColumn('email', function($eventlogs){
            return ucwords($eventlogs->guest->email);
        })
        ->editColumn('mobilenumber', function($eventlogs){
            return ucwords($eventlogs->guest->mobilenumber);
        })
        ->editColumn('designation', function($eventlogs){
            return ucwords($eventlogs->guest->designation);
        })
        ->editColumn('companyname', function($eventlogs){
            return ucwords($eventlogs->guest->companyname);
        })
        ->editColumn('officetelnumber', function($eventlogs){
            return ucwords($eventlogs->guest->officetelnumber);
        })
        ->editColumn('officeaddress', function($eventlogs){
            return ucwords($eventlogs->guest->officeaddress);
        })
        ->editColumn('time', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('g:i A');
        })
        ->editColumn('date', function($eventlogs){
            return Carbon::parse($eventlogs->time)->format('F d, Y');
        })
        ->make(true);
    }












    public function audit()
    {
        $administratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'administrator');
            });
        })->get());
        $exhibitorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get());
        $registratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'registrator');
            });
        })->get());
        return view('audit')
        ->withAdministratorcount($administratorcount)
        ->withExhibitorcount($exhibitorcount)
        ->withRegistratorcount($registratorcount);
    }

    public function audit_api()
    {
        $audit = Audit::with('user')->get();

        return Datatables::of($audit)
        ->editColumn('avatar', function($audit){
            return '
                <img src="'. asset('img/user/' . $audit->user->avatar) .'" style="height: 50px; width: 50px;">
            ';
        })
        ->editColumn('user', function($audit){
            return ucwords(ucwords($audit->user->firstname) . ' ' . ucwords($audit->user->middlename) . ' ' . ucwords($audit->user->lastname));
        })
        ->editColumn('role', function($audit){
            return ucwords($audit->user->role->name);
        })
        ->editColumn('description', function($audit){
            return ucwords($audit->description);
        })
        ->editColumn('time', function($audit){
            return Carbon::parse($audit->time)->format('F d, Y g:i A');
        })
        ->rawColumns(['avatar'])
        ->make(true);
    }

    public function allguest()
    {
        $walkin = count(Guest::where('type', 2)->get());
        $prereg = count(Guest::where('type', 1)->get());
        $total = $walkin + $prereg;   
        return view('allguest')
        ->withWalkin($walkin)
        ->withPrereg($prereg)
        ->withTotal($total);
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
        ->editColumn('companyname', function($guest){
            return ucwords($guest->companyname);
        })
        ->editColumn('type', function($guest){
            if ($guest->type == 2) {
                return 'Walk-In Guest';
            }else{
                return 'Pre-Registered Guest';
            }
        })
        ->addColumn('action', function($guest){
            $top = '<div class="btn-group" role="group">';
            $mid = '
                <form action="/admin/guest/' . $guest->id . '" method="get">
                    <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i></button>  
                </form>
            ';
            $bot = '
                    <form action="/admin/guest/delete/' . $guest->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            ';

            if($guest->idcard != null && $guest->qrcode != null)
            {
                $mid .= '
                    <form action="/admin/guest/print/' . $guest->id . '" method="post">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i></button>  
                    </form>
                ';
            }
            return $top .= $mid .= $bot;
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
       $event = Event::first();
       $papersize = array(0, 0, 360, 360);
       $pdf = PDF::loadView('pdf.badge', array(
        'name' => $guest->firstname . ' ' . $guest->middlename . ' ' . $guest->lastname,
        'companyname' => $guest->companyname,
        'designation' => $guest->designation,
        'qrcode' => $guest->qrcode,
        'eventname' => $event->title
       ));

       $user = User::find(Auth::user()->id);
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
                'email' => 'required|max:100|unique:guests',
                'mobilenumber' => 'required|max:20',

                'companyname' => 'required|max:100',
                'designation' => 'required|max:50',
                'officetelnumber' => 'required|max:20',
                'officeaddress' => 'required|max:180',


                'idcard' => 'required|max:180|unique:guests',
            ],
            [
                'lastname.required' => 'Lastname is required',
                'lastname.max' => 'Lastname must not be greater than 50',

                'middlename'=> 'Middlename must not be greater than 50',

                'firstname.required' => 'Firstname is required',
                'firstname.max' => 'Firstname must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 100',
                'email.unique' => 'Email is already taken',

                'mobilenumber.required' => 'Mobilenumber is required',
                'mobilenumber.max' => 'Mobilenumber must not be greater than 20',

                'companyname.required' => 'Company Name is required',
                'companyname.max' => 'Company Name must not be greater than 100',

                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation must not be greater than 50',

                'officetelnumber.required' => 'Office Tel Number is required',
                'officetelnumber.max' => 'Office Tel Number must not be greater than 20',

                'officeaddress.required' => 'Office Address is required',
                'officeaddress.max' => 'Office Address must not be greater than 180',

                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
                'idcard.unique' => 'RFID Card is already taken',
            ]
        );

        $guest = new Guest;
        
        $qrimagename = time() . '_' . $request->idcard . '.png';
        
        // RFID Only in QrCode
        QrCode::format('png')
        ->size(300)->errorCorrection('H')
        ->generate($request->idcard, '../public/img/guest/'. $qrimagename);
        
        // All guest data into QrCode
        // QrCode::format('png')
        // ->backgroundColor(34, 49, 63)
        // ->color(228, 241, 254)
        // ->size(300)
        // ->errorCorrection('H')
        // ->generate(
        //     'Name : ' . ucwords($request->firstname) . ' ' . ucwords($request->middlename) . ' ' . ucwords($request->middlename) . '' .
        //     'Company : ' . ucwords($request->companyname) . '' .
        //     'Designation : ' . ucwords($request->designation) . '' . 
        //     'Email : ' . $request->email . '' .
        //     'Mobile Number' . $request->mobilenumber . ''  
        // , '../public/img/guest/'. $qrimagename);

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

        $user = User::find(Auth::user()->id);
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
                'email' => 'required|max:100|unique:guests, "email", ' . $id,
                'mobilenumber' => 'required|max:20',

                'companyname' => 'required|max:100',
                'designation' => 'required|max:50',
                'officetelnumber' => 'required|max:20',
                'officeaddress' => 'required|max:180',


                'idcard' => 'required|max:180|unique:guests, "idcard", ' . $id,
            ],
            [
                'lastname.required' => 'Lastname is required',
                'lastname.max' => 'Lastname must not be greater than 50',

                'middlename'=> 'Middlename must not be greater than 50',

                'firstname.required' => 'Firstname is required',
                'firstname.max' => 'Firstname must not be greater than 50',

                'email.required' => 'Email is required',
                'email.max' => 'Email must not be greater than 100',
                'email.unique' =>'Email is already taken',

                'mobilenumber.required' => 'Mobilenumber is required',
                'mobilenumber.max' => 'Mobilenumber must not be greater than 20',

                'companyname.required' => 'Company Name is required',
                'companyname.max' => 'Company Name must not be greater than 100',

                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation must not be greater than 50',

                'officetelnumber.required' => 'Office Tel Number is required',
                'officetelnumber.max' => 'Office Tel Number must not be greater than 20',

                'officeaddress.required' => 'Office Address is required',
                'officeaddress.max' => 'Office Address must not be greater than 180',

                'idcard.required' => 'RFID Card is required',
                'idcard.max' => 'RFID Card must not be greater than 180',
                'idcard.unique' => 'RFID Card is already taken',
            ]
        );

        $guest = Guest::find($id);
        
        $qrimagename = time() . '_' . $request->idcard . '.png';
        
        // RFID Only in QrCode
        QrCode::format('png')
        ->size(300)->errorCorrection('H')
        ->generate($request->idcard, '../public/img/guest/'. $qrimagename);
        
        // All guest data into QrCode
        // QrCode::format('png')
        // ->backgroundColor(34, 49, 63)
        // ->color(228, 241, 254)
        // ->size(300)
        // ->errorCorrection('H')
        // ->generate(
        //     'Name : ' . ucwords($request->firstname) . ' ' . ucwords($request->middlename) . ' ' . ucwords($request->middlename) . '' .
        //     'Company : ' . ucwords($request->companyname) . '' .
        //     'Designation : ' . ucwords($request->designation) . '' . 
        //     'Email : ' . $request->email . '' .
        //     'Mobile Number' . $request->mobilenumber . ''  
        // , '../public/img/guest/'. $qrimagename);
        
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

        $user = User::find(Auth::user()->id);
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
        
        $user = User::find(Auth::user()->id);
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
        $administratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'administrator');
            });
        })->get());
        $exhibitorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get());
        $registratorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'registrator');
            });
        })->get());
    	return view('event')
        ->withEvent($event)
        ->withAdministratorcount($administratorcount)
        ->withExhibitorcount($exhibitorcount)
        ->withRegistratorcount($registratorcount);
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
        
        $user = User::find(Auth::user()->id);
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
            return ucwords($user->firstname) . ' ' . ucwords($user->middlename) . ' ' . ucwords($user->lastname);
        })
        ->addColumn('action', function($subevent){
            return '
                <div class="btn-group" role="group">
                    
                    <form action="/admin/subevent/' . $subevent->id . '" method="get">
                        <button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>  
                    </form>

                    <form action="/admin/subevent/delete/' . $subevent->id . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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

        $user = User::find(Auth::user()->id);
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
        
        $user = User::find(Auth::user()->id);
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
        $subeventcount = count(Subevent::all());
        $exhibitorcount = count(User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get());
        return view('allsubevent')
        ->withSubeventcount($subeventcount)
        ->withExhibitorcount($exhibitorcount);
    }

    public function subevent_register_show()
    {
        $users = User::whereHas('role', function($role){
            $role->whereHas('access', function($access){
                $access->where('module', 'exhibitor');
            });
        })->get();
        return view('subevent_register')->withUsers($users);
    }

    public function subevent_register(Request $request)
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
        $subevent = new Subevent;
        
        if($request->hasFile('img'))
        {
            $background = $request->file('img');
            $filename = time() . '_' . $background->getClientOriginalName();
            Image::make($background)->save( public_path('/img/subevent/' . $filename) );
            $subevent->background = $filename;    
        }else{
            $subevent->background = 'sample.jpg';
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

        $user = User::find(Auth::user()->id);
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
        $walkin = count(Guest::where('type', 2)->get());
        $prereg = count(Guest::where('type', 1)->get());
        $total = $walkin + $prereg;
        $guestlogs = count(Eventlog::all());
        return view('admin')
        ->withWalkin($walkin)
        ->withPrereg($prereg)
        ->withTotal($total)
        ->withGuestlogs($guestlogs);
    }
    
}
