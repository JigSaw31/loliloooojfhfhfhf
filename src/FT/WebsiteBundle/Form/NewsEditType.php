<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 05/07/2018
 * Time: 12:25
 */

namespace FT\WebsiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function getParent()
    {
        return NewsType::class;
    }
}