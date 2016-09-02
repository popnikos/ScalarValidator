<?php

namespace Popnikos\ScalarValidator;

abstract class ScalarValidatorAbstract
{
  /**
   * Main method to validate the value
   * @param mixed $value
   */
  abstract public function isValid($value);
}
