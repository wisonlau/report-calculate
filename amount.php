<?php
// +----------------------------------------------------------------------
// | report calculate [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018-2018 http://wisonlau.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wisonlau <122022066@qq.com>
// +----------------------------------------------------------------------

require_once 'src/Traits/AmountTrait.php';

use Report\Calculate\Traits\AmountTrait;

class Test
{
	use AmountTrait;

	public function doing()
	{
		echo '------------默认--------------' . "\n";
		// echo $this->mathAdd('3.445', '3.444') . "\n"; // 加 6.88
		// echo $this->mathSub('3.445', '3.444') . "\n"; // 减 0.00
		// echo $this->mathMul('3.445', '3.444') . "\n"; // 乘 11.86
		// echo $this->mathDiv('3.445', '3.444') . "\n"; // 除 1.00
		// echo $this->mathMod('3.445', '3.444') . "\n"; // 取模 0
		// echo $this->mathComp('3.445', '3.444') . "\n";// 比较 1
		echo '------------保留3位--------------' . "\n";
		// echo $this->mathAdd('3.445', '3.444', '3') . "\n"; // 加 6.889
		// echo $this->mathSub('3.445', '3.444', '3') . "\n"; // 减 0.001
		// echo $this->mathMul('3.445', '3.444', '3') . "\n"; // 乘 11.864
		// echo $this->mathDiv('3.445', '3.444', '3') . "\n"; // 除 1.000
		echo '------------四舍五入相加--------------' . "\n";
		// echo $this->mathAdd('3.001', '3.004', '2', true) . "\n"; // 加 6.889
		echo '--------------------------' . "\n";
		// echo $this->mathAdd('3.445', '3.444', '0') . "\n"; // 加 6
		echo '--------------------------' . "\n";
		// echo $this->mathAdd('3.96999', '4.010') . "\n"; // 7.97
		// echo $this->mathSub('3.96999', '1.10') . "\n"; // 2.86
		echo '------------补零--------------' . "\n";
		// echo $this->supplementZero('3.96999', '2') . "\n"; // 3.96
		echo '--------------------------' . "\n";
		// echo $this->mathMul('0', '0.0') . "\n"; // 0.00 [bcmul(0, 0, 2) // 0, bcmul(0, 0.0, 2) // 0.0, bcmul(0.0, 1, 2) // 0.0]
		// echo $this->supplementZero($this->mathMul('0', '0'), '2') . "\n"; // 0.00
		// echo $this->mathMul('1.111', '0') . "\n"; // 0.00
		echo '------------率--------------' . "\n";
		echo $this->mathRatio(100, 100) . "%\n";
		echo '------------四舍五入--------------' . "\n";
		echo $this->mathRound('3.555555555555555555555555', 2) . "\n";
		// echo $this->mathRound('3.4444', 2) . "\n";
		// echo $this->mathRound('3.4446', 2) . "\n";
		// echo $this->mathRound('3.4454') . "\n";
		// echo $this->mathRound('3.0') . "\n";
		// echo $this->mathRound(19.99*100, 2) . "\n";
		// echo $this->mathRound(19.98*100, 2) . "\n";
		echo '------------转大写--------------' . "\n";
		echo $this->numberToCny(12313213.234) . "\n";
		echo '--------------------------' . "\n";
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

		// 产生这样的原因是计算机内部对部分浮点数不能准确地用二进制表示,就像我们不能用十进制准确表示10/3一样,浮点数在计算机内部的表示:IEEE 754.不懂的自己查找资料
	}
}

(new Test())->doing();
