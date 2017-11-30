<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the CSV file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with an empty collection
		$this->_data = array(); // an array of objects
		$this->_fields = array(); // an array of strings
                if (file_exists($this->_origin)) 
                {
                    // and populate the collection
                    $this->load();

                } 
                else 
                {
                    exit('Failed to open test.xml.');
                }
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
            $collection = simplexml_load_file($this->_origin);
            $temp = array();
            foreach ($collection as $entity)
            {
                $object = (object)(array)$entity;
                array_push($temp, (object)$object);
            }
            $this->_data = $temp;
            foreach ($this->_data as $entity)
            {
                foreach($entity as $key => $value)
                    array_push($this->_fields, $key);
                break;
            }
            // --------------------
            // rebuild the keys table
            $this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
            // rebuild the keys table
            $this->reindex();
            
            $domDoc = new DOMDocument;
            $rootElt = $domDoc->createElement($this->_entity . 's');
            $rootNode = $domDoc->appendChild($rootElt);
            foreach($this->_data AS $row) {
                $rowElement = $domDoc->createElement($this->_entity);
                foreach($row AS $key => $value) {
                    if($value == NULL)
                        $value = 'NULL';
                    $element = $domDoc->createElement($key);
                    $element->appendChild($domDoc->createTextNode($value));
                    $rowElement->appendChild($element);
                }
                $rootNode->appendChild($rowElement);
            }
            $data = $domDoc->saveXML();
            //var_dump($data);
            file_put_contents($this->_origin, $data);
	}

}
