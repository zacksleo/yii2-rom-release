<?php
/**
 * Created by PhpStorm.
 * User: graychen
 * Date: 2017/8/11
 * Time: 上午11:15
 */
namespace zacksleo\yii2\romrelease\tests;

use zacksleo\yii2\romrelease\models\RomRelease;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use Yii;

class RomReleaseTest extends TestCase
{
    public function testMdule()
    {
        $module=Yii::$app->getModule('romrelease');
        $module->init();
    }

    public function setUp()
    {
        parent::setUp();
        $this->model=new RomRelease();
        $db = Yii::$app->getDb();
        $db->createCommand()->insert('tb_rom_release', [
            'version' => '1.0',
            'version_code' => '版本代号',
            'is_forced' => 1,
            'url' => 'test.png',
            'md5' => 'MD5',
            'status' => 1,
            'description' => '发布说明',
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testRules()
    {
        //version is required
        $this->model->version = $this->faker->word;
        $this->assertTrue($this->model->validate(['version']));
        $this->model->version = null;
        $this->assertFalse($this->model->validate(['version']));
        //description is required
        $this->model->description = $this->faker->word;
        $this->assertTrue($this->model->validate(['description']));
        $this->model->description = null;
        $this->assertFalse($this->model->validate(['description']));
        //is_forced is integer
        $this->model->is_forced = $this->faker->randomDigitNotNull;
        $this->assertTrue($this->model->validate(['is_forced']));
        $this->model->is_forced = $this->faker->word;
        $this->assertFalse($this->model->validate(['is_forced']));
        //status default value is 1
        $this->assertEquals(1, $this->model->validate(['status']));
        //status is integer
        $this->model->status = $this->faker->randomDigitNotNull;
        $this->assertTrue($this->model->validate(['status']));
        $this->model->status = $this->faker->word;
        $this->assertFalse($this->model->validate(['status']));

        $this->model->description = $this->generatestring->getchars_t("a", 256);
        $this->assertFalse($this->model->validate(['description']));
        $this->model->description = $this->generatestring->getchars_t("a", 255);
        $this->assertTrue($this->model->validate(['description']));

        $this->model->version = $this->generatestring->getchars_t("a", 256);
        $this->assertFalse($this->model->validate(['version']));
        $this->model->version = $this->generatestring->getchars_t("a", 255);
        $this->assertTrue($this->model->validate(['version']));

        $this->model->url = $this->faker->image($dir = '/tmp', $width = 640, $height = 480);
        $this->assertTrue($this->model->validate(['url']));
    }

    /**
    * @brief 测试添加
    *
    * @return
    */
    public function testAdd()
    {
        $this->model->version='1.0';
        $this->model->version_code='版本代号';
        $this->model->is_forced=1;
        $this->model->url=UploadedFile::getInstanceByName('Document[file]');
        $this->model->status=1;
        $this->model->description='发布说明';
        $this->model->md5='324234234234';
        $this->model->created_at=time();
        $this->model->updated_at=time();
        $this->assertTrue($this->model->save());
    }

    public function testUpdate()
    {
        $this->model->setScenario('update');
        $this->model->id=1;
        $this->model->version='2.0';
        $this->model->version_code='版本代号2';
        $this->model->is_forced=1;
        $this->model->url=UploadedFile::getInstanceByName('Document[file]');
        $this->model->status=1;
        $this->model->description='发布说明';
        $this->model->md5='324234234234';
        $this->model->created_at=time();
        $this->model->updated_at=time();
        $this->assertTrue($this->model::findOne(1)->save());
    }

    /**
    * @brief 测试查询
    *
    * @return
    */
    public function testFind()
    {
        $dataProvider = new ActiveDataProvider([
                    'query' => RomRelease::find(),
        ]);
        $this->assertTrue($dataProvider instanceof ActiveDataProvider);
        $hospital = $dataProvider->getModels();
        $this->assertEquals('1.0', $hospital['0']['version']);
    }

    /**
    * @brief 测试单个查询
    *
    * @return
    */
    public function testView()
    {
        $view=$this->model->findOne(1);
        $this->assertEquals('1', $view['id']);
    }

    /**
    * @brief 测试删除
    *
    * @return
    */
    public function testDelete()
    {
        $this->assertEquals('1', $this->model->findOne(1)->delete());
    }

    public function testGetStatusList()
    {
        $status = RomRelease::getStatusList();
        $this->assertTrue(count($status) == 2);
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $_FILES = [
            'Document[file]' => [
                'name' => 'test-file.txt',
                'type' => 'text/plain',
                'size' => 12,
                'tmp_name' => __DIR__ . '/data/test-file.txt',
                'error' => 0,
            ],
            'Document[file-other]' => [
                'name' => 'test-file-other.txt',
                'type' => 'text/plain',
                'size' => 12,
                'tmp_name' => __DIR__ . '/data/test-file-other.txt',
                'error' => 0,
            ],
        ];
    }
}
