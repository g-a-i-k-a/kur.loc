<?php

class Db {

    public function __construct() {
    		$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
				include($ROOT_FOLDER."/config.php");

        $this->quick_connect($MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB, $MYSQL_HOST);
        $this->query("SET NAMES '".$MYSQL_CHARSET."'");

        // set default names
        /*if (version_compare(mysql_get_server_info(), "4.1.0") == '-1') {
            if (!$MYSQL_CHARSET) $MYSQL_CHARSET = 'utf';
            $this->query("SET NAMES '".$MYSQL_CHARSET."'");
            $this->query("SET sql_mode=''");
        }*/
    }

    public function quick_connect($dbuser='', $dbpassword='', $dbname='', $dbhost='localhost') {
        $return_val = false;
        if (!$this->connect($dbuser, $dbpassword, $dbhost, true) || !$this->select($dbname)) {
            throw new Exception("Unable to connect to the database. Check connection settings");
        }

        return true;
    }

    /*     * ********************************************************************
     *  Try to connect to mySQL database server
     */

    public function connect($dbuser='', $dbpassword='', $dbhost='localhost') {
        return ( $this->dbh = @mysql_connect($dbhost, $dbuser, $dbpassword) );
    }

    /*     * ********************************************************************
     *  Try to select a mySQL database
     */

    public function select($dbname='') {
        return ( @mysql_select_db($dbname, $this->dbh) );
    }

    /*     * ********************************************************************
     *  Format a mySQL string correctly for safe mySQL insert
     *  (no mater if magic quotes are on or not)
     */

    public function escape($str) {
        return mysql_real_escape_string(stripslashes($str), $this->dbh);
    }

    public function prepare($str) {
        return mysql_real_escape_string($str, $this->dbh);
    }

    /*     * ********************************************************************
     *  Perform mySQL query and try to detirmin result value
     */

    public function query($query) {

        // For reg expressions
        $query = trim($query);

        // Initialise return
        $return_val = 0;

        // Keep track of the last query for debug..
        $this->last_query = $query;
        // Perform the query via std mysql_query function..
        $this->result = @mysql_query($query, $this->dbh);
        $this->num_queries++;

        // Query was an insert, delete, update, replace
        if (preg_match("/^(insert|delete|update|replace)\s+/i", $query)) {
            $this->rows_affected = @mysql_affected_rows($this->dbh);

            // Take note of the insert_id
            if (preg_match("/^(insert|replace)\s+/i", $query)) {
                $this->insert_id = @mysql_insert_id($this->dbh);
            }

            // Return number fo rows affected
            $return_val = $this->rows_affected;
        }
        // Query was a select
        else {
            // Take note of column info
            $i = 0;
            while ($i < @mysql_num_fields($this->result)) {
                $this->col_info[$i] = @mysql_fetch_field($this->result);
                $i++;
            }

            // Store Query Results
            $num_rows = 0;

            while ($row = @mysql_fetch_object($this->result)) {
                // Store relults as an objects within main array
                $this->last_result[$num_rows] = $row;
                $num_rows++;
            }

            @mysql_free_result($this->result);

            // Log number of rows the query returned
            $this->num_rows = $num_rows;

            // Return number of rows selected
            $return_val = $this->num_rows;
        }

        return $return_val;
    }
        
    function get_var($query=null, $x=0, $y=0) {

        // If there is a query then perform it if not then use cached results..
        if ($query) {
            $this->query($query);
        }

        // Extract var out of cached results based x,y vals
        if ($this->last_result[$y]) {
            $values = array_values(get_object_vars($this->last_result[$y]));
        }

        // If there is a value return it else return null
        return (isset($values[$x]) && $values[$x] !== '') ? $values[$x] : null;
    }

    /*     * ********************************************************************
     *  Get one row from the DB - see docs for more detail
     */

    function get_row($query=null, $output=OBJECT, $y=0) {

        // If there is a query then perform it if not then use cached results..
        if ($query) {
            $this->query($query, $output);
        }

        // If the output is an object then return object using the row offset..
        if ($output == OBJECT) {
            return $this->last_result[$y] ? $this->last_result[$y] : null;
        }
        // If the output is an associative array then return row as such..
        elseif ($output == ARRAY_A) {
            return $this->last_result[$y] ? get_object_vars($this->last_result[$y]) : null;
        }
        // If the output is an numerical array then return row as such..
        elseif ($output == ARRAY_N) {
            return $this->last_result[$y] ? array_values(get_object_vars($this->last_result[$y])) : null;
        }
        // If invalid output type was specified..
        else {
            throw new Exception(" \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N");
        }
    }

    /*     * ********************************************************************
     *  Function to get 1 column from the cached result set based in X index
     *  see docs for usage and info
     */

    function get_col($query=null, $x=0) {

        // If there is a query then perform it if not then use cached results..
        if ($query) {
            $this->query($query);
        }
        $new_array = array();
        // Extract the column values
        for ($i = 0; $i < count($this->last_result); $i++) {
            $new_array[$i] = $this->get_var(null, $x, $i);
        }

        return $new_array;
    }

    /*     * ********************************************************************
     *  Return the the query as a result set - see docs for more details
     */

    function get_results($query=null, $output = OBJECT) {
        
        // If there is a query then perform it if not then use cached results..
        if ($query) {
            $this->query($query, $output);
        }
        // Send back array of objects. Each row is an object
        if ($output == OBJECT) {
            return $this->last_result;
        } elseif ($output == ARRAY_A || $output == ARRAY_N ) {
            if ($this->last_result) {
                $i = 0;
                foreach ($this->last_result as $row) {

                    $new_array[$i] = get_object_vars($row);

                    if ($output == ARRAY_N) {
                        $new_array[$i] = array_values($new_array[$i]);
                    }

                    $i++;
                }

                return $new_array;
            } else {
                return null;
            }
        }
    }
}

?>