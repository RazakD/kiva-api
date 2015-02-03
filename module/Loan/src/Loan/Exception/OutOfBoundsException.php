<?php

namespace Doctrine\Common\Proxy\Exception;
 
 use Doctrine\Common\Persistence\Proxy;
 use OutOfBoundsException as BaseOutOfBoundsException; 
 
 class OutOfBoundsException extends BaseOutOfBoundsException implements ProxyException
{
   /**
      * @param string $className
      * @param string $idField
      *
      * @return self
      */
     public static function missingPrimaryKeyValue($className, $idField)
     {
         return new self(sprintf("Missing value for primary key %s on %s", $idField, $className));
     }
 }
 

