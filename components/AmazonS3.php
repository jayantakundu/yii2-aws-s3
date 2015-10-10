<?php
/**
 * @author: Jayanta Kundu
 */
namespace app\components;

class AmazonS3 extends \yii\base\Component
{
    public $bucket;
    public $key;
    public $secret;

    private $_client;

    public function init()
    {
        parent::init();

        $this->_client = \Aws\S3\S3Client::factory(array(
            'credentials' => array(
                'key'    => $this->key,
                'secret' => $this->secret,
            ),
            'region' => 'ap-southeast-1',
            'version' => '2006-03-01'
        ));

    }

    /**
     * Uploads the file into S3 in that bucket.
     *
     * @param string $filePath Full path of the file. Can be from tmp file path.
     * @param string $fileName Filename to save this file into S3. May include directories.
     * @param bool $bucket Override configured bucket.
     * @return bool|string The S3 generated url that is publicly-accessible.
     */
    public function uploadFile($filePath, $fileName, $bucket = false)
    {
        if (!$bucket) {
            $bucket = $this->bucket;
        }

        try {
            $result = $this->_client->putObject([
                    'ACL' => 'public-read',
                    'Bucket' => $bucket,
                    'Key' => $fileName,
                    'SourceFile' => $filePath,
                    'ContentType' => \yii\helpers\FileHelper::getMimeType($filePath),
                ]);

            return $result->get('ObjectURL');
        } catch (\Exception $e) {
            return false;
        }
    }
}
