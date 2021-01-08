<?php 
Load:: models('Compra');
class CompraController extends AppController{
	public function index ($page=1){
		$cl = new Compra();
		$this->listCompra= $cl->getCompra($page);	
	
	}
	//AQUI VA UNA NUEVA FUNCION QUE SE LLAMA COMPRAR, QUE TRAE EL ID DEL PRODUCTO A COMPRAR QUE SE TRAE DE LA OTRA TABLA

	public function comprar ($id){
		/*$this-&gt;resultado = $this-&gt;Categories-&gt;find_all_by_sql('SELECT * FROM categories INNER JOIN categoriesdescription ON categories&#46;id = categoriesdescription&#46;categories_id AND categories&#46;parent_id='&#46;$this-&gt;parent_id&#46;' ORDER BY '&#46;$this-&gt;ordenar&#46;' '&#46;$this-&gt;tipoDeOrden); */
		$var1= new Compra();
		$var2= new Compra();
		$var3= new Compra();
		$date = new Date();
		$this ->listvar1 = $var1->find_by_sql("Select Producto.idProducto, Producto.nombre from Producto 
			LEFT OUTER JOIN Compra ON  Producto.idProducto = Compra.idProducto Where Producto.idProducto= '$id' ");
		$this ->listvar2 = $var2->find_by_sql("Select Cliente.idCliente, nombreCliente from Cliente 
			LEFT OUTER JOIN Compra ON Cliente.idCliente = Compra.idCliente ");
		$this ->listvar3 = $var3->find_by_sql("Select Producto.precio from Producto
			LEFT OUTER JOIN Compra ON Producto.idProducto = Compra.idProducto where Producto.idProducto= '$id'");

		if(Input::hasPost('Compra'))
		{
			$us = new Compra(Input::post('Compra'));
			if($us->fecha>$date || $us->fecha<'1990-01-01'){
				Flash::Error('Error fecha ');
			}else{
				$cant= $us->cantidad;
				$var4 = new Compra();
				$stock = new Compra();
				if($cant<0){
					Flash::Error('Cantidad erronea');
				}else{
					$stock= $var3->find_by_sql("Select Producto.stock from Producto
						LEFT OUTER JOIN Compra ON Producto.idProducto = Compra.idProducto where Producto.idProducto= '$id'");
					if($stock->stock>=0){
						if(($stock->stock-$cant)>=0){
							if($us->create()) 
							{
								$lvar= $us->totalPago;

								$pagoTotal=(($lvar*$cant));

								$Nstock=($stock->stock-$cant);
								$producto= new Producto();
								$stockprod = new Producto();
								$producto= $stockprod->find($id);
								$producto->update("stock: $Nstock");
								$producto->save();

								//settype($pagoTotal, float);
								//Flash::Valid($lvar);
								//Flash::Valid($pagoTotal);
								//$pagoTotalD=floatval($pagoTotal);

								$compra = new Compra();
								$pago = new Compra();
								$pago= $compra->find($us->idCompra);
								$pago->update("totalPago: $pagoTotal");
								$pago->save();




								//Modificar el stock de producto
								//Modificar el precio total ya que se debe multiplicar por la cantidad

								Flash::Valid('Operacion Exitosa');
								Input::delete();//Limpia los campos del input
								return Redirect::to("Compra/index/");
							}else
							{
								Flash::Error('Fallo en la Operacion');
								
							}
						}else{
							Flash::Error('Stock insuficiente');
						}
						
					}else{
						Flash::Error('Stock insuficiente');
					}

				}
			
			}
		}

	}
	public function create ()
	{			
		
		//$Ncp= $cp->find_by_sql("Select nombre from Servicio INNER JOIN ContratoServicio ON Servicio WHERE Servicio.idServicio = $id");
		if(Input::hasPost('Compra'))
		{
			$us = new Compra(Input::post('Compra'));
			if($us->create())
			{
				//Flash::Valid($us->nombreCliente);
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to("Compra/index/");
			}else
			{
				Flash::Error('Fallo en la Operacion');
				return Redirect::to("Compra/create/");
			}

		}
	}	

	public function Edit($id)
	{
		//$id=5;
		/*settype($id, 'string');
		Flash::Valid($id);*/
		$var1= new Compra();
		$var2= new Compra();
		$this ->listvar1 = $var1->find_by_sql("Select Producto.idProducto, Producto.nombre from Producto 
			LEFT OUTER JOIN Compra ON  Producto.idProducto = Compra.idProducto Where Producto.idProducto= '$id' ");
		$this ->listvar2 = $var2->find_by_sql("Select Cliente.idCliente, nombreCliente from Cliente 
			LEFT OUTER JOIN Compra ON Cliente.idCliente = Compra.idCliente ");
		$us= new Compra();

		if(Input::hasPost('Compra'))
		{
			//Flash::Valid('Entraste if');
			if($us->update(Input::post ('Compra')))
			{	
				Flash::Valid('Operacion editar exitosa');

				return Redirect::to("Compra/index/");//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{
			//Flash::Valid('Entraste else');
			$this -> Compra = $us-> find ( (int) $id); 
		}
		
		
	}

	public function del ($id)
	{
		//$id=4;	
		$us =new Compra();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Compra/index/');
	}	

}
?>