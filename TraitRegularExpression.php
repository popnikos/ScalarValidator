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
  protected function setPattern($pattern)
  {
    $this->pattern = $pattern;
  }
  
  protected function getPattern()
  {
    return $this->pattern;
  }
  
  protected function match($value)
  {
    return preg_match($this->getPattern(), $value);
  }
}
