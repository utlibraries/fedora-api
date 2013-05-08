<?php

namespace Utexas\Lib\Fedora;

class RelsExtDatastream extends Datastream
{
    const VERSION_FORMAT_URI = 'info:fedora/fedora-system:FedoraRELSExt-1.0';
    const VERSION_LABEL = 'RDF Statements about this object';
    const VERSION_MIME_TYPE = 'application/rdf+xml';

    public function __construct($id='RELS-EXT', $controlGroup='X', $state='A', $versionable='true')
    {
        parent::__construct($id, $controlGroup, $state, $versionable);
    }
}
