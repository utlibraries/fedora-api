<?php

namespace Utexas\Lib\Fedora;

class ContentLocation
{
    public $ref = null;
    public $type = null;

    public function getAttrs()
    {
        $attrs = array(
            'REF' => $this->ref,
            'TYPE' => $this->type
        );
        return $attrs;
    }
}
