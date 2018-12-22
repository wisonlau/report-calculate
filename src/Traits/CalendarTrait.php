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
// CalendarTrait
//----------------------------------
trait CalendarTrait
{
	/**
	 * 求两个日期之间相差的天数
	 * @param string $begin_time
	 * @param string $end_time
	 * @return array
	 */
	private function diffBetweenTwoDays($begin_time, $end_time)
	{
		if ( ! is_numeric($begin_time) )
		{
			$begin_time = strtotime($begin_time);
		}
		if ( ! is_numeric($end_time) )
		{
			$end_time = strtotime($end_time);
		}

		if ( $begin_time < $end_time )
		{
			$starttime = $begin_time;
			$endtime = $end_time;
		}
		else
		{
			$starttime = $end_time;
			$endtime = $begin_time;
		}

		// 计算天数
		$timediff = $endtime - $starttime;
		$days = intval($timediff / 86400);
		// 计算小时数
		$remain = $timediff % 86400;
		$hours = intval($remain / 3600);
		// 计算分钟数
		$remain = $remain % 3600;
		$mins = intval($remain / 60);
		// 计算秒数
		$secs = $remain % 60;

		$result = array("day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs);
		return $result;
	}

	/**
	 * 计算多久以前
	 * @param string $time
	 * @return string
	 */
	public function timeTran($time)
	{
		if ( ! is_numeric($time) )
		{
			$time = strtotime($time);
		}

		$tmp = time() - $time;
		$format = array(
			'31536000' => '年',
			'2592000' => '个月',
			'604800' => '星期',
			'86400' => '天',
			'3600' => '小时',
			'60' => '分钟',
			'1' => '秒'
		);
		foreach ( $format as $key => $value )
		{
			if ( 0 != $num = floor($tmp / (int)$key) )
			{
				return $num . $value . '前';
			}
		}

		return false;
	}

	/**
	 * 获取指定时间段内每一天的日期
	 * @param string $startdate 开始日期
	 * @param string $enddate   结束日期
	 * @return Array
	 */
	public function getDateFromRange($startdate, $enddate)
	{
		if ( is_numeric($startdate) )
		{
			$startdate = date('Y-m-d', $startdate);
		}
		if ( is_numeric($enddate) )
		{
			$enddate = date('Y-m-d', $enddate);
		}
		$start_time = strtotime(date('Y-m-d', strtotime($startdate)));
		$end_time = strtotime(date('Y-m-d', strtotime($enddate)));

		$result = array();

		while ( $start_time <= $end_time )
		{
			$result[] = date('Y-m-d', $start_time);
			$start_time = strtotime('+1 day', $start_time);
		}
		return $result;
	}

	/**
	 * 获取某月的天数
	 */
	public function getMonthDays($time)
	{
		if ( ! is_numeric($time) )
		{
			$time = strtotime($time);
		}
		return date('t', $time);
	}

	/**
	 * 获取某年某月的开始结束日期
	 * @param int $year
	 * @param int $month
	 */
	public function getMonthStartEnd($year, $month)
	{
		$firstday = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
		$lastday = date('Y-m-d', mktime(0, 0, 0, $month + 1, 1, $year) - 1);
		$return = array(
			'start' => $firstday,
			'end' => $lastday,
			'stime' => strtotime($firstday),
			'etime' => strtotime($lastday)
		);
		return $return;
	}

	/**
	 * 获取某年某周的开始结束日期
	 * @param int $year
	 * @param int $week 1~52
	 */
	public function getWeekStartEnd($year, $week)
	{
		$weeks = date("W", mktime(0, 0, 0, 12, 28, $year));
		if ( $week > $weeks || $week <= 0 )
		{
			$week = 1;
		}
		if ( $week < 10 )
		{
			$week = '0' . $week;
		}
		$time['stime'] = strtotime($year . 'W' . $week);
		$time['etime'] = strtotime('+1 week -1 day', $time['stime']);
		$time['start'] = date('Y-m-d', $time['stime']);
		$time['end'] = date('Y-m-d', $time['etime']);
		return $time;
	}

	/**
	 * 返回今日开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getToday()
	{
		return [
			mktime(0, 0, 0, date('m'), date('d'), date('Y')),
			mktime(23, 59, 59, date('m'), date('d'), date('Y'))
		];
	}

	/**
	 * 返回昨日开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getYesterday()
	{
		$yesterday = date('d') - 1;
		return [
			mktime(0, 0, 0, date('m'), $yesterday, date('Y')),
			mktime(23, 59, 59, date('m'), $yesterday, date('Y'))
		];
	}

	/**
	 * 返回上周开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getLastWeekTime()
	{
		$timestamp = time();
		return [
			strtotime(date('Y-m-d', strtotime("last week Monday", $timestamp))),
			strtotime(date('Y-m-d', strtotime("last week Sunday", $timestamp))) + 24 * 3600 - 1
		];
	}

	/**
	 * 获取一周日期
	 * @param int $time   时间戳
	 * @param string $format 转换格式
	 */
	function getWeek($time, $format = "Y-m-d")
	{
		$week = date('w', $time);
		$weekname = array('星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');
		// 星期日排到末位
		if ( empty($week) )
		{
			$week = 7;
		}
		for ( $i = 0; $i <= 6; $i++ )
		{
			$data[ $i ]['date'] = date($format, strtotime('+' . $i + 1 - $week . ' days', $time));
			$data[ $i ]['week'] = $weekname[ $i ];
		}
		return $data;
	}

	/**
	 * 返回上个月开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getLastMonth()
	{
		$begin = mktime(0, 0, 0, date('m') - 1, 1, date('Y'));
		$end = mktime(23, 59, 59, date('m') - 1, date('t', $begin), date('Y'));

		return [$begin, $end];
	}

	/**
	 * 返回今年开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getYear()
	{
		return [
			mktime(0, 0, 0, 1, 1, date('Y')),
			mktime(23, 59, 59, 12, 31, date('Y'))
		];
	}

	/**
	 * 返回去年开始和结束的时间戳
	 *
	 * @return array
	 */
	public function getLastYear()
	{
		$year = date('Y') - 1;
		return [
			mktime(0, 0, 0, 1, 1, $year),
			mktime(23, 59, 59, 12, 31, $year)
		];
	}

	/**
	 * 获取几天前零点到现在/昨日结束的时间戳
	 *
	 * @param int  $day 天数
	 * @param bool $now 返回现在或者昨天结束时间戳
	 * @return array
	 */
	public function getDayToNow($day = 1, $now = true)
	{
		$end = time();
		if ( ! $now )
		{
			list($foo, $end) = $this->getYesterday();
		}

		return [
			mktime(0, 0, 0, date('m'), date('d') - $day, date('Y')),
			$end
		];
	}


	/**
	 * 判断是否是闰年
	 * @param int year
	 */
	public function isLeapYear($year)
	{
		return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0));
	}

	/**
	 * 获取数字的阴历叫法
	 * @param int num 数字
	 * @param bool isMonth 是否是月份的数字
	 */
	function getCapitalNum($num, $isMonth)
	{
		$isMonth = $isMonth || false;
		$dateHash = array('0' => '', '1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六', '7' => '七', '8' => '八', '9' => '九', '10' => '十 ');
		$monthHash = array('0' => '', '1' => '正月', '2' => '二月', '3' => '三月', '4' => '四月', '5' => '五月', '6' => '六月', '7' => '七月', '8' => '八月', '9' => '九月', '10' => '十月', '11' => '冬月', '12' => '腊月');
		$res = '';
		if ( $isMonth )
		{
			$res = $monthHash[ $num ];
		}
		else
		{
			if ( $num <= 10 )
			{
				$res = '初' . $dateHash[ $num ];
			}
			else if ( $num > 10 && $num < 20 )
			{
				$res = '十' . $dateHash[ $num - 10 ];
			}
			else if ( $num == 20 )
			{
				$res = "二十";
			}
			else if ( $num > 20 && $num < 30 )
			{
				$res = "廿" . $dateHash[ $num - 20 ];
			}
			else if ( $num == 30 )
			{
				$res = "三十";
			}
		}
		return $res;
	}

	/**
	 * 获取干支纪年
	 * @param int year
	 */
	function getLunarYearName($year)
	{
		$sky = array('庚', '辛', '壬', '癸', '甲', '乙', '丙', '丁', '戊', '己');
		$earth = array('申', '酉', '戌', '亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未');
		$year = $year . '';
		return $sky[ $year{3} ] . $earth[ $year % 12 ];
	}

	/**
	 * 根据阴历年获取生肖
	 * @param int year 阴历年
	 */
	function getYearZodiac($year)
	{
		$zodiac = array('猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊');
		return $zodiac[ $year % 12 ];
	}
}