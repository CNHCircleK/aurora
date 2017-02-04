<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->authorize('create', User::class);
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $request->all();

        if ($request->input('generate_pw')) {
        	$randomPw = str_random();
        	$data['password'] = $randomPw;
        	$data['password_confirmation'] = $randomPw;
        }

	    Validator::make($data, [
		    'name'     => 'required|max:255',
		    'email'    => 'required|email|max:255|unique:users',
		    'password' => 'required|min:6|confirmed',
		    'invitation_code' => 'required|exists:invites,token'
	    ]);

        $user = User::create($data);

        if ($user->id) {
        	if ($randomPw) {
		        return redirect()->back()->withMessage("User created! Password is {$randomPw}");
	        }
	        else {
		        return redirect()->back()->withMessage('User created!');
	        }
        }
        else {
        	return redirect()->back()->with('error-message', 'Could not create user!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    	$this->authorize('update', $user);

	    $this->validate($request, [
		    'name'     => 'required|max:255',
		    'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
		    'password' => 'min:6|confirmed',
	    ]);
    	$user->save();

        return redirect()->back()->withMessage('Your user settings have been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
