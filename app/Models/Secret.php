<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    public function getFileSizeHumanAttribute()
    {
        $size = $this->file_size;

        $exts = ['kb', 'mb', 'gb'];
        $ext = 'b';

        while ($size > 1024 && count($exts)) {

            $ext = array_shift($exts);
            $size /= 1024;

        }

        return number_format($size, 2) . $ext;
    }
}
