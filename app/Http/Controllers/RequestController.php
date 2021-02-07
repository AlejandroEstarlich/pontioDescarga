<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HTTPFoundation\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use App\Models\Solicitud;
use App\Models\User;

class RequestController extends Controller
{

	public function createRequest(){
    	return view('request.createRequest');
    }
    // Crear nueva petición
    public function saveRequest(Request $request){
    	// Validar Formulario
    	$validatedData=$this->validate($request, [
    		'street'  => 'required',
    		'cp' => 'required',
    		'city' => 'required',
    		'state' => 'required',
    		'country' => 'required',
    		'pago_mensual' => 'required',
    		'potencia_contratada' => 'required',    		
    		'name' => 'required',	
    		'surname' => 'required',	
    		'phone' => 'required',	
    		'email' => 'required',	
    	]);

    	// Damos de alta el usuario y lo logueamos
    		// Validar qué forma sería mejor de hacerlo, dependería de si la cuenta del usuario se borra automáticamente después de haber completado la instalación.
    			// Forma 1
    	// $user = new User();
     //        $request->name = $request->input('surname');
     //        $request->surname = $request->input('email');
     //        $request->email = $request->input('email');
     //        $request->phone = $request->input('phone'); 
     //        $request->password = Hash::make($request->input('name'));
     //    $user->save();

        		// Forma 2
        $userExist = User::where('email', '=', $request->input('email'))->first();
        if ($userExist === null) {
            Auth::login($user = User::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('name')),
                'role' => 'ROLE_USER'
            ]));

            event(new Registered($user));

            // Generamos la solicitud
            $solicitud = new Solicitud();
            $user = \Auth::user();
                    // Forma 1
            $solicitud->user_id = $user->id;
                    // Forma 2
            //  $request->user_id = $request->id;
                $solicitud->street = $request->input('street');
                $solicitud->cp = $request->input('cp');
                $solicitud->city = $request->input('city');
                $solicitud->state = $request->input('state');
                $solicitud->country = $request->input('country');
                $solicitud->pago_mensual = $request->input('pago_mensual');
                $solicitud->potencia_contratada = $request->input('potencia_contratada');
                $solicitud->potencia_instalada = $request->input('potencia_instalada');
                $solicitud->numero_paneles = $request->input('numero_paneles');
                $solicitud->superficie_necesaria = $request->input('superficie_necesaria');
                $solicitud->ahorro_anual = $request->input('ahorro_anual');
                $solicitud->co2_evitado = $request->input('co2_evitado');
                $solicitud->arboles_plantados = $request->input('arboles_plantados');

            $solicitud->save();

            $passExist = User::where('password', '=', Hash::make($request->input('name')))->first();
                if ($passExist === null) {
                    return redirect()->route('login')->with(array(
                        "message" => 'Correo electrónico ya en uso'
                    ));
                } else {
                    return redirect()->route('dashboard')->with(array(
                        "message" => 'Solicitud enviada correctamente'
                    ));
                }
        } else {
            return redirect()->route('dashboard')->with(array(
                "message" => 'Ya tienes una solicitud en trámite'
            ));
        }
        
    }

}
