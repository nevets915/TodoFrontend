<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class REST_Model extends Memory_Model
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

	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	function load()
	{
            // load our data from the REST backend
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $this->_data =  $this->rest->get('job');

            // rebuild the field names from the first object
            $one = array_values((array) $this->_data);
            $this->_fields = array_keys((array)$one[0]);
            // --------------------
            // rebuild the keys table
            $this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	function store()
	{
	}       
        function get($key, $key2 = null)
        function delete($key, $key2 = null)
        function update($record)
        function add($record)
}
