<?php
namespace Loan\Controller\Plugin;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class KivaPlugin extends AbstractPlugin{
  public $em;
  public function getEntityManager(){
    if (null === $this->em) {
      $this->em =  $this->getController()->getServiceLocator()->get('doctrine.entitymanager.orm_default'); 
    } 
    return $this->em;
  } 
      
  public function latestLoans($page = 1){
    $loans_str = file_get_contents("http://api.kivaws.org/v1/loans/newest.json?page=$page");
    $loans = json_decode($loans_str, true);

    $em = $this->getController()->getServiceLocator()->get('Doctrine\ORM\EntityManager');

    $queryBuilder = $em->createQueryBuilder();
    
    $queryBuilder->select('u')
        ->from('\Loan\Entity\Loan','u')
        ->orderBy('u.id','DESC')
        ->setMaxResults(1);
     
    $result = $queryBuilder->getQuery()->getSingleResult();
    $posted_date= $result->getPosteddate();
    //echo $posted_date;*/
    
    /*$query = $em->createQuery('select u from \Loan\Entity\Loan u order by u.id desc')->setMaxResults(1);
    $result = $query->getSingleResult();
    print_r($result->getId());
    die;
    foreach($result as $row){
      echo $row->getId();
      echo "<br>";
    }
    echo sizeof($result);

    die;*/
    /*$em =$this->getController()->getServiceLocator()->get('doctrine.entitymanager.orm_default'); 
    $qb = $em->createQuery('select u from Loan\Entity\Loan u order by u.id desc');

    $result = $qb->getQuery()->getResult();
     print_r($result);
     echo sizeof($result);
   // ->setParameter('baby_name',$babyname);
    exit();*/
    /*$m="2015-02-03T01:30:04Z";
    $n=$posted_date;
    echo $n;
    $t=strtotime($m);
    $tp=strtotime($posted_date);
     if(strtotime($m)>=strtotime($n))
     {
      echo "hellow are";
     }
    exit();
    if($t>$tp)
    {
      echo "ccc";
    }
    echo $tp;
    echo"br";
    echo $t;
    exit();

    if($m<$posted_date)
    {
      echo "hellow abdul";
    }
    exit();*/
    
    $go_next_page = true;
    $filteredLoans = array();
     $valid_country_codes = array('PH');
    foreach($loans['loans'] as $loan){
     if($loan['posted_date'] <= $posted_date){
        $go_next_page = false;
        break;
      }else if(in_array($loan['location']['country_code'], $valid_country_codes))
        array_push($filteredLoans, $loan);
    }
    if($go_next_page){
      $page++;
      $filteredLoans = array_merge($filteredLoans, $this->latestLoans($page));
    }
     
    return $filteredLoans;
  }
}