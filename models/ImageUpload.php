<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        $path = Yii::getAlias('@web') . 'uploads/' . $currentImage;

        if (!empty($currentImage) && file_exists($path)) {
            unlink($path);
        }

        $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);

        $file->saveAs(Yii::getAlias('@web') . 'uploads/' . $filename);

        return $file->name;
    }
}