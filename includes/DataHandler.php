<?php 
/**
 *  Data Handler Class
 */

namespace SheesPlugin;

class DataHandler {
	
	private $url_path = 'https://jsonplaceholder.typicode.com/users';
	private $transient_key_name = 'custom_plugin_nonce_data';
	private $transient_expiry = 3600;
	
	function __construct(){
		
	}

	public function getData(){

		// making sure not fetch api response on every call
		$check_data = get_transient($this->transient_key_name);
		if($check_data !== false){ // false means transient does not exsist( or expired )
			return $check_data;
		}
		
		$args = array(
		    'timeout'     => 10
		);

		// Make the remote GET request
		$response = wp_remote_get( $this->url_path, $args );


		if ( is_wp_error( $response ) ) { // response is wordpress error
		    $error_message = $response->get_error_message();
		    error_log("Error making remote request: $error_message"); // silent log
		} else { 
		    
		    // Retrieve the response body
		    $body = wp_remote_retrieve_body( $response );

		    // Decode JSON response if applicable
		    $data = json_decode( $body,true ); 

		    // Process the retrieved data
		    if ( is_array($data) ) { // if array means valid json
		    	// store valid valuet to cache
		    	set_transient($this->transient_key_name,$data,$this->transient_expiry);
		    	return $data;
			} else {
		        error_log("Failed to decode JSON");
		    }
		}

		
		return false;

	}

	public function resetData(){
		delete_transient($this->transient_key_name);
		return $this->getData();
	}
	
}