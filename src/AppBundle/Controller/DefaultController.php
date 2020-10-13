<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Productos;
use AppBundle\Entity\Visitas;
use Doctrine\DBAL\DBALException;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $visitas = $this->getDoctrine()->getRepository(Visitas::class);
        $cantidadVisitas = $visitas->findAll();
        $nuevaVisita = new Visitas();              
        $em = $this->getDoctrine()->getManager();
        $em->persist($nuevaVisita);
        $em->flush();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/enviarCorreo", name="enviarCorreo")
     */
    public function enviarCorreo(Request $request)
    {
        $from = $request->request->get('mail');
        $message = $request->request->get('msj');
        $subject = $request->request->get('name');
        $to = 'nmpiovano@hotmail.com';
        $headers ="From: " . $from;      
        mail($to,$subject,$message,$headers);
        die;
    }
}
