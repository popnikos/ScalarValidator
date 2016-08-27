<?php

namespace Popnikos\ScalarValidator;

trait TraitRegularExpression
{
  private $pattern;
  
  function setPattern($pattern)
  {
    $this->pattern = $pattern;
  }
  
  function getPattern()
  {
    return $this->pattern;
  }
}
