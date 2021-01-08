<?php 
Load:: models('CompraProducto');
class CompraProductoController extends AppController{
	public function index ($page=1){
		$cl = new CompraProducto();
		$this->listCompraProducto= $cl->getCompraProducto($page);	
	
	}
	//AQUI VA UNA NUEVA FUNCION QUE SE LLAMA COMPRAR, QUE TRAE EL ID DEL PRODUCTO A COMPRAR QUE SE TRAE DE LA OTRA TABLA
	public function create ()
	{			

		if(Input::hasPost('CompraProducto'))
		{
			$us = new CompraProducto(Input::post('CompraProducto'));
			if($us->create())
			{
				//Flash::Valid($us->nombreCliente);
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to("CompraProducto/index/");
			}else
			{
				Flash::Error('Fallo en la Operacion');
				return Redirect::to("CompraProducto/create/");
			}

		}
	}	
	public function Edit($id)
	{
		//$id=5;
		/*settype($id, 'string');
		Flash::Valid($id);*/
		
		$us= new CompraProducto();

		if(Input::hasPost('CompraProducto'))
		{
			//Flash::Valid('Entraste if');
			if($us->update(Input::post ('CompraProducto')))
			{	
				Flash::Valid('Operacion editar exitosa');

				return Redirect::to("CompraProducto/index/");//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{
			//Flash::Valid('Entraste else');
			$this -> CompraProducto = $us-> find ( (int) $id); 
		}
		
		
	}

	public function del ($id)
	{
		//$id=4;	
		$us =new CompraProducto();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('CompraProducto/index/');
	}	

}
?>