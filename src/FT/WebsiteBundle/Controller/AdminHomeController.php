<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 20/06/2018
 * Time: 16:12
 */

namespace FT\WebsiteBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminHomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@FTWebsite/Admin/home/index.html.twig');
    }
}