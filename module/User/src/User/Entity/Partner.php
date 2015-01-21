<?php
  
namespace User\Entity;
  
use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;

use User\Entity\Base;
  
/**
 * Loan Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="loans")
 * 
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
    protected $delinquency_rate;

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
 
            $inputFilter->add(array(
                'name'     => 'fname',
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
            ));
 
            $inputFilter->add(array(
                'name'     => 'lname',
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
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
 
            $inputFilter->add(array(
                'name'     => 'password',
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
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                    ),
                    array(
                        'name'  => 'User\Validator\NoEntityExists',
                        'options'=>array(
                            'entityManager' =>$em,
                            'class' => 'User\Entity\User',
                            'property' => 'email',
                            'exclude' => array(
                                array('property' => 'id', 'value' => $this->getId())
                            )
                        )
                    )
                ),
            ));
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}