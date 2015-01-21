<?php
namespace Loan\Exception;

class DataValidationException extends \Exception{

	public $validationErrors;

	function __construct($exception){
		$this->validationErrors = $exception;
		parent::__construct("Data Validation Failure", 400, $this);
	}
}