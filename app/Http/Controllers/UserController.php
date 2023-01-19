<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Countrie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Mail;
use App\Mail\NotifyMail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categorias = Categoria::all();
        $countries  = Countrie::all();
        $users = User::when($request->search, function ($q) use ($request) {
            return $q->where('nombres', 'like', '%' . $request->search . '%')
                    ->orwhere('apellidos', 'like', '%' . $request->search . '%')
                    ->orwhere('identificacion', 'like', '%' . $request->search . '%')
                    ->orwhere('celular', 'like', '%' . $request->search . '%');
        })->when($request->categoria_id, function ($q) use ($request) {
            return $q->where('categoria_id', $request->categoria_id);
        })->when($request->countrie_id, function ($q) use ($request) {
            return $q->where('countrie_id', $request->countrie_id);
        })->get();

        return view('dashboard.users.index', compact('users', 'categorias', 'countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        $countries  = Countrie::all();
        return view('dashboard.users.create', compact('categorias', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //code...
        $request->validate([
            'identificacion'    => 'required|unique:users',
            'nombres'           => 'required|alpha|min:5|max:100',
            'apellidos'         => 'required|alpha|min:1|max:100',
            'celular'           => 'required|integer|digits:10',
            'direccion'         => 'required|max:180',
            'categoria_id'      => 'required|exists:categorias,id',
            'countrie_id'       => 'required|exists:countries,id',
            'email'             => 'required|email|unique:users|max:150',
            'password'          => 'required|confirmed',
        ]);

        $requestData = $request->except(['password', 'password_confirmation']);
        $requestData['password'] = bcrypt($request->password);

        // Creando user
        try {
            //code...
            $user = User::create($requestData);

            if($user){
                // Send mail registro existoso
                $mailData = [
                    'title' => 'Nuevo Registro',
                    'body' => 'Usted Se ha registrado exitosamente.',
                    'tipo' => 0
                ];
                Mail::to($requestData['email'])->send(new NotifyMail($mailData));
                // send mail usuarios admin

                $users          = User::all();
                $countries      = Countrie::all();
                $categorias     = Categoria::all();
                $mailData = [
                    'title' => 'Reporte de Usuarios',
                    'body' => 'Total Usuarios Registrados '. $users->count(),
                    'tipo' => 1,
                    'countries' => $countries,
                    'categorias' => $categorias,
                ];
                $userAdmins = User::whereCategoriaId(1)->get();
                foreach ($userAdmins as $key => $userAdmin) {
                    # code...
                    Mail::to($userAdmin->email)->send(new NotifyMail($mailData));
                }

                // Notificacion
                session()->flash('success', __('Usuario agregado con exito'));
            }else{
                // Notificacion
                session()->flash('error', __('Usuario No registrado con exito'));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        // Redireccion
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function change()
    {
        //
        return view('dashboard.users.change');
    }

    public function changeuser(Request $request)
    {
        //
        // buscamos el usuario
        $user = User::whereIdentificacion($request['identificacion'])->first();

        if($user && Hash::check($request['password'], $user->password) )
        {
            // The passwords match...
            // actualizamos el correo
            $user->update([
                'email' =>  $request['new_email']
            ]);

            // Notificacion
            session()->flash('success', __('Usuario actualizado con exito'));
            // Redireccion
            return redirect()->route('users.index');
        }else{

            // Notificacion
            session()->flash('success', __('Datos Incorrectos'));
            // Redireccion
            return redirect()->route('users.change');
        }
    }
}
