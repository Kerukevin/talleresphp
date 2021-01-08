<?php 
	class Compra extends ActiveRecord{
		public function getCompra($page,$ppage=20){
			$cols= "idCompra,idCliente,idProducto,fecha, totalPago, cantidad";
			$join= "INNER JOIN Cliente ON us idCLiente= idCliente";
			$join2 = "INNER JOIN Producto ON us idProducto= idProducto";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idCompra desc');
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>