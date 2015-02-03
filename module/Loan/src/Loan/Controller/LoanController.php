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
       
        public function fetchLoansAction(){   
        $kiva = $this->KivaPlugin();
        $loans = $kiva->latestLoans();
        $loansarray = array("country"=>'', "location"=>'', "partner"=>''); 
        foreach($loans as $lon){
            if(!empty($lon['id'])) { 
               $loansarray['country']['iso_code'] = $lon['id'];  
            }
            /* if(!empty($lon['id'])) { 
               $loansarray['loan']['kiva_id'] = $lon['id'];  
            }*/
        
            if(!empty($lon['description']['languages'])) { 
               $loansarray['country']['region'] = $lon['description']['languages'][0];  
            }
            
            if(!empty($lon['name'])) { 
               $loansarray['country']['name'] = $lon['name'];  
               $loansarray['partner']['name'] = $lon['name'];  
            }
            
            if(!empty($lon['status'])) {
               $loansarray['partner']['status'] = $lon['status']; 
            }  
      
            if(!empty($lon['location']['country_code'])) { 
               $loansarray['location']['country_code'] = $lon['location']['country_code']; 
               $loansarray['partner']['country_code'] = $lon['location']['country_code'];
            }  
       
            if(!empty($lon['location']['country'])) { 
               $loansarray['location']['country']=$lon['location']['country'];  
            }  
            if(!empty($lon['location']['town'])) { 
               $loansarray['location']['town'] = $lon['location']['town'];  
            }  
            if(!empty($lon['location']['geo']['pairs'])) { 
               $loansarray['location']['geo']['latitude'] = $lon['location']['geo']['pairs'];
               $loansarray['partner']['latitude'] = $lon['location']['geo']['pairs'];
            } 
            if(!empty($lon['location']['geo']['pairs'])) { 
               $loansarray['location']['geo']['longitude']=$lon['location']['geo']['pairs'];  
            } 
            if(!empty($lon['location']['geo']['type'])) { 
               $loansarray['location']['geo']['type'] = $lon['location']['geo']['type']; 
            } 
            if(!empty($lon['country'])) { 
               $loansarray['partner']['country'] = $lon['country'];  
            }  
            if(!empty($lon['default_rate'])) { 
               $loansarray['partner']['default_rate'] = $lon['default_rate'];  
            }   
            if(!empty($lon['total_amount_raised'])) { 
               $loansarray['partner']['total_amount_raised'] = $lon['total_amount_raised'];  
            }   
            if(!empty($lon['loans_posted'])) { 
               $loansarray['partner']['loans_posted'] = $lon['loans_posted'];  
            }  
            if(!empty($lon['url'])) { 
               $loansarray['partner']['url'] = $lon['url'];  
            }  
            if(!empty($lon['theme'])) { 
               $loansarray['partner']['theme'] = $lon['theme'];
               $loansarray['theme'] = $lon['theme'];
            }  
            if(!empty($lon['posted_date'])) { 
               $loansarray['partner']['posted_date'] = $lon['posted_date'];  
               $loansarray['posted_date'] = $lon['posted_date'];  
            }  
            if(!empty($lon['delinquency_rate'])) { 
               $loansarray['partner']['delinquency_rate'] = $lon['delinquency_rate'];  
            }  
            if(!empty($lon['loan_amount'])) { 
               $loansarray['loan_amount'] = $lon['loan_amount'];  
            }  
            if(!empty($lon['funded_amount'])) { 
               $data['funded_amount'] = $lon['funded_amount'];  
            }  
            if(!empty($lon['sector'])) { 
            $loansarray['sector'] = $lon['sector'];  
           
            } 
            
            $this->getEntityManager();
            $loan = new \Loan\Entity\Loan($loansarray);
            $loan->validate($this->em);
            $this->getEntityManager()->persist($loan);
            $this->getEntityManager()->flush();
            }
           
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
        }
