<?php
  
namespace Loan\Entity;
  
use Doctrine\ORM\Mapping as ORM;

use Loan\Entity\Base;
  
/**
 * Country Entity
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