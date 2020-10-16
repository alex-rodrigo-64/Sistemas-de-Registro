<?php

namespace App\Http\Controllers;

use App\PersonalAcademico;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalAcademicoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $personal = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('personal_academicos.*','users.name','users.email','users.password','roles.name')
            ->get();
        
            $person = PersonalAcademico::all();

        return view('personalAcademico.index',['personal' => $personal],['person'=>$person]);
    }

    public function create()
    {
        $roles =Role::all();
        return view('personalAcademico.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personal = new PersonalAcademico();

        $personal->nombre = request('nombre');
        $personal->apellido = request('apellido');
        $personal->codigoSis = request('codigoSis');
        $personal->email = request('email');
        $personal->telefono = request('telefono');
        $personal->password = request('password');
        
        $personal->save();

        $usuario = new User();

        $usuario->name = request('nombre');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));
        
        $usuario->save();

    
        $roles = DB::table('personal_academicos')->where('email', request('email'))->first();


        $usuario->asignarRol($request->get('rol'));
        $usuario->asignarPersonal($roles->id);

        return redirect('/personalAcademico');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal=PersonalAcademico::findOrFail($id);
        $roles=Role::all();

        return view('personalAcademico.edit',compact('personal','roles')); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $personal = PersonalAcademico::FindOrFail($id);

        $personal->nombre = request('nombre');
        $personal->apellido = request('apellido');
        $personal->codigoSis = request('codigoSis');
        $personal->email = request('email');
        $personal->telefono = request('telefono');
        $personal->password = request('password');
        
        $personal->update();





        return redirect('/personalAcademico');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
