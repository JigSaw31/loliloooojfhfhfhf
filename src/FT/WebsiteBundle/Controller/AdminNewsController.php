<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 05/07/2018
 * Time: 14:08
 */

namespace FT\WebsiteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminNewsController extends Controller
{
    public function indexAction()
    {
        $listNews = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FTWebsiteBundle:News')
            ->getAllNews();
        ;


        // On donne toutes les informations nécessaires à la vue
        return $this->render('@FTWebsite/Admin/News/index.html.twig', array(
            'listnews'        => $listNews,
        ));
    }
}