<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\imagine\Image;
use Imagine\Image\Box;
use backend\components\Settings;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string  $username
 * @property string  $full_name
 * @property string  $photo
 * @property string  $auth_key
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string  $password
 *
 * @property Job[]   $jobs
 * @property Job[]   $notPaidJobs
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    public $userPhoto;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const SCENARIO_ADD             = 'add';
    const SCENARIO_UPDATE          = 'update';
    const SCENARIO_UPDATE_LOGIN    = 'updateLogin';
    const SCENARIO_UPDATE_FULLNAME = 'updateFullName';
    const SCENARIO_UPDATE_PASSWORD = 'updatePassword';
    const SCENARIO_UPLOAD          = 'upload';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required', 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_LOGIN, self::SCENARIO_UPDATE]],
            [
                'username', 'unique',
                'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.',
                'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_LOGIN, self::SCENARIO_UPDATE]
            ],
            ['username', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_LOGIN, self::SCENARIO_UPDATE]],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_LOGIN, self::SCENARIO_UPDATE]],

            ['full_name' ,'required', 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_FULLNAME, self::SCENARIO_UPDATE]],
            [
                'full_name', 'unique',
                'targetClass' => '\common\models\User', 'message' => 'This full name has already been taken.',
                'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_FULLNAME, self::SCENARIO_UPDATE]
            ],
            ['full_name', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_FULLNAME, self::SCENARIO_UPDATE]],
            ['full_name', 'string', 'min' => 2, 'max' => 255, 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_FULLNAME, self::SCENARIO_UPDATE]],

            [['status', 'created_at', 'updated_at'], 'integer', 'on' => self::SCENARIO_ADD],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255, 'on' => self::SCENARIO_ADD],
            [['auth_key'], 'string', 'max' => 32, 'on' => self::SCENARIO_ADD],
            [['password_reset_token'], 'unique', 'on' => self::SCENARIO_ADD],

            ['password', 'required', 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE]],
            ['password', 'string', 'min' => 6, 'on' => [self::SCENARIO_ADD, self::SCENARIO_UPDATE_PASSWORD]],


            [['userPhoto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_UPLOAD],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'username'   => Yii::t('app', 'Login'),
            'full_name'  => Yii::t('app', 'Full name'),
            'photo'      => Yii::t('app', 'Photo'),
            'email'      => 'Email',
            'status'     => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password'   => Yii::t('app', 'Password'),
            'toPay'      => Yii::t('app', 'toPay'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['performer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotPaidJobs()
    {
        return $this->hasMany(Job::className(), ['performer_id' => 'id'])->where(['pay' => '0']);
    }

    public function uploadPhoto()
    {
        $status          = false;
        $this->scenario  = self::SCENARIO_UPLOAD;
        $this->userPhoto = UploadedFile::getInstance($this, 'photo');

        if (! is_null($this->userPhoto) && $this->validate()) {
            $dir       = '/upload/user-photo/original/' . $this->id;
            $photoPath = $this->userPhoto->baseName . '.' . $this->userPhoto->extension;
            $imageDir  = Yii::getAlias('@webroot') . $dir;

            if (! file_exists($imageDir)) {
                $isCreate = mkdir($imageDir, 0777, true);
            }

            if (is_writable($imageDir)) {
                $save = $this->userPhoto->saveAs($imageDir . '/' . $this->userPhoto->baseName . '.' . $this->userPhoto->extension);
                if ($save) {
                    $this->userPhoto = null;
                    $this->photo = $photoPath;
                    $this->save();
                    $status = true;
                }
            }
        }

        $this->scenario = self::SCENARIO_ADD;
        return $status;
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function isPhoto()
    {
        if ($this->photo == '') {
            return false;
        } else {
            return true;
        }
    }

    public function getPhotoPreview($width, $height)
    {
        $status = false;

        if ($this->photo != '') {
            $photo      = Yii::getAlias('@webroot') . '/upload/user-photo/original/' . $this->id . '/' . $this->photo;
            $cacheDir   = Yii::getAlias('@webroot') . '/upload/user-photo/cache/' . $this->id;
            $photoPath  = '/upload/user-photo/cache/' . $this->id . '/' . $width . 'x' . $height . '-' . $this->photo;
            $cachePhoto = Yii::getAlias('@webroot') . $photoPath;

            if (file_exists($cachePhoto)) {
                $status = $photoPath;
            } else {
                if (! file_exists($cacheDir)) {
                    mkdir($cacheDir, 0777, true);
                }

                if (file_exists($photo)) {
                    Image::getImagine()
                        ->open($photo)
                        ->thumbnail(new Box($width, $height))
                        ->save($cachePhoto, ['quality' => 100]);

                    $status = $photoPath;
                }
            }
        }

        return $status;
    }

    public function getToPay()
    {
        $toPay = 0;
        /* @var $job Job*/
        foreach ($this->notPaidJobs as $job) {
            $toPay += $job->getPerformerPrice();
        }

        return $toPay;
    }

    public function isAdmin(): bool {
        return in_array($this->id, $this->settings()->admin()->getIds());
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    protected function settings(): Settings
    {
        return Yii::$container->get(Settings::class);
    }
}
