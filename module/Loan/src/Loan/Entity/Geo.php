<?php
  
namespace Loan\Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Loan\Entity\Base;
/** Geo
 * @ORM\Entity
 * @ORM\Table(name="geo")
 * @property string $level
 * @property string $latitude
 * @property string $longitude
 * @property string $type
 */
  class Geo extends Base
{
 
   /**
   * @ORM\Column(type="string", length=100)
     */
   
      protected $level;
    /**
   * @ORM\Column(type="string", length=100)
     
     */
    protected $latitude;

    /**
   * @ORM\Column(type="string", length=100)
     */
    protected $longitude;
  /**
   * @ORM\Column(type="string", length=100)
     */
    
    protected $type;

   
  
    /**
     * Convert the object to an array.
     
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
 
            $inputFilter->add(array(
                'name'     => 'level',
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
 
          /*  $inputFilter->add(array(
                'name'     => 'latitude',
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
*/
           /* $inputFilter->add(array(
                'name'     => 'longitude',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
               /* 'validators' => array(
                    array(
                        'name'    => 'longitude',
                    )/*,
                    array(
                        'name'  => 'Loan\Validator\NoEntityExists',
                        'options'=>array(
                            'entityManager' =>$em,
                            'class' => 'Loan\Entity\Geo',
                            'property' => 'longitude',
                            'exclude' => array(
                                array('property' => 'id', 'value' => $this->getId())
                            )
                        )
                    )
               
            ));*/
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}