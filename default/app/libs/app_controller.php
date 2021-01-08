<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todos las controladores heredan de esta clase en un nivel superior
 * por lo tanto los métodos aquií definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
abstract class AppController extends Controller
{
	//public $sesion;
	/*
	public $acl;
	public $useRol= "";

*/
    final protected function initialize()
    {
    	/*
    	if(Auth::is_valid()) $this->userRol = Auth::get("rol");
	 	//throw new KumbiaException("el rol es  ");
		$this->acl = new Acl();
		//Se agregan los roles
		$this->acl->add_role(new AclRole("")); // Visitantes
		$this->acl->add_role(new AclRole("A")); // Administradores
		$this->acl->add_role(new AclRole("U")); // Usuarios
		
		//Se agregan los recursos
		$this->acl->add_resource(new AclResource("Cliente_controller"), "index");
		//$this->acl->add_resource(new AclResource("test"), "index");
		
		//Se crean los permisos
		 // Inicio
		$this->acl->allow("", "Cliente_controller", array("index"));
		$this->acl->allow("A", "Cliente_controller", array("index"));
		 // Test
		//$this->acl->allow("U", "test", array("index"));








    	//DESCOMENTAR IF***********************
		if(Auth::is_valid()) $this->userRol = Auth::get("rol");
				
			$this->acl = new Acl();
			//Se agregan los roles
			//$this->acl->add_role(new AclRole("")); // Visitantes
			$this->acl->add_role(new AclRole("admin")); // Administradores
			$this->acl->add_role(new AclRole("user")); // Usuarios
			
			//Se agregan los recursos
			$this->acl->add_resource(new AclResource("Cliente_controller"), "index");
			//$this->acl->add_resource(new AclResource("test"), "index");
			
			//Se crean los permisos
			 // Inicio
			//$this->acl->allow("", "Cliente_controller", array("index"));
			$this->acl->allow("admin", "Cliente_controller", array("index"));
			 // Test
			//$this->acl->allow("U", "test", array("index"));*/
			
    }

    final protected function finalize()
    {
        
    }

}
