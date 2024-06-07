<?php

namespace App\Repository\Attachments;

use Illuminate\Database\Eloquent\Model;

class AttachmentsRepository
{
    public function getById(Model $model, int $id): bool
    {
        if (!empty($model->getMedia()->where('id', $id)->first())) {
            return true;
        }

        return false;
    }
}
