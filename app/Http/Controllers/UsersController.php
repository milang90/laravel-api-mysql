<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $users = Users::all();
        $response = [
            'status' => 200,
            'data' => $users,
            'message' => 'Se han encontrado '.count($users).' resultados'
        ];
        return response()->json(
            $response,
            $response['status']
        );
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function search(Request $request)
    {
        $search = $request->input('q');
        $users = Users::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->get();

        $response = [
            'status' => 200,
            'data' => $users,
            'message' => 'Se han encontrado '.count($users).' resultados'
        ];
        return response()->json(
            $response,
            $response['status']
        );
    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $response = [
            'status' => 422,
            'message' => 'Error en envío de datos'
        ];

        $name  = $request->name ? $request->name : null;
        $email = $request->email ? $request->email : null;
        if($name == null){
            $response['erros']['name'] = 'El campo nombre es requerido';
        }
        if($email == null){
            $response['erros']['email'] = 'El campo email es requerido';
        }

        if($name && $email){
            $search = Users::where('email', $email)->count();
            if(!$search){
                $users = new Users();
                $users->name = $name;
                $users->email = $email;
                if($users->save()){
                    $data = Users::where('email', $email)->get();
                    $response['status'] = 201;
                    $response['data'] = $data;
                    $response['message'] = 'Se ha creado un nuevo registro';
                }else{
                    $response['status'] = 500;
                    $response['message'] = 'No se pudo crear el nuevo registro';
                }
            } else{
                $response['erros']['email'] = 'El email ya está siendo utilizado';
            }                    
        }

        return response()->json(
            $response,
            $response['status']
        );
    }

    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function show(Request $request)
    {
        $response = [
            'status' => 422,
        ];

        if($request->id){
            $search = Users::where('id', $request->id)->count();
            if($search){
                $users = Users::find($request->id);
                $response['data'] = $users;
                $response['status'] = 200;
                
            }else{
                $response['message'] = 'No existe el usuario que buscas';
                $response['status'] = 404;
            }
        }else{
            $response['message'] = 'Error en envío de datos';
        }
        
        return response()->json(
            $response,
            $response['status']
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Request $request){
        $response = [
            'status' => 422,
            'message' => 'Error en envío de datos'
        ];

        $name  = $request->name ? $request->name : null;
        $email = $request->email ? $request->email : null;
        $id = $request->id ? $request->id : null;

        if($id == null){
            $response['erros']['id'] = 'El campo id es requerido';
        }
        if($name == null){
            $response['erros']['name'] = 'El campo nombre es requerido';
        }
        if($email == null){
            $response['erros']['email'] = 'El campo email es requerido';
        }

        if($name && $email && $id){
            $search = Users::where('id', $id)->count();;
            if($search){
                $searchEmail = Users::where('email', $email)->where('id', '<>', $id)->count();
                if(!$searchEmail){
                    $data = Users::find($id);
                    $data->name = $name;
                    $data->email = $email;
                    if($data->save()){
                        $response['status'] = 200;
                        $response['data'] = $data;
                        $response['message'] = 'Se ha modificado el registro';
                    }else{
                        $response['status'] = 500;
                        $response['message'] = 'No se pudo modificar el registro';
                    }
                } else{
                    $response['erros']['email'] = 'El email ya está siendo utilizado';
                }
            }else{
                $response['message'] = 'No existe el usuario que buscas';
                $response['status'] = 404;
            }                   
        }
        
        return response()->json(
            $response,
            $response['status']
        );
    }

    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function delete(Request $request){
        $response = [
            'status' => 422,
        ];

        if($request->id){
            $search = Users::where('id', $request->id)->count();
            if($search){
                $users = Users::find($request->id);
                if($users->delete()){
                    $response['status'] = 200;
                    $response['message'] = 'El registro ha sido borrado';
                }else{
                    $response['status'] = 500;
                    $response['message'] = 'No se pudo borrar el registro';
                }                
            }else{
                $response['message'] = 'No existe el usuario que buscas';
                $response['status'] = 404;
            }
        }else{
            $response['message'] = 'Error en envío de datos';
        }
        
        return response()->json(
            $response,
            $response['status']
        );
    }

}
