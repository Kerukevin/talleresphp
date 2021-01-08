<?php 
	class CompraProducto extends ActiveRecord{
		public function getCompraProducto($page,$ppage=20){
			$cols= "idCompraProducto,idCliente,idProducto,fecha, totalPago";
			$join= "INNER JOIN Cliente ON us idCLiente= idCliente";
			$join2 = "INNER JOIN Producto ON us idProducto= idProducto";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idCompraProducto desc')
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>