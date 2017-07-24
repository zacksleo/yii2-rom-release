<?php

namespace zacksleo\yii2\romrelease\models;

use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use zacksleo\yii2\romrelease\Module;
use zacksleo\yii2\romrelease\behaviors\UploadBehavior;

/**
 * This is the model class for table "{{%app_release}}".
 *
 * @property integer $id
 * @property integer $version
 * @property integer $is_forced
 * @property string $url
 * @property string $md5
 * @property integer $status
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property UploadedFile $releaseFile
 */
class RomRelease extends \yii\db\ActiveRecord
{
    public $file;
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rom_release}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version', 'description'], 'required'],
            [['is_forced', 'status'], 'integer'],
            [['is_forced', 'status'], 'default', 'value' => 1],
            [['description', 'version'], 'string', 'max' => 255],
            ['md5', 'string', 'max' => 255, 'on' => ['save']],
            [['url'], 'file',
                //'extensions' => 'apk',
                'skipOnEmpty' => true,
                'tooBig' => 'app文件大小不超过120M',
                'maxFiles' => 1,
                'maxSize' => 120 * 1024 * 1024,
                'on' => ['insert', 'update']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('romrelease', 'ID'),
            'version' => Module::t('romrelease', 'version'),
            'is_forced' => Module::t('romrelease', 'is forced'),
            'url' => Module::t('romrelease', 'url'),
            'md5' => Module::t('romrelease', 'MD5'),
            'status' => Module::t('romrelease', 'status'),
            'description' => Module::t('romrelease', 'description'),
            'created_at' => Module::t('romrelease', 'created at'),
            'updated_at' => Module::t('romrelease', 'updated at'),
            'file' => Module::t('romrelease', 'File'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'url',
                'scenarios' => ['insert', 'update'],
                'path' => '@frontend/web/uploads/apps',
                'url' => '@web/uploads/apps',
            ],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['url'] = function () {
            $path = str_replace('api/uploads/', '', $this->getUploadUrl('url'));
            if (isset($_ENV['API_HOST'])) {
                $url = $_ENV['API_HOST'] . 'files/' . $path;
            } else {
                $url = Url::to(['file/view', 'path' => $path], true);
            }
            return $url;
        };
        unset($fields['id'], $fields['created_at'], $fields['status'], $fields['updated_at']);
        return $fields;
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_UNPUBLISHED => Module::t('romrelease', 'unpublished'),
            self::STATUS_PUBLISHED => Module::t('romrelease', 'published'),
        ];
    }
}
