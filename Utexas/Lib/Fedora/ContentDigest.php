<?php

namespace Utexas\Lib\Fedora;

class ContentDigest
{
    public $type = 'MD5';

    public function getAttrs()
    {
        $attrs = array(
            'MD5' => $this->type,
        );
        return $attrs;
    }
}
