<?php 
/**
 *  Data Handler Class
 */

namespace SheesPlugin;
class CLI {
	

	function __construct(){
		add_action( 'cli_init', [$this, 'customCLICommandRegister']);

	}


	public function customCLICommandRegister(){
		\WP_CLI::add_command( 'shees-custom-plugin refresh-data', [$this,'customCLICommand'] );
	}

	public function customCLICommand(){
		$check_data = (new DataHandler)->resetData();
		if($check_data)
			\WP_CLI::success( __('Data Reset Successfully !!','shees-custom-plugin') );
		else
			\WP_CLI::error( __('Data Reset failed !!','shees-custom-plugin'));

	}


	
}