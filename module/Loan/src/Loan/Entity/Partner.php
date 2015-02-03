<?php
  
namespace Loan\Entity;
  
use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;

use Loan\Entity\Base;
  
/** Partner
 *
 * @ORM\Entity
 * @ORM\Table(name="partner")
 * @property string $name
 * @property string $status
 * @property string $country_code
 * @property string $country
 * @property string $delinquency_rate
 * @property string $default_rate
 * @property string $total_amount_raised
 * @property string $loans_posted
 * @property string $url
 * @property string $theme
 * @property string $posted_date
 * @property string $longitude
 * @property string $longitude
 */
class Partner extends Base
{
    
    /**
     * @ORM\Column(type="string")
    
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * 
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $country_code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $country;

   /**
     * @ORM\Column(type="decimal")
     */
    protected $default_rate;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $total_amount_raised;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $loans_posted;

    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=100)
     **/
    protected $theme;


    /**
     * @ORM\Column(type="string", length=100)
     **/
    protected $posted_date;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $longitude;

/**
     * @ORM\Column(type="decimal")
     */
    protected $delinquency_rate;
  
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    
    public function __construct($data){
        parent::__construct($data);
    }

    public function getInputFilter($em){
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
 
 /*           $inputFilter->add(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));*/
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}