<?php 
/**
 *  Data Handler Class
 */

namespace SheesPlugin;
class RestAPI {
	
	function __construct(){
		// Hook into the rest_api_init action to register the custom endpoint
		add_action( 'rest_api_init', [$this, 'shees_custom_rest_endpoint'] );		
	}


	/**
	 * Registers a custom REST API endpoint.
	 */
	function shees_custom_rest_endpoint() {
	    register_rest_route(
	        'sheescustom/v1', // Namespace for your API route
	        '/data',       // The endpoint path
	        array(
	            'methods'  => 'GET', // HTTP method(s) allowed for this endpoint
	            'callback' => [$this ,'my_custom_rest_callback'], // The function to execute when the endpoint is accessed
	            'permission_callback' => '__return_true', // Or a custom function to check user permissions
	        )
	    );
	}

	
	function my_custom_rest_callback() {

		// code block to check for currnt user request to limit it to reasnoable amount
		$transient_prefix = 'user_ip_base64';
		$user_ip = $_SERVER['REMOTE_ADDR'];

		$transient_ip_check_key =  $transient_prefix.base64_encode($user_ip);

		$count_check  = get_transient($transient_ip_check_key);
		if($count_check === false){
			set_transient($transient_ip_check_key,1,60);
		}elseif($count_check == 10){// limit 10 request in one minute for a user ip
			return new \WP_Error( 'no_data', 'Too Many Requests. Please Wait');
		}else{
			$count_check = $count_check + 1;
			set_transient($transient_ip_check_key,$count_check,60);
		}



		$check_data = (new DataHandler)->getData();
		if(!empty($check_data)){
			$data = $check_data;	
		    return rest_ensure_response( $data );

		}else{
	        return new \WP_Error( 'no_data', 'No data found');
		}
	}


}