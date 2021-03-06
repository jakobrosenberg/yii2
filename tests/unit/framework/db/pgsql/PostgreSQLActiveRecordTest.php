<?php

namespace yiiunit\framework\db\pgsql;

use yiiunit\framework\db\ActiveRecordTest;

/**
 * @group db
 * @group pgsql
 */
class PostgreSQLActiveRecordTest extends ActiveRecordTest
{
	protected $driverName = 'pgsql';

	public function testBooleanAttribute()
	{
		$this->markTestSkipped('Storing boolean values does not work in PostgreSQL right now. See https://github.com/yiisoft/yii2/issues/1115 for details.');
	}
}
