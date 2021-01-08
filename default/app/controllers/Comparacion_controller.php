<?php 
Load::models('Comparacion');
class ComparacionController extends AppController{
	public function index ($page=1){
		$cl=new Comparacion();
		$this->listComparacion=$cl->getComparacion($page);
	}
	public function Validaradmin (){
		return Redirect::to("Cliente/login/");
	}
	public function Comparar (){
		//Flash::Valid("Comparar Ganancias de Servicios y Productos");
		$date = new Date();
		
		if(Input::hasPost('Comparacion'))
		{
			$us = new Comparacion(Input::post('Comparacion'));
			if($us->fechaDesde>$date || $us->fechaDesde<'1990-01-01'){
				Flash::Error('Error fecha Inicio');
			}else{
				if($us->fechaHasta>$date || $us->fechaHasta<'1990-01-01'){
					Flash::Error('Error fecha Final');
				}else{
					$sql=new Pago();
					$vsql= new Compra();
					$sumaServicio=$sql->sum("totalPago","conditions: (fecha>='$us->fechaDesde' && fecha<='$us->fechaHasta')");
					$sumaProducto=$vsql->sum("totalPago","conditions: (fecha>='$us->fechaDesde' && fecha<='$us->fechaHasta')");
					if($us->create()) 
					{
						if(is_null($us->idComparacion)==true ||is_null($sumaServicio)==true ||is_null($sumaProducto)==true){
							Flash::Error("No hay suficientes datos para comparar");
						}else{
							Input::delete();//Limpia los campos del input
							return Redirect::to("Comparacion/VistaComparar/'$us->idComparacion'/'$sumaServicio'/'$sumaProducto'");
						}	
					}else
					{
						Flash::Error('Fallo en la Operacion');
						
					}					
				}					
			}
		}					
	}

	
	public function VistaComparar ($id, $sql, $vsql){
		if(is_null($id)==true ||is_null($sql)==true ||is_null($vsql)==true){
			Flash::Error("No hay suficientes datos para comparar");
		}else{
			$cl=new Comparacion();
			$this->listComparacion=$cl->find($id);
			$this->idc=$id;
			$this->listsql=$sql;
			$this->vsql=$vsql;
		}

	}	
	public	function	ProductoServicioVendido(){
		$date = new Date();
		$us = new Comparacion(Input::post('Comparacion'));
		if(Input::hasPost('Comparacion'))
		{
			if($us->fechaDesde>$date || $us->fechaDesde<'1990-01-01'){
				Flash::Error('Error fecha Inicio');
			}else{
				if($us->fechaHasta>$date || $us->fechaHasta<'1990-01-01'){
					Flash::Error('Error fecha Final');
				}else{
					//$contrato= new Contrato();
					//$Ccontrato	= new Contrato();
					$pago=new Pago();					
					$Ppago= new Pago();
					$compra=new Compra();
					$Ccompra= new Compra();
					
					//El Servicio que mas se repite 
					
					/*$Ppago=$pago->find_by_sql("Select  Servicio.idServicio, Servicio.nombre from  Servicio  
						INNER JOIN Pago ON Servicio.idServicio= Pago.idServicio
						WHERE (Pago.fecha>=$us->fechaDesde AND Pago.fecha<=$us->fechaHasta)	
						GROUP BY Servicio.nombre 
						ORDER BY COUNT(Pago.idServicio) DESC");*/
					$Ppago=$pago->find_by_sql("Select  Servicio.idServicio, nombre from  Servicio  
						INNER JOIN Pago ON Servicio.idServicio= Pago.idServicio
						WHERE (Pago.fecha>='$us->fechaDesde' AND Pago.fecha<='$us->fechaHasta')
						GROUP BY Servicio.nombre 
						ORDER BY COUNT(Pago.idServicio) DESC");

					$Ccompra=$compra->find_by_sql("Select Producto.idProducto, nombre from Producto 
						INNER JOIN Compra ON Producto.idProducto= Compra.idProducto
						WHERE (Compra.fecha>='$us->fechaDesde' AND Compra.fecha<='$us->fechaHasta') 
						GROUP BY Producto.nombre 
						ORDER BY COUNT(Compra.idProducto) DESC");
					



					$sql=new Pago();
					$vsql= new Compra();
					
					$sumaServicio=$sql->sum("totalPago","conditions: idServicio='$Ppago->idServicio'");
					$sumaProducto=$vsql->sum("totalPago","conditions: idProducto='$Ccompra->idProducto'");



					if($us->create()) 
					{
						//Flash::Valid('Operacion Exitosa');
						Input::delete();//Limpia los campos del input
						if(is_null($us->idComparacion)==true ||is_null($sumaServicio)==true ||is_null($sumaProducto)==true||is_null($Ppago->nombre)==true||is_null($Ccompra->nombre)==true){
							Flash::Error("No hay suficientes datos para comparar");
						}else{
							return Redirect::to("Comparacion/VistaProductoServicioVendido/'$us->idComparacion'/'$sumaServicio'/'$sumaProducto'/$Ppago->nombre/$Ccompra->nombre");

						}

					}else
					{
						Flash::Error('Fallo en la Operacion');
						
					}					
				}					
			}
		}
	}
	public function VistaProductoServicioVendido ($id, $sql, $vsql,$servicio,$producto){

		if(is_null($id)==true ||is_null($sql)==true ||is_null($vsql)==true||is_null($servicio)==true||is_null($producto)==true){
			Flash::Error("No hay suficientes datos para comparar");
		}else{
			$cl=new Comparacion();
			$this->listComparacion=$cl->find($id);
			$this->idc=$id;
			$this->listsql=$sql;
			$this->vsql=$vsql;
			$this->listservicio=$servicio;
			$this->listproducto=$producto;
		}	
	}	
	
	public function del ($id)
	{
		//$id=4;	
		$us =new Comparacion();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Comparacion/index/');
	}			
}	
?>