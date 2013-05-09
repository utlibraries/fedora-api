<?php

namespace Edu\Utexas\Lib\Fedora\Foxml;

class DatastreamVersion
{
    public $contentDigest = null;
    public $contentLocation = null;
    public $formatUri = null;
    public $id = null;
    public $label = null;
    public $mimeType = null;
    public $xmlContent = null;

    /**
     * Constructor method.
     *
     * @param string $id
     * @param string $formatUri
     * @param string $mimeType
     * @param string $label
     */
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

    /**
     * Returns object attributes as an array for XML generation.
     *
     * @return array
     */
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
