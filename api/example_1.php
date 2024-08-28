<?php
//phpinfo();die;
require_once dirname( __FILE__ ) . '/payu.php';

/* Payments made easy. */

pay_page( array (	'key' => 'GR8ltn', 'txnid' => uniqid( 'animesh_' ), 'amount' => 1,
			'firstname' => 'Test', 'email' => 'tarun-proj.niot@gov.in', 'phone' => '7987787778',
			'productinfo' => 'Product Info', 'surl' => 'payment_success', 'furl' => 'payment_failure'), 'sqUHOq0X' );

/* And we are done. */
			


function payment_success() {
	/* Payment success logic goes here. */
	echo "Payment Success" . "<pre>" . print_r( $_POST, true ) . "</pre>";
}

function payment_failure() {
	/* Payment failure logic goes here. */
	echo "Payment Failure" . "<pre>" . print_r( $_POST, true ) . "</pre>";
}
