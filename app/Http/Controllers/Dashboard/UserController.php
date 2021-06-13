<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_read')->only(['index','show']);
        $this->middleware('permission:users_create')->only(['create','store']);
        $this->middleware('permission:users_update')->only(['edit','update']);
        $this->middleware('permission:users_delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($q) use ($request) {
                return $q->where('first_name','like','%'.$request->search.'%')
                    ->orWhere('last_name','like','%'.$request->search.'%');
            })
            ->whereRoleIs('admin')
            ->get();
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.form.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name = 'no-img.jpg';
        if ($request->has('image')){
            $image_name = $request->image->hashName();
            ImageManagerStatic::make($request->image)
                ->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('uploads/user_images/'.$image_name));
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->e_mail,
            'password' => bcrypt($request->password),
            'image' => $image_name,
        ]);

        $user->attachRole('admin');
        $user->syncPermissions($request->permission);

        Session::flash('success',__('message.new user'));
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.form.index',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $password = $user->password;
        if ( !is_null($request->password) )
            $password = bcrypt($request->password);

        if ($request->has('image')){

            if ($user->image !== 'no-img.jpg')
                Storage::disk('public_uploads')->delete('user_images/'.$user->image);

            $image_name = $request->image->hashName();
            ImageManagerStatic::make($request->image)
                ->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('uploads/user_images/'.$image_name));
        }else{
            $image_name = $user->image;
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->e_mail,
            'password' => $password,
            'image' => $image_name,
        ]);
        $user->syncPermissions($request->permission);
        Session::flash('success',__('message.edit user'));
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->image !== 'no-img.jpg')
            Storage::disk('public_uploads')->delete('user_images/'.$user->image);
        $user->delete();
        Session::flash('success',__('message.delete user'));
        return redirect()->route('dashboard.user.index');
    }
}
