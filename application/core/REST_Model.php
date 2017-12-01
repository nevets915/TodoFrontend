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
	function load()
	{
            // load our data from the REST backend
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $this->_data =  $this->rest->get('/job');
            
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
        
        // Retrieve an existing DB record as an object
        function get($key, $key2 = null)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                return $this->rest->get('/job/' . $key);
        }
        
        // Delete a record from the DB
        function delete($key, $key2 = null)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $this->rest->delete('/job/' . $key);
                $this->load(); // because the "database" might have changed
        }
        
        // Update a record in the DB
        function update($record)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $key = $record->{$this->_keyfield};
                $retrieved = $this->rest->put('/job/' . $key, $record);
                $this->load(); // because the "database" might have changed
        }
        
        // Add a record to the DB
        function add($record)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $key = $record->{$this->_keyfield};
                $retrieved = $this->rest->post('/job/' . $key, $record);
                $this->load(); // because the "database" might have changed
        }
}
