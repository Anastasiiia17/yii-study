<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class ImageUpload extends Model{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
       
        if($this->validate())
        {
            if(file_exists(Yii::getAlias('@webroot/') . 'uploads/' . $currentImage))
            {
                unlink(Yii::getAlias('@webroot/') . 'uploads/' . $currentImage);
            }
            
    
            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
    
            $file->saveAs(Yii::getAlias('@webroot/') . 'uploads/' . $filename);
    
            return $filename;
        }
    }
}