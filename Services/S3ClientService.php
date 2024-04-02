<?php

namespace ProyectoSC502\Services;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use finfo;


class S3ClientService
{
    private static $s3Client;

    public static function create(): S3Client
    {
        $config = parse_ini_file('config.ini');

        if (self::$s3Client === null) {
            self::$s3Client = new S3Client([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => [
                    'key' => $config['AWS_ACCESS_KEY_ID'] ?? null,
                    'secret' => $config['AWS_SECRET_ACCESS_KEY'] ?? null,
                ],
            ]);
        }

        return self::$s3Client;
    }

    public static function uploadImage($userId, $localFilePath)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/webp', 'image/png', 'image/gif'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($localFilePath);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            error_log("El archivo no es una imagen: " . $mimeType);
            return null;
        }

        $timestamp = time();
        $objectKey = "profile-photos/{$userId}/profile-photo-{$timestamp}.jpg";


        $s3Client = self::create();

        try {
            $s3Client->putObject([
                'Bucket' => 'proyectosc-502',
                'Key' => $objectKey,
                'SourceFile' => $localFilePath,
            ]);
            return "https://d1copppaysyuhz.cloudfront.net/" . $objectKey;
        } catch (S3Exception $exception) {
            error_log($exception->getMessage());
            return null;
        }
    }

}