# Yii2 AWS S3
Yii2 AWS S3
An Amazon S3Client wrapper as Yii2 component.

## Installation
Run Composer to install latest aws sdk
```php
composer require aws/aws-sdk-php
```

Add component to `config/main.php`
```php
'components' => [
// ...
's3' => array (
            'class' => 'app\components\AmazonS3',
            'key' => 'your aws s3 key',
            'secret' => 'your aws s3 secret',
            'bucket' => 'your aws s3 bucket',
        ),
// ...        
],        
```
## Usage

## Uploading files
```php
$tmp_name=$_FILES['image']['tmp_name'];
yii::$app->s3->uploadFile($tmp_name, 'path/to/s3/file.ext');
```
