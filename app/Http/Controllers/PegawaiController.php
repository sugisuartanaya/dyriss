<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    
    public function index()
    {
        $employee = User::where('role', 0)->get();

        return view('pegawai.index',[
            'title' => 'Pembeli',
            'active' => 'active',
            'employee' => $employee
        ]);
    }

    
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Session::flash('success', 'Pegawai berhasil ditambahkan.');

        return redirect('/pegawai');
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        Session::flash('update', 'Berhasil update data pegawai');

        return redirect('/pegawai');
    }

    
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('success', 'Berhasil hapus data pegawai');
        return redirect('/pegawai');
    }
}
