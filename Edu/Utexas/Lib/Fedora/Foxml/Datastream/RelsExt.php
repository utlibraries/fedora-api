<?php

namespace Edu\Utexas\Lib\Fedora\Foxml;

class RelsExtDatastream extends Datastream
{
    private $relationships = array();

    const VERSION_FORMAT_URI = 'info:fedora/fedora-system:FedoraRELSExt-1.0';
    const VERSION_LABEL = 'RDF Statements about this object';
    const VERSION_MIME_TYPE = 'application/rdf+xml';

    /**
     * Constructor method.
     *
     * @param string $parentPid
     * @param string $id
     * @param string $controlGroup
     * @param string $state
     * @param string $versionable
     */
    public function __construct($parentPid, $id='RELS-EXT', $controlGroup='X', $state='A', $versionable='true')
    {
        parent::__construct($parentPid, $id, $controlGroup, $state, $versionable);
    }

    /**
     * Add an RDF relationship to the RELS-EXT datastream.
     *
     * @param string $predicate
     * @param string $predicateNsUri
     * @param string $objectPid
     * @return RelsExtDatastream
     */
    public function addRelationship(
        $predicate,
        $predicateNsUri = 'info:fedora/fedora-system:def/relations-external#',
        $objectPid) {
        $this->relationships[] = array(
            'predicate' => $predicate,
            'predicate_ns_uri' => $predicateNsUri,
            'object_pid' => $objectPid,
        );
        return $this;
    }

    /**
     * Get the XML representation of the RDF relationships.
     *
     * @return string
     */
    public function getRdfXml()
    {
        if (count($this->relationships) > 0) {
            $rdfXml = new SimpleXMLElement('<rdf:RDF
               xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
               xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
               xmlns:fedora="info:fedora/fedora-system:def/relations-external#"
               xmlns:myns="http://www.nsdl.org/ontologies/relationships#" />');

            $rdfDescription = $rdfXml->addChild('rdf:Description');
            $rdfDescription->addAttribute('rdf:about', 'info:fedora/' . $this->parentPid);

            foreach ($this->relationships as $relationship) {
                $fedoraRelationship = $rdfDescription->addChild(
                                          $relationship['predicate'],
                                          null,
                                          $relationship['predicate_ns_uri']);
                $fedoraRelationship->addAttribute(
                    'rdf:resource',
                    $relationship['object_pid'],
                    'http://www.w3.org/1999/02/22-rdf-syntax-ns#'
                );
            }
            return $rdfXml->asXml();
        } else {
            return null;
        }
    }

}
