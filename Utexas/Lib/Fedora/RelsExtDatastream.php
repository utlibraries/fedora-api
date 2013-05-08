<?php

namespace Utexas\Lib\Fedora;

class RelsExtDatastream extends Datastream
{
    private $parentPid = null;
    private $relationships = array();

    const VERSION_FORMAT_URI = 'info:fedora/fedora-system:FedoraRELSExt-1.0';
    const VERSION_LABEL = 'RDF Statements about this object';
    const VERSION_MIME_TYPE = 'application/rdf+xml';

    public function __construct($id='RELS-EXT', $controlGroup='X', $state='A', $versionable='true')
    {
        parent::__construct($id, $controlGroup, $state, $versionable);
    }

    public function addRelationship(
        $predicate,
        $predicateNsUri = 'info:fedora/fedora-system:def/relations-external#',
        $object) {
        $this->relationships[] = array(
            'predicate' => $predicate,
            'predicate_ns_uri' => $predicateNsUri,
            'object' => $object,
        );
    }

    public function getRdfXml()
    {
        if (count($this->relationships) > 0) {
            $rdfXml = new SimpleXMLElement('<rdf:RDF
               xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
               xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
               xmlns:fedora="info:fedora/fedora-system:def/relations-external#"
               xmlns:myns="http://www.nsdl.org/ontologies/relationships#" />');

            $rdfDescription = $rdfXml->addChild('rdf:Description');
            $rdfDescription->addAttribute('rdf:about', 'info:fedora/' . $parentPid);

            foreach ($this->relationships as $relationship) {
                $fedoraRelationship = $rdfDescription->addChild(
                                          $relationship['predicate'],
                                          null,
                                          $relationship['predicate_ns_uri']);
                $fedoraRelationship->addAttribute(
                    'rdf:resource',
                    $relationship['object'],
                    'http://www.w3.org/1999/02/22-rdf-syntax-ns#'
                );
            }
            return $rdfXml->asXml();
        } else {
            return null;
        }
    }

}
