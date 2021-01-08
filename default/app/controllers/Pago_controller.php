<?php 
Load::models('Pago');
class PagoController extends AppController{
	public function index ($page=1){
		$cl = new Pago();
		$this->listPago= $cl->getPago($page);	
	
	}	
	public function pagar ($id){
		
		$var1= new Pago();
		$var2= new Contrato();
		$idClienteAuto= new Pago();
		$date = new Date();
		//Trae el id del cliente del auto del que tiene el contrato
		/*$idClienteAuto= $var1->find_by_sql("Select Auto.idCliente from Auto 
			INNER JOIN (Contrato INNER JOIN Pago ON Contrato.idContrato=Pago.idContrato where Contrato.idContrato= '$id') ON Auto.idAuto= Contrato.idAuto where Contrato.idAuto= Auto.idAuto ");*/
		$idClienteAuto= $var1->find_by_sql("Select Auto.idCliente from Auto 
			INNER JOIN Contrato ON Auto.idAuto= Contrato.idAuto where Contrato.idContrato= '$id'");
		//Trae el nombre del cliente 
		$this-> listvar1= $var1->find_by_sql("Select Cliente.idCliente, Cliente.nombreCliente from Cliente
			LEFT OUTER JOIN Pago ON Cliente.idCliente= Pago.idCliente where Cliente.idCliente= '$idClienteAuto->idCliente' ");
		//ID del contrato
		$this-> listvar2= $id;
		$this-> listvar3= $var2->find_by_sql(" Select Servicio.nombre, Servicio.precio , Servicio.idServicio from Servicio 
			INNER JOIN Contrato ON Servicio.idServicio= Contrato.idServicio where Contrato.idContrato='$id' ");
		if(Input::hasPost('Pago'))
		{
			$us = new Pago(Input::post('Pago'));
			if($us->fecha>$date || $us->fecha<'1990-01-01'){
				Flash::Error('Error fecha ');
			}else{
				if($us->create()) 
				{
					Flash::Valid('Operacion Exitosa');
					Input::delete();//Limpia los campos del input
					
					return Redirect::to("Pago/index/");
				}else
				{
					Flash::Error('Fallo en la Operacion');
					
				}
			}			
		}
			



	}
	public function del ($id)
	{
			//$id=4;	
		$us =new Pago();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Pago/index/');
	}
}
?>