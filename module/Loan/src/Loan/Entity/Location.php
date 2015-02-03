<?php
  
namespace Loan\Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Loan\Entity\Base;

/** Location
 * @ORM\Entity
 * @ORM\Table(name="location")
 * @property string $country_code
 * @property string $country;
 * @property string $town
 * @property string $geo
 */
  class Location extends Base
{
     /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
      protected $country_code;
    /**
     * @ORM\Column(type="string")
     * 
     */
    protected $country;

    /**
     * @ORM\Column(type="string")
     */
    protected $town;

    /**
     * @ORM\Column(type="string")
     */
   
   
      /**
     * @ORM\OneToOne(targetEntity="Geo",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="geo_id", referencedColumnName="id")
     **/
    protected $geo;
   
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    
    public function __construct($data){
        parent::__construct($data);
    }
 public function getPartner(){
        return $this->partner;
    }
    public function getInputFilter($em){
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
 
           /* $inputFilter->add(array(
                'name'     => 'country_code',
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
 
      /*      $inputFilter->add(array(
                'name'     => 'status',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
              /* 'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
                
            ));*/

            $inputFilter->add(array(
               /* 'name'     => 'country_code',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
             /*   'validators' => array(
                    array(
                        'name'    => 'country',
                    ),
                    array(
                        'name'  => 'Loan\Validator\NoEntityExists',
                        'options'=>array(
                            'entityManager' =>$em,
                            'class' => 'Loan\Entity\Loan',
                            'property' => 'country',
                            'exclude' => array(
                                array('property' => 'id', 'value' => $this->getId())
                            )
                        )
                    )
                ),*/
            ));
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}