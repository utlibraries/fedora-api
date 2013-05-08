<?php

namespace Utexas\Lib\Fedora;

require_once 'DcDatastream.php';
require_once 'RelsExtDatastream.php';

class DataObject
{
    public $pid = null;
    public $label = null;
    public $state = null;
    public $version = null;
    private $datastreams = array();

    public function __construct($pid, $label, $state = 'A', $version = '1.1')
    {
        $this->pid = $pid;
        $this->label = $label;
        $this->state = $state;
        $this->version = $version;
        $this->datastreams[] = new DcDatastream($this->pid);
        $this->datastreams[] = new RelsExtDatastream($this->pid);
    }

    public function addDatastream(Datastream $datastream)
    {
        $this->datastreams[] = $datastream;
        return $this;
    }

    public function getAttrs()
    {
        $attrs = array(
            'PID' => $this->pid,
            'VERSION' => $this->version,
        );
    }

    public function asXml()
    {
        $dataObjectXml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
            <foxml:digitalObject xmlns:foxml="info:fedora/fedora-system:def/foxml#"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="info:fedora/fedora-system:def/foxml#
                http://www.fedora.info/definitions/1/0/foxml1-1.xsd" />');
        foreach ($this->getAttrs() as $key => $value) {
            $dataObjectXml->addAttribute($key, $value);
        }

        $objectProperties = $dataObjectXml->addChild('foxml:objectProperties');

        $stateProperty = $objectProperties->addChild('foxml:property');
        $stateProperty->addAttribute('NAME', 'info:fedora/fedora-system:def/model#state');
        $stateProperty->addAttribute('VALUE', $this->state);

        $labelProperty = $objectProperties->addChild('foxml:property');
        $labelProperty->addAttribute('NAME', 'info:fedora/fedora-system:def/model#label');
        $labelProperty->addAttribute('VALUE', $this->label);

        if (count($this->datastreams) > 0) {
            foreach ($this->datastreams as $datastream) {
                $datastreamXml = $dataObjectXml->addChild('foxml:datastream');
                foreach ($datastream->getAttrs() as $key => $value) {
                    if ($value != null) {
                        $datastreamXml->addAttribute($key, $value);
                    }
                }
                foreach ($datastream->versions as $version) {
                    $versionXml = $datastreamXml->addChild('foxml:datastreamVersion');
                    foreach ($version->getAttrs() as $key => $value) {
                        if ($value != null) {
                            $versionXml->addAttribute($key, $value);
                        }
                    }
                    if ($version->xmlContent != null) {
                        $xmlContent = $versionXml->addChild('foxml:xmlContent');
                        simpleXmlAppend($xmlContent, $this->xmlContent);
                    }
                    if ($version->contentDigest != null) {
                        $contentDigestXml = $versionXml->addChild('foxml:contentDigest');
                        foreach ($version->contentDigest->getAttrs() as $key => $value) {
                            if ($value != null) {
                                $contentDigestXml->addAttribute($key, $value);
                            }
                        }
                    }
                    if ($version->contentLocation) {
                        $contentLocationXml = $versionXml->addChild('foxml:contentLocation');
                        foreach ($version->contentLocation->getAttrs() as $key => $value) {
                            if ($value != null) {
                                $contentLocationXml->addAttribute($key, $value);
                            }
                        }
                    }
                }
            }
        }
        return $dataObjectXml->asXml();
    }
}
