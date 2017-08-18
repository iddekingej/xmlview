<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

/**
 * A data layer sits between the controller and the view.
 * The controller processes the request. The DataLayer processes the data
 * so it can be used in a view. The controller can pass data to the DataLayer 
 * by the parent object 
 * The data can be filled in the parent data store or a new Datastore can be made
 */
interface DataLayer
{
    /**
     * Processes and retrieves data necessary for the view.
     * 
     * @param DataStore $p_parent   Parent DataStore
     * @return DataStore            DataStore with data
     */
    function processData(DataStore $p_parent):DataStore;    
}
