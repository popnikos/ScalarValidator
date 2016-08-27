<?php

namespace Popnikos\ScalarValidator;

class RangeValidator implements ScalarValidatorAbstract
{
  private $range;
  
  /**
   * Parse the range string to retrieve informations to evaluate validation
   * @todo Add signed number management
   */
  private function parseRange()
  {
    $info = ['error'=>null];
    if( preg_match('/^(\[|\]) # Must begin with "[" (inclusive) or "]" (exclusive)
    (\d+)(\.\d+)? # Min to compares (a number with or without decimal)
    ; # Predefined separator semi-column
    (\d+)(\.\d+)? # Max to compare with (a number with or without decimal)
    (\[|\]) # Must end with "[" (exclusive) or "]" (inclusive)
    $/x', $this->getRange(),$rangeInfos) {
      $info['min'] =floatval($rangeInfos[2] . $rangeInfos[3]);
      $info['max'] =floatval($rangeInfos[4] . $rangeInfos[5]);
      $info['isMinInclusive'] = $rangeInfos[1] === '[';
      $info['isMaxInclusive'] = $rangeInfos[6] === ']';
    } else {
      $info['error'] = 'invalid range expression';
    }
    return $info;
  }
    
  /**
   * @param string $range Defines the range against value is compare with a simple string
   */
  public function setRange($range)
  {
    $this->range = $range;
    return $this;
  }
  
  protected function getRange()
  {
    return $this->range;
  }
  
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
