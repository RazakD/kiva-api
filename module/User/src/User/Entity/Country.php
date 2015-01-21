<?php
  
namespace User\Entity;
  
use Doctrine\ORM\Mapping as ORM;

use User\Entity\Base;
  
/**
 * Loan Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="countries")
 * 
 */
class Country extends Base
{
    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $iso_code;

    /**
     * @ORM\Column(type="string")
     * 
     */
    protected $region;

    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $name;
}