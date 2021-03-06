<?php
/**
 * Created by JetBrains PhpStorm.
 * User: martinhalamicek
 * Date: 7/2/13
 * Time: 1:22 PM
 */

namespace Keboola\Symfony\Console\Helper\NestedFormatterHelper;

use Symfony\Component\Console\Helper\FormatterHelper;

class NestedFormatterHelper extends FormatterHelper
{

    /**
     * @param array $hashmap
     * @return string
     */
    public function format(array $hashmap, $indentLevel = 0)
    {
        $prefix = str_repeat(' ', 2 * $indentLevel);
        $output = '';
        $isAssocArray = $this->isAssocArray($hashmap);
        foreach ($hashmap as $key => $value) {
            if (is_array($value)) {
                $output .= sprintf("$prefix%s\n", $isAssocArray ? "$key:" : '-');
                $output .= $this->format($value, $indentLevel + 1);
            } else {
                $output .= sprintf("$prefix%s\n", $isAssocArray ? "$key: $value" : "- $value");
            }
        }
        return $output;
    }

    private function isAssocArray($array)
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'nestedFormatter';
    }

}