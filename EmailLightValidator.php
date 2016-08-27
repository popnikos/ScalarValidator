<?php

namespace Popnikos\ScalarValidator;

class EmailLightValidator implements ScalarValidatorAbstract
{
  use TraitRegularExpression;
  
  public function __construct()
  {
    $this->setPattern('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/');
  }
  public function isValid($string)
  {
    return $this->match($string);
  }
}
