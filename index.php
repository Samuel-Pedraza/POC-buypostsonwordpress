<?php  get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Purchase Posts</h1>
			<form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" id="payment-form">
				<div class="form-group">
					<label>Username</label>
					<input type="hidden" name="action" value="purchase_posts"">
					<input type="text" name="register_username" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="register_email" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="register_password" class="form-control">
				</div>
				<div class="form-group">
					<label>Password Verification</label>
					<input type="password" name="compare_registered_password" class="form-control">
				</div>
				<div class="form-group">
					<label>Amount of Posts to Purchase</label>
					<select class="form-control" name="amount_of_posts">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
				<div class="form-group">
					<div id="card-element" class="form-control">
      			<!-- a Stripe Element will be inserted here. -->
    			</div>				
				</div>
				<div class="form-group">
					<button class="btn btn-primary">Submit</button>
				</div>
				<div class="form-group">
					<p id="card-errors" role="alerts"></p>
				</div>
			</form>
			
		</div>
	</div>
</div>
<?php get_footer(); ?>
