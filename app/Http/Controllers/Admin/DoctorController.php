<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;



use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  


    public function index()
    {
        $doctors  = User::doctors ()->get();
       
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $specialties=Specialty::all();
        return view('doctors.create',compact('specialties'));
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $rules=[
            
            'name'=>'required|min:3',
            'email'=>'required|email',
            'dni'=>'nullable|digits:8',    
            'address'=>'required|min:5',     
            'phone'=>'required|min:8'
          
          ];
         
          $this->validate($request,$rules);
         
        $user=User::create(
            $request->only('name','email','dni','address','phone')
            +[
                'role'=>'doctor',
                'password'=>bcrypt($request->input('password'))
            ]
          );
          //attach siempre crea nueva relaciones
          $user->specialties()->attach($request->input('specialties'));
          $notification='el medico se ha registrado correctamente';
        return redirect('/doctors')->with(compact('notification'));

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
        
        $doctor=User::doctors()->findOrFail($id);
        $specialties=Specialty::all();
        //debemos especificar q id de q tabla se necesita en este caso del id de especialidades
        $specialty_ids=$doctor->specialties()->pluck('specialties.id');
    return view('doctors.edit', compact('doctor','specialties','specialty_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            
            'name'=>'required|min:3',
            'email'=>'required|email',
            'dni'=>'nullable|digits:8',    
            'address'=>'required|min:5',     
            'phone'=>'required|min:8'
          
          ];
         
          $this->validate($request,$rules);
          $user=User::doctors()->FindOrFail($id);
          $data= $request->only('name','email','dni','address','phone');
          $password=$request->input('password');
          //se actualiza la contraseña en caso de haberse cambiado
          if($password)
            $data['password']=bcrypt($password);
          $user->fill($data);
          $user->save();
          $user->specialties()->sync($request->input('specialties'));
          $notification='el medico se ha registrado correctamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(User $doctor)
    {
        $deletedDoctor=$doctor->name;
        $doctor->delete();
        $notification='la especialidad ' . $deletedDoctor . ' se ha eliminado correctamente';
      
        return redirect('/doctors')->with(compact('notification'));
    }

    

}
