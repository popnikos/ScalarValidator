<?php

namespace Popnikos\ScalarValidator\Parser;

/**
 * @author Nicolas KLEIN <popnikos@gmail.com>
 */
class RangeParser implements ParserInterface
{
    /**
     * Try to evaluate $value as a range expression like this :
     * String must start with "[" (if lower limit is inclusive) or "]" in the other case.
     * Lower limit follows as a numerical expression (evaluated with "is_numeric" php internal function)
     * A semi-colon follows as a delimiter
     * Upper limit follows as a numerical expression (evaluated with "is_numeric" php internal function)
     * String must end with another bracket to indicate inclusive or not.
     * @return mixed[]
     */
    public function parse($value) 
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
}
