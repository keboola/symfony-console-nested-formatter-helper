<?php
/**
 * Created by JetBrains PhpStorm.
 * User: martinhalamicek
 * Date: 7/2/13
 * Time: 1:29 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Keboola\Symfony\Console\Helper\NestedFormatterHelper\Tests;

use Keboola\Symfony\Console\Helper\NestedFormatterHelper\NestedFormatterHelper;

class NestedFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testOneLevelHashmap()
    {
        $formatter = new NestedFormatterHelper();

        $input = array(
            'first' => 'something',
            'second' => 'another',
            'third' => 'haha',
        );
        $expected = "first: something\n";
        $expected .= "second: another\n";
        $expected .= "third: haha\n";

        $this->assertEquals($expected, $formatter->format($input));
    }

    public function testDefaultIndent()
    {
        $formatter = new NestedFormatterHelper();

        $input = array(
            'first' => 'something',
            'second' => 'another',
            'third' => 'haha',
        );
        $expected = "  first: something\n";
        $expected .= "  second: another\n";
        $expected .= "  third: haha\n";

        $this->assertEquals($expected, $formatter->format($input, 1));
    }

    public function testOneLevelNumericArray()
    {
        $formatter = new NestedFormatterHelper();
        $input = array(
            'one',
            'two',
            'three',
        );
        $expected = "- one\n";
        $expected .= "- two\n";
        $expected .= "- three\n";
        $this->assertEquals($expected, $formatter->format($input));
    }

    public function testNestedHashmap()
    {
        $formatter = new NestedFormatterHelper();
        $input = array(
            'first' => 'something',
            'second' => array(
                'item 1' => 'val 1',
                'item 2' => 'val 2',
                'item 3' => array(
                    'sub item 1' => 'value 1',
                    'sub item 2' => 'value 2',
                ),
                'item 4' => array(
                    'one',
                    array(
                        'nested',
                        'more',
                    ),
                    'three',
                )
            ),
            'third' => 'haha',
        );

        $expected = "first: something\n";
        $expected .= "second:\n";
        $expected .= "  item 1: val 1\n";
        $expected .= "  item 2: val 2\n";
        $expected .= "  item 3:\n";
        $expected .= "    sub item 1: value 1\n";
        $expected .= "    sub item 2: value 2\n";
        $expected .= "  item 4:\n";
        $expected .= "    - one\n";
        $expected .= "    -\n";
        $expected .= "      - nested\n";
        $expected .= "      - more\n";
        $expected .= "    - three\n";
        $expected .= "third: haha\n";

        $this->assertEquals($expected, $formatter->format($input));
    }
}
