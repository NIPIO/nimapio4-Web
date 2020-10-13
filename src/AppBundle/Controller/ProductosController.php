<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Productos;
use Doctrine\DBAL\DBALException;

class ProductosController extends Controller
{

    /**
     * @Route("/productos/obtenerTodos/{id}", name="productos")
     */
    public function findProductosAction(Request $request) {
        $pagina = $request->attributes->get('_route_params')['id'];
        $em = $this->getDoctrine()->getEntityManager()->getConnection();
        $query = "SELECT * FROM Productos LIMIT " . $pagina * 10 .',10';
        $result = $em->prepare($query);
        $result->execute();
        $productos = $result->fetchAll();

        $respuesta = [ 'error' => FALSE, 'mensaje' => $productos];
        return new JsonResponse($respuesta);
    }

    /**
     * @Route("/productos/obtenerPorTipo/{tipo}/{pagina}", name="productosTipo")
     */
    public function findProductosPorTipoAction(Request $request) {
        $pagina = $request->attributes->get('_route_params')['pagina'];
        $tipo = $request->attributes->get('_route_params')['tipo'];

        if($tipo == 0){
            $respuesta = [ 'error' => TRUE, 'mensaje' => 'Falta el parámetro de tipo'];
            return new JsonResponse($respuesta, 404);    
        }

        $em = $this->getDoctrine()->getEntityManager()->getConnection();
        $query = "SELECT * FROM Productos WHERE linea_id = ". $tipo ." LIMIT ". $pagina * 10 .",10";
        $result = $em->prepare($query);
        $result->execute();
        $productos = $result->fetchAll();

        $respuesta = [ 'error' => FALSE, 'mensaje' => $productos];
        return new JsonResponse($respuesta);
    }
    /**
     * @Route("/productos/buscar/{termino}", name="buscarProductos")
     */
    public function findProductosBuscarAction($termino) {
        if (strlen($termino) > 2) {
            $em = $this->getDoctrine()->getEntityManager()->getConnection();
            $query = "SELECT * FROM `productos` where producto LIKE '%".  $termino . "%'";
            $result = $em->prepare($query);
            $result->execute();
            $productos = $result->fetchAll();
            $respuesta = [ 'error' => FALSE, 'mensaje' => $productos];
            return new JsonResponse($respuesta);
        } else {
            dump('as');die;
        }
    }
}
