<?php 
//mysql_connect()
Load:: models('Cliente');
class ClienteController extends AppController{
	//public $limit_params = FALSE;


	public function index ($page=1, $var){
		if($var=='$p'){
			/*settype($var, 'string');
			Flash::Valid($var);
			Flash::Valid("Entro index1");*/
			Flash::Error('Iniciar Sesion');
			Redirect::to("Cliente/login");
			
		}else{


			$cl = new Cliente();
			$this->listCliente= $cl->getCliente($page);		
		}
		//$cl = new Cliente();
		//$this->listCliente= $cl->getCliente($page);	
	}

	public function login(){
		$cl = new Cliente();
		$Ncl = new Cliente();
		//Flash::Valid("CHAOOO");
        if (Input::hasPost("email","password")){
        	//Flash::Valid("NORMAL");
            $pwd = Input::post("password");
            $usuario=Input::post("email");
            
            $auth = new Auth("model", "class: Cliente", "email: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
            	//settype($usuario, 'string');
            	//Flash::Valid($usuario);
				$Ncl= $cl->find_by_sql("Select Cliente.rol from Cliente where Cliente.email = '$usuario'");
				//Flash::Valid($cl->rol);
				/*$usuario = $this -> Cliente->find_by_sql("select * from usuarios 
                                  where codigo not in (select codigo 
                                        from ingreso) limit 1");*/
                 //Flash::Valid($Ncl->rol);                       
            	//Flash::Valid("Entraste");
                if($Ncl->rol=='A'){
                	return Redirect::to("Comparacion/index/");
                }else{
	            	return Redirect::to("Cliente/index/1/'$Ncl->rol'");
                }                        


               // Router::redirect("index");
            } else {
                Flash::error("Usuario y Contrasena Inconrrectos ");
            }
        }
    }


	
	public function create ()
	{			
		$cl = new Cliente();
		$Ncl = new Cliente();
		$date = new Date();
		if(Input::hasPost('Cliente'))
		{
			$us = new Cliente(Input::post('Cliente'));
			if($us->fechaNacimiento>$date || $us->fechaNacimiento<'1900-01-01'){
				Flash::Error('Error fecha ');
			}else{
			
				if($us->create())
				{
					Flash::Valid($us->nombreCliente);
					Flash::Valid('Operacion Exitosa');
					$Ncl= $cl->find_by_sql("Select Cliente.rol from Cliente where Cliente.nombreCliente = '$us->nombreCliente'");
					Input::delete();//Limpia los campos del input
					return Redirect::to("Cliente/index/1/$Ncl->rol");
				}else
				{
					Flash::Error('Fallo en la Operacion');
				}
				
			}
		}
	}
	public function Edit($id)
	{
		//$id=5;
		/*settype($id, 'string');
		Flash::Valid($id);*/
		
		$cl = new Cliente();
		$Ncl = new Cliente();	
		$us= new Cliente();

		if(Input::hasPost('Cliente'))
		{
			//Flash::Valid('Entraste if');
			if($us->update(Input::post ('Cliente')))
			{	
				Flash::Valid('Operacion editar exitosa');
				$Ncl= $cl->find_by_sql("Select Cliente.rol from Cliente where Cliente.nombreCliente = '$us->nombreCliente'");
				return Redirect::to("Cliente/index/1/$Ncl->rol");//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{

			$this -> Cliente = $us-> find ( (int) $id); 
		}
		
		
	}
	public function del ($id)
	{
		//$id=4;	
		$us =new Cliente();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Cliente/index/1/U');
	}





}

?>