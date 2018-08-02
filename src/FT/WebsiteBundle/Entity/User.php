<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 20/06/2018
 * Time: 14:10
 */

namespace FT\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
