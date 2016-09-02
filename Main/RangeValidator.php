<?php

namespace Popnikos\ScalarValidator;

use Popnikos\ScalarValidator\Parser\RangeParser;

class RangeValidator implements ScalarValidatorAbstract
{
  private $range;
  
  /**
   * @param string $range Defines the range against value is compare with a simple string
   * @return RangeValidator
   */
  public function setRange($range)
  {
    $this->range = $range;
    return $this;
  }
  
  /**
   * @return string The range expression
   */ 
  protected function getRange()
  {
    return $this->range;
  }
  
  /**
   * Check if a given numeric value satisfy range limits
   * Throw a E_USER_WARNING if the range expression can not be evaluated
   * @return boolean TRUE if $value is between lower and upper limit
   */
  public function isValid($value)
  {
    $info = (new RangeParser())->parse($value);
    $valid = false;
    if( is_null($info['error']) ) {
      $valid = $info['isMinInclusive'] ? $info['min']<=$value : $info['min']<$value;
      if( $valid ) {
        $valid = $info['isMaxInclusive'] ? $info['max']>=$value : $info['max']>$value;
      } 
    } else {
      @trigger_error($info['error'], E_USER_WARNING);
    }
    return $valid;
  }
}
