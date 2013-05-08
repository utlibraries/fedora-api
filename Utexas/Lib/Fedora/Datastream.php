<?php

namespace Utexas\Lib\Fedora;

class Datastream
{
    public $controlGroup = null;
    public $id = null;
    public $state = null;
    public $versionable = null;
    public $versions = array();

    const VERSION_FORMAT_URI = null;
    const VERSION_MIME_TYPE = null;
    const VERSION_LABEL = null;

    public function __construct($id, $controlGroup = 'X', $state = 'A', $versionable = 'true')
    {
        $this->id = strtoupper($id);
        $this->controlGroup = $controlGroup;
        $this->state = $state;
        $this->versionable = $versionable;
        if ($this->versionable == 'true') {
            $this->addVersion();
        }
    }

    public function addVersion()
    {
        $nextVersionId = count($this->versions);
        $this->versions[] = new DatastreamVersion($this->id . '.' . $nextVersionId, static::VERSION_FORMAT_URI, static::VERSION_MIME_TYPE, static::VERSION_LABEL);
    }

    public function getAttrs()
    {
        $attrs = array(
            'CONTROL_GROUP' => $this->controlGroup,
            'ID' => $this->id,
            'STATE' => $this->state,
            'VERSIONABLE' => $this->versionable,
        );
        return $attrs;
    }
}