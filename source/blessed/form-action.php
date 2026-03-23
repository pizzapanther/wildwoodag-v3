<?php
/**
 *  Extract Args
 *  ------------
 */
extract( [

	'your_email_id' 	=> 		'example@gmail.com',

	'form_data'    		=> 		'',

	'subject' 			=>		'Email Subject',

] );

/**
 *  Form Get Method to Update Key and Values
 *  ----------------------------------------
 */
if( isset( $_GET ) &&  is_array( $_GET ) ){

	foreach( $_GET as $key => $value ){

		$form_data 		.=  	$key 	. ' : '  .	stripslashes( $value ) .	"\r\n\n";
	}
}

/**
 *  Sending Email 
 *  -------------
 */
$mail 	= 	@mail( 

				/**
				 *  Admin Email
				 *  -----------
				 */
				$your_email_id, 

				/**
				 *  Subject
				 *  -------
				 */
				isset( $_GET[ 'subject' ] )  &&  ! empty( $_GET[ 'subject' ] )

				?	$_GET[ 'subject' ]

				:	$subject,

				/**
				 *  Form Data
				 *  ---------
				 */
				$form_data, 

				/**
				 *  Header
				 *  ------
				 */
				"From:"		.	$_GET[ 'email' ]
			);

/**
 *  Redirection on Index
 *  --------------------
 */
header( "Location:index.html" );