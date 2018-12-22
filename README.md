# report-calculate

```
composer require wisonlau/report-calculate
```

```php
		echo (19.99 * 100) . "\n"; // 1999
		echo (int)(19.99 * 100) . "\n"; // 1998
		echo $this->getInt(19.99 * 100) . "\n"; // 1999

		echo (0.1 + 0.7) . "\n";
		if ( (0.1 + 0.7) == 0.8 )
		{
			echo '相等' . "\n";
		}
		else
		{
			echo '不相等' . "\n"; // this
		}

		$a = 0.1 + 0.7; // 0.8
		if ( $a == 0.8 )
		{
			echo '一天一小步' . "\n";
		}
		else
		{
			echo '一年一大步' . "\n"; // this
		}
		$a = $this->getFloat(0.1 + 0.7);
		if ( $a == 0.8 )
		{
			echo '一天一小步1' . "\n"; // this
		}
		else
		{
			echo '一年一大步1' . "\n";
		}

		echo intval((0.1 + 0.7) * 10) . "\n";
		echo $this->getInt((0.1 + 0.7) * 10) . "\n"; // 8
		echo $this->getFloat((0.11 + 0.7) * 10) . "\n"; // 8.1
```
