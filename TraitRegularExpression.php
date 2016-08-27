<?php

namespace Popnikos\ScalarValidator;

trait TraitRegularExpression
{
  /**
   * @var string
   */ 
  private $pattern;
  
  /**
   * Assume that $pattern is a valid PCRE Regular expression
   * @param string $pattern
   */
  function setPattern($pattern)
  {
    $this->pattern = $pattern;
  }
  
  function getPattern()
  {
    return $this->pattern;
  }
}
