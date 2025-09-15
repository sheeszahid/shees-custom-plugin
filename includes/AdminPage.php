<?php 
/**
 *  Admin Page render class
 */

namespace SheesPlugin;

class AdminPage {
	
	
	function __construct(){
		// Hook into the 'admin_menu' action
		add_action( 'admin_menu', [$this,'my_custom_admin_page'] );
	}


	function my_custom_admin_page() {
	    add_menu_page(
	        'Custom Shees Plugin', // Page title
	        'Custom Shees Plugin',       // Menu title
	        'manage_options',       // Capability required to access the page
	        'shees-custom-plugin',       // Menu slug (unique identifier)
	        [$this,'my_custom_plugin_page_content'], // Callback function to render the page content
	        'dashicons-admin-generic', // Icon for the menu item (optional)
	        99                      // Position in the menu (optional)
	    );
	}



	function my_custom_plugin_page_content() {
		$data_hanlder = new DataHandler(); // data class object
		$data = [];
		if ( isset( $_POST['reset_form'] ) ) { // Check if the form was submitted
		    check_admin_referer( 'my_custom_form_action_field', 'custom_plugin_reset_action' );
			$check_data = $data_hanlder->resetData(); // fetching data
			if($check_data !== false){
				$data = $check_data;
				 echo  __('Data Reset Successfully !!','shees-custom-plugin') ;
			}else{
				 echo  __('Data Reset Failed !!','shees-custom-plugin') ;
			}

		}else{
			$data = $data_hanlder->getData(); // fetching data
		}

		if(!empty($data)){ // if not false & not empty
			?>
		    <div class="wrap">
		        <h1>My Custom Admin Page</h1>
		        <p>This is the content of my custom admin page.</p>

		        <form method="post" class="custom-plugin-reset-form">
		        	<input type="submit" name="reset_form" class="custom-plugin-reset-form-btn" value="<?php echo __('Reset Users','shees-custom-plugin'); ?>">
		        	<?php wp_nonce_field( 'my_custom_form_action_field', 'custom_plugin_reset_action' ); ?>
		        </form>

		        <table>
					<tr>
						<th><?php echo __('ID','shees-custom-plugin');?></th>
						<th><?php echo __('Name','shees-custom-plugin');?></th>
						<th><?php echo __('Email','shees-custom-plugin');?></th>
						<th><?php echo __('Address','shees-custom-plugin');?></th>
						<th><?php echo __('Phone','shees-custom-plugin');?></th>
					</tr>
					<?php
		          	foreach ($data as $record) { 
		          		$address_string = '';

		          		if(!empty($record['address'])){
		          			if(!empty($record['address']['suite'])){
		          				$address_string .= $record['address']['suite'];
							}
							if(!empty($record['address']['street'])){
		          				$address_string .= ' '.$record['address']['street'];
							}
							if(!empty($record['address']['city'])){
		          				$address_string .= ' '.$record['address']['city'];
							}
							if(!empty($record['address']['zipcode'])){
		          				$address_string .= ' '.$record['address']['zipcode'];
							}
						}
		          		?>
		          		<tr>
							<td><?php echo esc_html($record['id']);?></td>
							<td><?php echo esc_html($record['name']);?></td>
							<td><?php echo esc_html($record['email']);?></td>
							<td><?php echo esc_html($address_string);?></td>
							<td><?php echo esc_html($record['phone']);?></td>
						</tr>
		          	<?php } ?>
		        </table>
		    </div>
		    <?php
		}	
	}	

	
}