<?php 

Load:: models('usuario');

class UsuarioController extends AppController{
	public function index($page=1){
		$us = new Usuario();
		$this->listUsuario = $us->getUsuario($page);
	}

	//el page=1 va en index normalmente
	/*public function login(){	
        if (Input::hasPost("email","password")){
            $pwd = Input::post("password");
            $usuario=Input::post("email");

            $auth = new Auth("model", "class: Usuario", "email: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
            	Flash::Valid($pwd);
            	Flash::Valid($usuario);
            	//return Redirect::to("usuario/index");
                //Router::redirect();
            } else {
                Flash::error("Falló");
            }
        }
    }*/

   /* public function login(){
        if (Input::hasPost("login","password")){
            $pwd = Input::post("password");
            $usuario=Input::post("login");

            $auth = new Auth("model", "class: usuarios", "login: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
                Router::redirect("principal/index");
            } else {
                Flash::error("Falló");
            }
        }
    }
    
	*/

	public function login(){
        if (Input::hasPost("email","password")){
            $pwd = Input::post("password");
            $usuario=Input::post("email");

            $auth = new Auth("model", "class: usuario", "email: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
            	Flash::error("Entraste");
            	return Redirect::to("usuario/index");
               // Router::redirect("index");
            } else {
                Flash::error("Falló");
            }
        }
    }



	public function create ()
	{
		if(Input::hasPost('usuario'))
		{
			$us = new Usuario(Input::post('usuario'));
			if($us->create())
			{
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to();
			}else
			{
				Flash::Error('Fallo en la Operacion');
			}

		}
	}

	public function Edit($id)
	{
		//$id=5;
		settype($id, 'string');
		Flash::Valid($id);
		$us= new Usuario();
		if(Input::hasPost('usuario'))
		{
			Flash::Valid('Entraste if');
			if($us->update(Input::post ('usuario')))
			{	
				Flash::Valid('Operacion editar exitosa');
				return Redirect::to();//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{
			Flash::Valid('Entraste else');
			$this -> usuario = $us-> find ( (int) $id); 
		}
	}

	public function del ($id)
	{
		//$id=4;	
		$us =new Usuario();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to();
	}


}


?>
