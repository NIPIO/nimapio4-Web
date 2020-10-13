<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Productos;
use Doctrine\DBAL\DBALException;

class LineasController extends Controller
{
    /**
     * @Route("/lineas", name="lineas")
     */
    public function findLineasAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager()->getConnection();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT l
            FROM AppBundle:Lineas l');
        $lineas = $query->getArrayResult();
        $respuesta = [ 'error' => FALSE, 'mensaje' => $lineas];
        return new JsonResponse($respuesta);    
    }

}