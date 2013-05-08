<?php

namespace Utexas\Lib\Fedora;

class DatastreamVersion
{
    public $contentDigest = null;
    public $contentLocation = null;
    public $formatUri = null;
    public $id = null;
    public $label = null;
    public $mimeType = null;
    public $xmlContent = null;

    public function __construct($id, $formatUri, $mimeType, $label)
    {
        $this->id = $id;
        if ($formatUri != null) {
            $this->formatUri = $formatUri;
        }
        if ($mimeType != null) {
            $this->mimeType = $mimeType;
        }
        if ($label != null) {
            $this->label = label;
        }
    }

    public function getAttrs()
    {
        $attrs = array(
            'ID' => $this->id,
            'LABEL' => $this->label,
            'MIMETYPE' => $this->mimeType,
            'FORMAT_URI' => $this->formatUri,
        );
        return $attrs;
    }
}
