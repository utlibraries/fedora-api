<?php

namespace Utexas\Lib\Fedora;

class ContentLocation
{
    public $ref = null;
    public $type = null;

    /**
     * Returns object attributes as an array for XML generation.
     *
     * @return array
     */
    public function getAttrs()
    {
        $attrs = array(
            'REF' => $this->ref,
            'TYPE' => $this->type
        );
        return $attrs;
    }
}
