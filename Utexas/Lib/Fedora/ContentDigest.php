<?php

namespace Utexas\Lib\Fedora;

class ContentDigest
{
    public $type = 'MD5';

    /**
     * Returns object attributes as an array for XML generation.
     *
     * @return array
     */
    public function getAttrs()
    {
        $attrs = array(
            'MD5' => $this->type,
        );
        return $attrs;
    }
}
