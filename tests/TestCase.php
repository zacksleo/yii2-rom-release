<?php
namespace yii\web;
/**
 * Mock for the is_uploaded_file() function for web classes.
 * @return boolean
 */
function is_uploaded_file($filename)
{
    return file_exists($filename);
}
/**
 * Mock for the move_uploaded_file() function for web classes.
 * @return boolean
 */
function move_uploaded_file($filename, $destination)
{
    return copy($filename, $destination);
}
namespace zacksleo\yii2\romrelease\tests;

use Yii;
use yii\helpers\ArrayHelper;
use Faker\Factory;
use graychen\generatestring;

/**
 * This is the base class for all yii framework unit tests.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $model;
    protected $faker;
    protected $generatestring;
    protected function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
        $this->createTestDbData();
        $this->faker=Factory::create('zh_CN');     //伪数据生成器
        $this->generatestring=new generatestring;  //string生成器
    }
    protected function tearDown()
    {
        $this->destroyTestDbData();
        $this->destroyApplication();
        unset($this->model);
    }

    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost:3306;dbname=test',
                    'username'=> 'root',
                    'password'=> '206065',
                    'tablePrefix' => 'tb_'
                   //'dsn' => 'sqlite::memory:',
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules' => [
                'romrelease' => [
                    'class' => 'zacksleo\yii2\romrelease\Module',
                    'controllerNamespace' => 'zacksleo\yii2\romrelease\tests\controllers'
                ]
            ]
        ], $config));
    }
    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }
    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        if (\Yii::$app && \Yii::$app->has('session', true)) {
            \Yii::$app->session->close();
        }
        \Yii::$app = null;
    }
    protected function destroyTestDbData()
    {
        $db = Yii::$app->getDb();
        $res = $db->createCommand()->dropTable('tb_rom_release')->execute();
    }
    protected function createTestDbData()
    {
        $db = Yii::$app->getDb();
        try {
            $db->createCommand()->createTable('tb_rom_release', [
                'id' => 'pk',
                'version' => 'string(100) not null' ,
                'version_code' => 'string(100)' ,
                'is_forced' =>  'tinyint(1) not null',
                'url' => 'string(100) not null' ,
                'md5' => 'string(100) default null' ,
                'status' => 'tinyint(1)',
                'description' => 'text',
                'created_at' => 'integer(11) not null',
                'updated_at' => 'integer(11) not null'
            ])->execute();
            $db->createCommand()->insert('tb_rom_release', [
                'version' => '1.0',
                'version_code' => '版本代号',
                'is_forced' => 1,
                'url' => 'test.png',
                'md5' => 'MD5sdfsdfsdf',
                'status' => 1,
                'description' => '发布说明',
                'created_at' => time(),
                'updated_at' => time(),
            ])->execute();
        } catch (Exception $e) {
            return;
        }
    }
}
