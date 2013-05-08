<?php

namespace Utexas\Lib\Fedora;

class DcDatastream extends Datastream
{
    public $metadata = array();
    public $xmlContent = null;

    const VERSION_FORMAT_URI = 'http://www.openarchives.org/OAI/2.0/oai_dc/';
    const VERSION_MIME_TYPE = 'text/xml';
    const VERSION_LABEL = 'Dublin Core Record';

    public function __construct($id='DC', $controlGroup='X', $state='A', $versionable='true')
    {
        parent::__construct($id, $controlGroup, $state, $versionable);
    }

    public function getMetadatum($name)
    {
        if (!array_key_exists($name, $this->metadata)) {
            throw new Exception('Metadata value for ' . $name . ' does not exist.');
        }
        return $this->metadata[$name];
    }

    public function setMetadatum($name, $value)
    {
        $this->metadata[$name] = $value;
    }
}
