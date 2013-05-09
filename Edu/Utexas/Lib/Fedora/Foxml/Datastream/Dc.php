<?php

namespace Edu\Utexas\Lib\Fedora\Foxml\Datastream;

class Dc extends InternalXml
{
    public $metadata = array();
    public $xmlContent = null;

    const VERSION_FORMAT_URI = 'http://www.openarchives.org/OAI/2.0/oai_dc/';
    const VERSION_MIME_TYPE = 'text/xml';
    const VERSION_LABEL = 'Dublin Core Record';

    /**
     * Constructor method.
     *
     * @param string $parentPid
     * @param string $id
     * @param string $controlGroup
     * @param string $state
     * @param string $versionable
     */
    public function __construct($parentPid, $id='DC', $controlGroup='X', $state='A', $versionable='true')
    {
        parent::__construct($parentPid, $id, $controlGroup, $state, $versionable);
    }
    /**
     * Get a Dublin Core metadata value.
     *
     * @param  string $name
     * @return string
     */
    public function getMetadatum($name)
    {
        if (!array_key_exists($name, $this->metadata)) {
            throw new Exception('Metadata value for ' . $name . ' does not exist.');
        }
        return $this->metadata[$name];
    }
    /**
     * Set a Dublin Core metadata value.
     *
     * @param string $name
     * @param string $value
     * @return DcDatastream
     */
    public function setMetadatum($name, $value)
    {
        $this->metadata[$name] = $value;
        return $this;
    }
}
