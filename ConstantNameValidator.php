<?php

namespace Popnikos\ScalarValidator;

class ConstantNameValidator implements ScalarValidatorAbstract
{
  use TraitRegularExpression;
  
  public function __construct()
  {
    $this->setPattern('/^[A-Z][0-9A-Z_]+$/');
  }
  public function isValid($string)
  {
    return $this->match($string);
  }
}
