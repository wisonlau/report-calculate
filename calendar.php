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

require_once 'src/Traits/CalendarTrait.php';

use Report\Calculate\Traits\CalendarTrait;

class Test
{
	use CalendarTrait;

	public function doing()
	{
		var_dump($this->diffBetweenTwoDays('2018-12-21 01:00:00', '2018-12-22 00:00:01'));
		var_dump($this->timeTran('2018-12-22 01:00:00'));
		var_dump($this->getDateFromRange('2018-12-01 01:00:00', '2018-12-30 00:00:01'));
		var_dump($this->getMonthDays('2018-11-01 01:00:00'));
		var_dump($this->isLeapYear(date('Y', time())));
		var_dump($this->getMonthStartEnd(date('Y', time()),date('m', time())));
		var_dump($this->getWeekStartEnd(date('Y', time()), 1));
		var_dump( $this->getCapitalNum(date('d', time()), false) );
		var_dump( $this->getWeek(time()) );
	}
}

(new Test())->doing();
