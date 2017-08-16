<?php
/**
 * Created by PhpStorm.
 * User: graychen
 * Date: 2017/8/11
 * Time: 上午11:15
 */

namespace zacksleo\yii2\romrelease\tests;

use zacksleo\yii2\romrelease\tests\TestCase as TestCase;
use yii\web\UploadedFile;
use yii;

class RomReleaseControllerTest extends TestCase
{
    public $romrelease;

    public function setUp()
    {
        parent::setUp();
        $this->romrelease = $this->create();
    }

    public function testCreate()
    {
        $data = [
            'RomRelease' => [
                'version' => '1.0',
                'version_code' => '版本代号',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('romrelease/romrelease/create');
        $this->delete($response->id);
    }

    public function testUpdate()
    {
        $data = [
            'RomRelease' => [
                'version' => '1.0',
                'version_code' => '版本代号',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('romrelease/romrelease/create');
        $this->assertTrue($response->id > 0);
        $data['RomRelease']['id'] = $response->id;
        $data['RomRelease']['version'] = '2.0';
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('romrelease/romrelease/update', ['id' => $response->id]);
        $this->assertTrue($response->id > 0);
        $this->view($response->id);
        $this->delete($response->id);
    }

    public function delete($id)
    {
        $reponse = Yii::$app->runAction('romrelease/romrelease/delete', ['id' => $id]);
        $this->assertTrue($reponse > 0);
    }


    private function create()
    {
        $data = [
            'RomRelease' => [
                'version' => '1.0',
                'version_code' => '版本代号',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'md5' => '324234234234',
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $romrelease = Yii::$app->runAction('romrelease/romrelease/create');
    }

    private function view($id)
    {
        $response = Yii::$app->runAction('romrelease/romrelease/view', ['id' => $id]);
        $this->assertTrue($response->id == $id);
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
            ]
        ];
    }
}
