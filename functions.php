<?php 
require_once('vendor/autoload.php');

function enqueue_bootstrap(){
	wp_enqueue_style("bootstrap", "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
	wp_enqueue_script("jquery"); 
	wp_enqueue_script("popper", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js");
	wp_enqueue_script("bootstrapJS", "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js");
	wp_enqueue_script("stripeJS", "https://js.stripe.com/v3/", array(), '', false, true);
}


add_action("wp_enqueue_scripts", "enqueue_bootstrap");

\Stripe\Stripe::setApiKey("");

function charge_per_post(){

	$token = $_POST['stripeToken'];
	(int)$posts_paid = $_POST["amount_of_posts"];
	$cost = 100;

	\Stripe\Charge::create([
		"amount" =>  $posts_paid * $cost,
		"currency" => "usd",
		"source" => $token
	]);

	$username = $_POST["register_username"];
	$email = $_POST["register_email"];
	$pwd = $_POST["register_password"];

	
	$user_id = wp_insert_user(array('user_login' => $username, 'user_email' => $email, 'user_pass' => $pwd, "role" => "author"));

	if(!is_wp_error($user_id)){
		add_option($user_id, $posts_paid);
	}

	wp_redirect("/?success");
}

add_action("admin_post_purchase_posts", "charge_per_post");
add_action("admin_post_nopriv_purchase_posts", "charge_per_post");

function check_if_ran_out(){
	$current_user = wp_get_current_user();

	if(count_user_posts($current_user->id) >= get_option($current_user->id)){
		$current_user->remove_role('author');
		$current_user->add_role('subscriber');
	}
}

add_action("init", "check_if_ran_out");