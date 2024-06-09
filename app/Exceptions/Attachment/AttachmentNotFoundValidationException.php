<?php

namespace App\Exceptions\Attachment;

use Exception;

class AttachmentNotFoundValidationException extends Exception
{
    public function map($request)
    {
        return redirect()->back()->withErrors(['Ошибка!']);
    }
}
