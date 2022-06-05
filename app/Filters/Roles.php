<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class Roles implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->is_logged){
            return redirect()->route('login')->with('msg',[
                'type' => 'warning',
                'body' => 'Debes iniciar sesión primero',
            ]);
        }

        $model = model('UsuarioModel');

        if(!$usuario=$model->buscarUsuario('idUsuario',session()->idUsuario)){
            session()->destroy();
            return redirect()->route('login')->with('msg',[
                'type' => 'danger',
                'body' => 'Usuario no disponible'
            ]);
        }
        if($usuario->estado == 0){
            session()->destroy();
            return redirect()->route('login')->with('msg',[
                'type' => 'danger',
                'body' => 'Usuario no disponible'
            ]);
        }

        $model->buscarRol($usuario->idRol);
        if(!in_array($model->asignarVistaRol,$arguments)){
            throw PageNotFoundException::forPageNotFound();
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}