<?php

class statistic {
	
    var $timeout 	= 300; // seconds
    var $total_online 		= 0;
    var $total_view 		= 0;
	
    function stat_online(){
        global $data, $REMOTE_ADDR; 
        $current_time = time();
        $time_exit = $current_time - $this->timeout;    
        $data->query("INSERT INTO $data->table_stat_online (timestamp, ip) VALUES ('$current_time', '$REMOTE_ADDR')");                
        $data->query("DELETE FROM $data->table_stat_online WHERE timestamp < $time_exit");
        // total online
        $query_total_online = $data->query("SELECT DISTINCT ip FROM $data->table_stat_online");       
        $this->total_online = $data->num_rows($query_total_online);
        return $this->total_online;
    }
    
    function stat_view(){
        global $data, $REMOTE_ADDR; 
        $query_exist = $data->query("SELECT ip FROM $data->table_stat_view WHERE ip='".$REMOTE_ADDR."'");
        $result_exist = $data->num_rows($query_exist);
        if($result_exist < 1){
        	$data->query("INSERT INTO $data->table_stat_view (ip) VALUES ('$REMOTE_ADDR')"); 
    	}               
        // total view
        $query_total_view = $data->query("SELECT ip FROM $data->table_stat_view");  
        $this->total_view = $data->num_rows($query_total_view);
        return $this->total_view;
    }
}
?>
