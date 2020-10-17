<?php

namespace App\Serializer;

use App\Entity\File;
use App\Ref\FileRef;

class FileSerializer
{
    public function serialize(File $file): FileRef
    {
        $ref = new FileRef();
        $ref->name = $file->getName();
        $ref->url = $file->getUrl();
        $ref->size = $file->getSize();
        $ref->createdAt = $file->getCreatedAt()->format('Y-m-d H:i:s');

        return $ref;
    }
}
