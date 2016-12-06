<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $layoutCssHash = "'sha256-JGiDVFr1P7/z6TUNSJ7hj31xkuuFs2SaXFosksNK0/E='";
    private $toolbarCssHash = "'sha256-ICr3yfKf7BHsjEtI0woZYjyTCXszlv/NxCZC+sIQrMI='";

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $response = new Response;
        $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src {$this->layoutCssHash}");

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ], $response);
    }

    /**
     * @Route("/workaround")
     */
    public function workaroundAction(Request $request)
    {
        $response = new Response;
        $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src {$this->layoutCssHash} {$this->toolbarCssHash}");

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ], $response);
    }

    /**
     * @Route("/unsafe")
     */
    public function unsafeAction(Request $request)
    {
        $response = new Response;
        $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline'");

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ], $response);
    }

    /**
     * @Route("/none")
     */
    public function noneAction(Request $request)
    {
        $response = new Response;

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ], $response);
    }
}
