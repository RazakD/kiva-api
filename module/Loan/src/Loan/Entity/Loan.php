<?php
namespace Loan\Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Loan\Entity\Base;
/** Loan
 * @ORM\Entity
 * @ORM\Table(name="loan")
 * @ORM\Table(name="loan")
 * @property string $status
 * @property string $loan_amount
 * @property string $funded_amount
 * @property string $sector
 * @property string $theme
 * @property string $posted_date
 * @property string $longitude
 * @property string $longitude
 */
  class Loan extends Base
{
    /**
     * @ORM\ManyToOne(targetEntity="Country",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     **/  
   protected $country;
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
     * @ORM\ManyToOne(targetEntity="Location",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     **/
    protected $location;
    /**
     * @ORM\ManyToOne(targetEntity="Partner",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id")
     **/
    protected $partner;


    /**
     * @ORM\Column(type="decimal")
     */
    protected $loan_amount;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $funded_amount;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $sector;

    /**
     * @ORM\Column(type="string", length=100)
     **/
    protected $theme;
     /**
     * @ORM\Column(type="string", length=100)
     */
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
       
 public function getPartner(){
        return $this->partner;
    }

    public function getPosteddate(){
        return $this->posted_date;

    }
    public function getInputFilter($em){
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
 
          /*  $inputFilter->add(array(
                'name'     => 'status',
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
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));*/

            /*$inputFilter->add(array(
                'name'     => 'loan_amount',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
                /*'validators' => array(
                    array(
                        'name'    => 'country',
                    ),
                    array(
                        'name'  => 'Loan\Validator\NoEntityExists',
                        'options'=>array(
                            'entityManager' =>$em,
                            'class' => 'Loan\Entity\Country',
                            'property' => 'country',
                            'exclude' => array(
                                array('property' => 'id', 'value' => $this->getId())
                            )
                        )
                    )
                ),
            ));*/
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}