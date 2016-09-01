<?php

namespace Popnikos\ScalarValidator;

class RangeValidator implements ScalarValidatorAbstract
{
  private $range;
  
  /**
   * Parse the range string to retrieve informations to evaluate validation
   * @return array
   */
  private function parseRange()
  {
    $info = ['error'=>null];
    if( preg_match('/^
    (\[|\]) # Must begin with "[" (inclusive) or "]" (exclusive)
    ([^;]+) # Min to compares (a numerical expression)
    ;       # Predefined separator semi-column
    (.+)    # Max to compare with (a number with or without decimal)
    (\[|\]) # Must end with "[" (exclusive) or "]" (inclusive)
    $/x', $this->getRange(),$rangeInfos) {
      if (is_numeric($rangeInfos[2]) && is_numeric($rangeInfos[3])) {
        $info['min'] =floatval($rangeInfos[2]);
        $info['max'] =floatval($rangeInfos[3]);
        $info['isMinInclusive'] = $rangeInfos[1] === '[';
        $info['isMaxInclusive'] = $rangeInfos[4] === ']';  
      } else {
        $info['error'] = sprintf('$1%s is not a valid expression.'.
          ' Both lower and upper limit must satisfy "is_numeric" condition '.
          '(see php manual).', $rangeInfos[0]);
      }
    } else {
      $info['error'] = 'invalid range expression';
    }
    return $info;
  }
    
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
    $info = $this->parseRange();
    $valid = false;
    if( is_null($info['error']) ) {
      $valid = $info['isMinInclusive'] ? $info['min']<=$value : $info['min']<$value;
      if( $valid ) {
        $valid = $info['isMaxInclusive'] ? $info['max']>=$value : $info['max']>$value;
      } 
    } else {
      trigger_error($info['error'], E_USER_WARNING);
    }
    return $valid;
  }
}
