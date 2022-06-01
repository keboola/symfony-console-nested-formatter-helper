# Symfony Console Nested Formatter Helper
[![Build Status](https://travis-ci.org/keboola/symfony-console-nested-formatter-helper.png)](https://travis-ci.org/keboola/symfony-console-nested-formatter-helper)

Nested array formatter helper for Symfony Console.

## Usage

```php

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
    
   $formatter = new NestedFormatterHelper();
   echo $formatter->format($input);

```

#### Output:

```bash

first: something
second:
  item 1: val 1
  item 2: val 2
  item 3:
    sub item 1: value 1
    sub item 2: value 2
  item 4:
    - one
    -
      - nested
      - more
    - three
third: haha

```



## License

MIT licensed, see [LICENSE](./LICENSE) file.
