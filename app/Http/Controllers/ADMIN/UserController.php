<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
Use Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('admin.user.index'); // bikin file user yang berisi index di folder admin

        $datas = User::get();
        $title ="Data User";
        return view('admin.user.index', compact('datas', 'title')); //lempar data ke view pake compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New User";
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Alert::success('Success', 'Create New User Success');
        // alert()->info('Info','Password Belum Diisi');
        //toast posisi atas sebelah kanan
        // toast('Create New User Success','success');


        return redirect()->to('admin/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = User::find($id); //User mewakili table
        $title = "Edit User";
        return view('admin.user.edit', compact('edit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = User::find($id); //menemukan table dab ambil id-nya
        $update->name = $request->name; //ambil semua data yang mau diupdate
        $update->email = $request->email;
        if ($request->filled('password')) { //kondisi ketika password mau diubah tapi harus isi kolom password dlu, pake filled()
            $update->password = Hash::make($request->password);
        }

        $update->save();
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
    */

    //kalo make destroy makenya form buat eksekusi delete data, gk make a href, kalo make a href nanti bikin public function lagi
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        alert()->question('Question','Are you sure?');

        return redirect()->to('admin/user');
    }
}
