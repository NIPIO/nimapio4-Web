<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Login;
use AppBundle\Entity\Ordenes;
use AppBundle\Entity\OrdenesDetalle;
use Doctrine\DBAL\DBALException;

class PedidosController extends Controller
{
	public function __construct(){
    	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
	    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
	    header("Access-Control-Allow-Origin: *");
	}

	 /**
     * @Route("/pedidos/realizarPedido", name="realizarPedido")
     */
    public function realizarPedidoAction(Request $request){
    	try{
				$usuarios = $this->getDoctrine()->getRepository(Login::class);
		        $pedidos = $this->getDoctrine()->getRepository(Ordenes::class);
		        $ahora = new \DateTime();

		        $usuarioId = $usuarios->findOneById($request->request->get('user'));
		    	$items = $request->request->get('items');
		    	$items = explode(",",$items);


				$nuevoPedido = new Ordenes();              
		        $nuevoPedido->setUsuarioId($usuarioId->getId());
		        $nuevoPedido->setCreadoEn($ahora);
		        $em = $this->getDoctrine()->getManager();
		        $em->persist($nuevoPedido);
		        $em->flush();

		        $nuevoPedidoId = $pedidos->findOneByCreadoEn($ahora);

		        for ($i=0; $i < count($items); $i++) { 
					$nuevoPedidoDetalle = new OrdenesDetalle();              
			        $nuevoPedidoDetalle->setOrdenId($nuevoPedidoId->getId());
			        $nuevoPedidoDetalle->setProductoId($items[$i]);
			        $em->persist($nuevoPedidoDetalle);
			        $em->flush(); 
		        	$em->clear();
		        }

		        $respuesta = [ 'error' => FALSE, 'mensaje'=> 'OK'];
		        return new JsonResponse($respuesta, 200);   
        } catch (DBALException $e) {
				dump($e->getMessage());die;
				throw new \Exception("No se pudo completar la operación1.");
		}
    }
    /**
     * @Route("/pedidos/obtenerPedidos/{idUser}", name="obtenerPedidos")
     */
    public function findPedidosAction($idUser){
    	try {
				$usuarios = $this->getDoctrine()->getRepository(Login::class);
		        $pedidos = $this->getDoctrine()->getRepository(Ordenes::class);
		        $pedidosDetalle = $this->getDoctrine()->getRepository(OrdenesDetalle::class);
		        $em = $this->getDoctrine()->getEntityManager()->getConnection();
		        $pedidosId = $pedidos->findByUsuarioId($idUser);
		        $idPedidos = [];

				foreach ($pedidosId as $row) {
					$query = 'SELECT a.orden_id, b.* FROM `ordenes_detalle` a INNER JOIN `productos` b on a.producto_id = b.codigo where a.orden_id = '. $row->getId();
					$result = $em->prepare($query);
			        $result->execute();
			        $buscarDetallePedido = $result->fetchAll();

		        	$orden = [
		        		'id' => $row->getId(), 
		        		'creado_en' => $row->getCreadoEn()->format('d-m-Y H:i:s'),
		        		'detalle' => $buscarDetallePedido
		        	];
		        	array_push($idPedidos, $orden);
		        }

		        $respuesta = [ 'error' => FALSE, 'mensaje'=> $idPedidos];
		        return new JsonResponse($respuesta, 200); 
        } catch (DBALException $e) {
				dump($e->getMessage());die;
				throw new \Exception("No se pudo completar la operación2.");
        }
   	}

     /**
     * @Route("/pedidos/borrarPedido/{idUser}/{nroPedido}", name="borrarPedido")
     */
    public function borrarPedidoAction($idUser, $nroPedido){
        try {
		        $em = $this->getDoctrine()->getEntityManager()->getConnection();
				$query = 'DELETE FROM ordenes WHERE id = '. $nroPedido;
				$result = $em->prepare($query);
			    $result->execute();

		        $respuesta = [ 'error' => FALSE, 'mensaje'=> 'Orden eliminada'];
		        return new JsonResponse($respuesta, 200);
        } catch (DBALException $e) {
				dump($e->getMessage());die;
				throw new \Exception("No se pudo completar la operación3.");
        }
    }
}
