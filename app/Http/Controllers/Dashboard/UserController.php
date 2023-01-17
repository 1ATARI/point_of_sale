<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\user;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'image' => 'image',
                'password' => 'required|confirmed',
                'permissions'=>'required|min:1',
            ]);


            $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
            $request_data['password'] = bcrypt($request->password);

            if ($request->image) {

                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_image/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();

            }
            $user = User::create($request_data);
            $user->attachRole('admin');
            $user->syncPermissions($request->permissions);


            Flasher::addSuccess(trans('messages.success'));
            return redirect()->route('dashboard.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {


        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {


            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required' ,Rule::unique('users')->ignore($user->id)],
                'image' => 'image',

                'permissions'=>'required|min:1',


            ]);
            $request_data = $request->except(['password', 'password_confirmation','permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);


        if ($request->image) {
                if ($user->image != 'default.png') {

                    Storage::disk('public_uploads')->delete('/users_image/' . $user->image);
                }


                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_image/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();

            }

            $user->update($request_data);
            $user->syncPermissions($request->permissions);
            Flasher::addSuccess(trans('messages.Update'));
            return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/users_image/' . $user->image);
        }


        //
        $user->delete();
        Flasher::addSuccess(trans('messages.Delete'));

        return redirect()->route('dashboard.users.index');
    }
}
