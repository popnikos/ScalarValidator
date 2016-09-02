<?php

namespace Popnikos\ScalarValidator;

class PercentValidator implements ScalarValidatorAbstract
{
  public function isValid($value)
  {
    return (new RangeValidator())->setRange('[0;100]')->isValid();
  }
}
