<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Login;
use Doctrine\DBAL\DBALException;

class LoginController extends Controller
{
	public function __construct(){
    	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
	    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
	    header("Access-Control-Allow-Origin: *");
	}

    /**
     * @Route("/login/registrarse", name="registrarse")
     */
    public function registrarseAction(Request $request) {
        $correo = $request->request->get('correo');
        $contraseña = $request->request->get('contraseña');
        $token = hash('ripemd160', $correo);
        $nuevoUsuario = new Login();              
        $nuevoUsuario->setCorreo($correo);
        $nuevoUsuario->setContrasena($contraseña);
        $nuevoUsuario->setToken($token);
        $em = $this->getDoctrine()->getManager();
        $em->persist($nuevoUsuario);
        $em->flush();

        $usuarios = $this->getDoctrine()->getRepository(Login::class);
        $usuarioId = $usuarios->findOneByToken($token);

        $respuesta = [ 'error' => FALSE, 'mensaje'=> $usuarioId->getId()];
        return new JsonResponse($respuesta, 200);   
    }

    /**
     * @Route("/login/index", name="index")
     */
    public function indexAction(Request $request) {
        $correo = $request->request->get('correo');
        $contraseña = $request->request->get('contraseña');
        if(is_null($correo) || is_null($contraseña)) {
            $respuesta = [ 'error' => TRUE, 'mensaje' => 'Faltan campos'];
            return new JsonResponse($respuesta, 404);   
        }

        // Tenemos correo y contraseña en un post

        //existe???
        $condiciones = ['correo' => $correo];
        $em = $this->getDoctrine()->getEntityManager()->getConnection();
        $query = "SELECT l.id FROM Login l WHERE l.correo = '" . $correo . "'";
        $result = $em->prepare($query);
        $result->execute();
        $usuario = $result->fetchAll();

        if(count($usuario) > 0) {
            $respuesta = [ 'error' => FALSE, 'mensaje'=> 'Usuario existente'];
            return new JsonResponse($respuesta, 200);   
        } else {
            $respuesta = [ 'error' => TRUE, 'mensaje'=> 'Usuario inexistente'];
            return new JsonResponse($respuesta, 200);   
        }
    }
}