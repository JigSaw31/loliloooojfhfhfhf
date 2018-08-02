<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 19/06/2018
 * Time: 17:22
 */

namespace FT\WebsiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DishEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function getParent()
    {
        return DishType::class;
    }
}