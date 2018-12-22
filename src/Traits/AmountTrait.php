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

namespace Report\Calculate\Traits;

//----------------------------------
// AmountTrait
//----------------------------------
trait AmountTrait
{
	/**
	 * 精确加法
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathAdd($a, $b, $scale = '2', $round = false)
	{
		return ($round ? $this->mathRound(bcadd($a, $b, (int)$scale + 1), $scale) : bcadd($a, $b, $scale));
	}

	/**
	 * 精确减法
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathSub($a, $b, $scale = '2', $round = false)
	{
		return ($round ? $this->mathRound(bcsub($a, $b, (int)$scale + 1), $scale) : bcsub($a, $b, $scale));
	}

	/**
	 * 精确乘法
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathMul($a, $b, $scale = '2', $round = false)
	{
		if ( ! $this->isEmptyFloat($a) || ! $this->isEmptyFloat($b) )
		{
			return $this->supplementZero('0', $scale);
		}
		return ($round ? $this->mathRound(bcmul($a, $b, (int)$scale + 1), $scale) : bcmul($a, $b, $scale));
	}

	/**
	 * 精确除法
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathDiv($a, $b, $scale = '2', $round = false)
	{
		if ( ! $this->isEmptyFloat($b) )
		{
			return $this->supplementZero('0', $scale);
		}
		return ($round ? $this->mathRound(bcdiv($a, $b, (int)$scale + 1), $scale) : bcdiv($a, $b, $scale));
	}

	/**
	 * 精确平方根
	 * @param [type] $a [description]
	 */
	public function mathBcsqrt($a, $scale = '2')
	{
		return bcsqrt($a, $scale);
	}

	/**
	 * 精确乘方
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathBcpow($a, $b, $scale = '2', $round = false)
	{
		if ( ! $this->isEmptyFloat($b) )
		{
			return $this->supplementZero('0', $scale);
		}
		return ($round ? $this->mathRound(bcpow($a, $b, (int)$scale + 1), $scale) : bcpow($a, $b, $scale));
	}

	/**
	 * 数字乘方求模(先次方然后求余数)
	 */
	public function mathBcpowmod($x, $y, $mod, $scale = 2)
	{
		return bcpowmod($x, $y, $mod, $scale);
	}

	/**
	 * 精确求余/取模
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathMod($a, $b)
	{
		return bcmod($a, $b);
	}

	/**
	 * 比较大小
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 * 大于 返回 1 等于返回 0 小于返回 -1
	 */
	public function mathComp($a, $b, $scale = '5')
	{
		return bccomp($a, $b, $scale); // 比较到小数点位数
	}

	/**
	 * 设置bc函数的小数点位数
	 * @return bool
	 */
	public function mathBcscale($scale = '2')
	{
		return bcscale($scale);
	}

	/**
	 * 四舍五入
	 * @param        $a
	 */
	public function mathRound($a, $scale = '2')
	{
		return number_format(round($a, $scale), $scale);
	}

	/**
	 * 率
	 * @param [type] $a [description]
	 * @param [type] $b [description]
	 */
	public function mathRatio($a, $b, $scale = 2, $round = false)
	{
		return $this->mathMul($this->mathDiv($a, $b, $scale, $round), 100, $scale, $round);
	}

	/**
	 * 小数补0
	 * @param [type] $a [description]
	 */
	public function supplementZero($a, $scale = '2')
	{
		return bcadd($a, 0, $scale);
	}

	public function getInt($a)
	{
		return (int)strval($a);
	}

	public function getFloat($a)
	{
		return floatval(strval($a));
	}

	public function isEmptyInt($a)
	{
		return (empty((int)strval($a)) ? 0 : $a);
	}

	public function isEmptyFloat($a)
	{
		return (empty(floatval($a)) ? 0 : $a);
	}

	/**
	 * 数字转中文人民币
	 * @param $number
	 * @return string
	 */
	public function numberToCny($number)
	{
		$basical = array(0 => "零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖");
		$advanced = array(1 => "拾", "佰", "仟");
		$number = trim($number);
		if ( $number > 999999999999 )
			return "数字太大，无法处理。抱歉！";
		if ( $number == 0 )
			return "零";
		if ( strpos($number, '.') )
		{
			$number = round($number, 2);
			$data = explode(".", $number);
			$data[0] = self::int($data[0], $basical, $advanced);
			$data[1] = self::dec($data[1], $basical);
			return $data[0] . $data[1];
		}
		else
		{
			return self::int($number, $basical) . '整';
		}
	}

	public static function int($number, $basical, $advanced)
	{
		$arr = array_reverse(str_split($number));
		$data = '';
		$zero = false;
		$zero_num = 0;
		foreach ( $arr as $k => $v )
		{
			$_chinese = '';
			$zero = ($v == 0) ? true : false;
			$x = $k % 4;
			if ( $x && $zero && $zero_num > 1 )
				continue;
			switch ( $x )
			{
				case 0:
					if ( $zero )
					{
						$zero_num = 0;
					}
					else
					{
						$_chinese = $basical[ $v ];
						$zero_num = 1;
					}
					if ( $k == 8 )
					{
						$_chinese .= '亿';
					}
					elseif ( $k == 4 )
					{
						$_chinese .= '万';
					}
					break;
				default:
					if ( $zero )
					{
						if ( $zero_num == 1 )
						{
							$_chinese = $basical[ $v ];
							$zero_num++;
						}
					}
					else
					{
						$_chinese = $basical[ $v ];
						$_chinese .= $advanced[ $x ];
					}
			}
			$data = $_chinese . $data;
		}
		return $data . '元';
	}

	public static function dec($number, $basical)
	{
		if ( strlen($number) < 2 )
			$number .= '0';
		$arr = array_reverse(str_split($number));
		$data = '';
		$zero_num = false;
		foreach ( $arr as $k => $v )
		{
			$zero = ($v == 0) ? true : false;
			$_chinese = '';
			if ( $k == 0 )
			{
				if ( ! $zero )
				{
					$_chinese = $basical[ $v ];
					$_chinese .= '分';
					$zero_num = true;
				}
			}
			else
			{
				if ( $zero )
				{
					if ( $zero_num )
					{
						$_chinese = $basical[ $v ];
					}
				}
				else
				{
					$_chinese = $basical[ $v ];
					$_chinese .= '角';
				}
			}
			$data = $_chinese . $data;
		}
		return $data;
	}
}