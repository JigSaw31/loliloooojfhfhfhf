<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 25/06/2018
 * Time: 14:35
 */

namespace FT\WebsiteBundle\Controller;


use FT\WebsiteBundle\Entity\Contact;
use FT\WebsiteBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->get('form.factory')->create(ContactType::class, $contact);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if ($this->sendMail($form->getData()))
            {
                return $this->redirectToRoute('ft_website_homepage');
            }

        }

        return $this->render('@FTWebsite/Contact/formcontact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function sendMail($data)
    {
        $message = \Swift_Message::newInstance()

            ->setSubject('Vous avez reçu un message de votre site !')
            ->setFrom('shahroznawaz156@gmail.com')
            ->setTo('xproz31@gmail.com')
            ->setBody("votre nom est : ".$data->getLname(),'text/html');

        $this->get('mailer')->send($message);
    }
}