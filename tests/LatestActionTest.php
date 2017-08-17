<?php
/**
 * Created by PhpStorm.
 * User: graychen
 * Date: 2017/8/11
 * Time: 上午11:15
 */
namespace zacksleo\yii2\romrelease\tests;

use zacksleo\yii2\romrelease\tests\TestCase as TestCase;
use zacksleo\yii2\romrelease\actions\LatestAction;
use Yii;

class LatestActionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testRunLatest()
    {
        $response = Yii::$app->runAction('romrelease/latest/index');
        $this->assertEquals('1.0', $response['version']);
    }
}
