<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptsData
{
    public static function bootEncryptsData()
    {
        static::saving(function ($model) {
            foreach ($model->encrypted as $field) {
                if ($model->isDirty($field)) {
                    $model->{$field} = Crypt::encryptString($model->{$field});
                }
            }
        });

        static::retrieved(function ($model) {
            foreach ($model->encrypted as $field) {
                try {
                    $model->{$field} = Crypt::decryptString($model->{$field});
                } catch (\Exception $e) {
                    // Field might not be encrypted or already decrypted
                }
            }
        });
    }
}
