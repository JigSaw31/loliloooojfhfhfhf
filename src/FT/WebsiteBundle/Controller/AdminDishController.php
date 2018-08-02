<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 20/06/2018
 * Time: 16:31
 */

namespace FT\WebsiteBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminDishController extends Controller
{
    public function indexAction()
    {
        $listDish = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FTWebsiteBundle:Dish')
            ->getAllDish();
        ;


        // On donne toutes les informations nécessaires à la vue
        return $this->render('@FTWebsite/Admin/Dish/index.html.twig', array(
            'listdish'        => $listDish,
        ));
    }
}