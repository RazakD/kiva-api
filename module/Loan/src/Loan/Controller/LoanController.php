<?php
namespace Loan\Controller;

use Loan\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class LoanController extends AbstractRestfulJsonController{

    protected $em;

    public function getEntityManager(){
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
	
    public function getList(){   
        // Action used for GET requests without resource Id
        $loans = $this->getEntityManager()->getRepository('Loan\Entity\Loan')->findAll();
        $loans = array_map(function($loan){
            return $loan->toArray();
        }, $loans);
        return new JsonModel($loans);
    }

    public function get($id){   
        // Action used for GET requests with resource Id
        $loan = $this->getEntityManager()->getRepository('Loan\Entity\Loan')->find($id);
        return new JsonModel(
    		$loan->toArray()
    	);
    }

    public function create($data){
        $this->getEntityManager();
        $loan = new \Loan\Entity\Loan($data);
        $loan->validate($this->em);
        
        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
        
        return new JsonModel($loan->toArray());
    }

    public function update($id, $data){
        // Action used for PUT requests
        $loan = $this->getEntityManager()->getRepository('Loan\Entity\Loan')->find($id);
        $loan->set($data);
        $loan->validate($this->em);
        
        $this->getEntityManager()->flush();
        
        return new JsonModel($loan->toArray());
    }

    public function delete($id){
        // Action used for DELETE requests
        $loan = $this->getEntityManager()->getRepository('Loan\Entity\Loan')->find($id);
        $this->getEntityManager()->remove($loan);
        
        $this->getEntityManager()->flush();
        
        return new JsonModel($loan->toArray());
    }

    /**
     *
     * Fetch loans from KIVA
     * TODO
     */
    
    public function fetchLoansfromKIVAAction(){

    }
}
