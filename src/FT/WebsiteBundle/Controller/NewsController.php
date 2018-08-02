<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 28/06/2018
 * Time: 13:02
 */

namespace FT\WebsiteBundle\Controller;



use Doctrine\Common\Collections\ArrayCollection;
use FT\WebsiteBundle\Entity\News;
use FT\WebsiteBundle\Form\NewsEditType;
use FT\WebsiteBundle\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1){

            throw $this->createNotFoundException("La page".$page." n'existe pas.");
        }


        $listNews = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FTWebsiteBundle:News')
            ->getAllNews();
        ;

        // On donne toutes les informations nécessaires à la vue
        return $this->render('@FTWebsite/News/index.html.twig', array(
            'listnews'        => $listNews,
        ));


    }

    public function viewAction($id)
    {

    }

    public function addAction(Request $request)
    {

        $news = new News();


        $form = $this->get('form.factory')->create(NewsType::class, $news);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($news);

            $em->flush();



            return $this->redirectToRoute('ft_website_dish_home', array('id' => $news->getId()));

        }

        return $this->render('@FTWebsite/News/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('FTWebsiteBundle:News')->find($id);


        $form = $this->get('form.factory')->create(NewsEditType::class, $news);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre annonce
            $em->flush();


            return $this->redirectToRoute('oc_platform_home');
        }

        return $this->render('@FTWebsite/Dish/edit.html.twig', array(
            'news' => $news,
            'form'   => $form->createView(),
        ));



    }

    public function deleteAction(Request $request, $id)
    {

    }
}