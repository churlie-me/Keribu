<?php
/**
 * This User will have functions that hadles user registeration,
 * login and forget password functionality
 * @author muni
 * @copyright www.smarttutorials.net
 */
class Cl_User
{
	/**
	 * @var will going contain database connection
	 */
	protected $_con;
	
	/**
	 * it will initalize DBclass
	 */
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;
	}
	
	/**
	 * this will handles user registration process
	 * @param array $data
	 * @return boolean true or false based success 
	 */
	public function registration( array $data )
	{
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			
			
			// escape variables for security
			$first_name = mysqli_real_escape_string( $this->_con, $trimmed_data['first_name'] );
			$last_name = mysqli_real_escape_string( $this->_con, $trimmed_data['last_name'] );
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );
			
			
			// Check for an email address:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email']);
			} else {
				throw new Exception( "Please enter a valid email address!" );
			}
			
			if((!$name) || (!$email) || (!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = sha1( $password );
			$query = "INSERT INTO client VALUES (NULL, '$email', '$first_name', '$last_name', '$name', '' , '$password', '', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query)){
				return true;
			}
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
	/**
	 * This method will handle user login process
	 * @param array $data
	 * @return boolean true or false based on success or failure
	 */
	public function login( array $data )
	{
		$_SESSION['logged_in'] = false;
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );
				
			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = sha1( $password );
			$query = "SELECT client_ID, email, fName, lName, uName FROM client where email = '$email' and password = '$password' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}
	
	/**
	 * This method will handle Facebook login
	 * @param array $data
	 * @throws Exception
	 * @return boolean true or false based on success or failure
	 */
	
	public function fb_login( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
		}	
		
		// escape variables for security
		$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
		$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
		$social_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
		
		
		$query = "SELECT client_ID, email, uName, acc_date FROM client where email = '$email' and social_id = '$social_id' ";
		$result = mysqli_query($this->_con, $query);
		$data = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
		if( $count == 1){
			$_SESSION = $data;
			$_SESSION['logged_in'] = true;
			return true;
		}else{
			
			$query = "INSERT INTO client VALUES (NULL, '$email', '', '' '$name', '', '', '$social_id', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query));
			$query = "SELECT client_ID, email, uName, acc_date FROM client where email = '$email' and social_id = '$social_id' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		}
			
		
	}
	
	/**
	 * This method will handle google login
	 * @param array $data
	 * @throws Exception
	 * @return boolean true or false based on success or failure
	 */
	
	public function google_login( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
		}
		
		// escape variables for security
		$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
		$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
		$social_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
		$picture = mysqli_real_escape_string( $this->_con, $trimmed_data['picture'] );
		
		$query = "SELECT client_ID, email, uName, acc_date FROM client where email = '$email' and social_id = '$social_id'";
		$result = mysqli_query($this->_con, $query);
		$data = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
		if( $count == 1){
			$_SESSION = $data;
			$_SESSION['logged_in'] = true;
			return true;
		}else{
				$query = "INSERT INTO client VALUES (NULL, '$email', '', '' '$name', '$picture', '', '$social_id', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query));
			$query = "SELECT client_ID, email, uName, acc_date FROM client where email = '$email' and social_id = '$social_id'";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		}
	}
	
	/**
	 * This will handle twitter login
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	
	public function twitter_login( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
		}
		
		// escape variables for security
		$social_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
		$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
		$screen_name = mysqli_real_escape_string( $this->_con, $trimmed_data['screen_name'] );
		$picture = mysqli_real_escape_string( $this->_con, $trimmed_data['picture'] );
		
		$query = "SELECT client_ID, email, uName, acc_date FROM client where social_id = '$social_id'";
		$result = mysqli_query($this->_con, $query);
		$data = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
		if( $count == 1){
			$_SESSION = $data;
			$_SESSION['logged_in'] = true;
			return true;
		}else{
		$query = "INSERT INTO client VALUES (NULL, '', '', '' '$name', '$picture', '', '$social_id', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query));
			$query = "SELECT client_ID, email, uName, acc_date FROM client where social_id = '$social_id'";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		}
	}
	
	
	/**
	 * This will shows account information and handles password change
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	
	public function account( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = mysqli_real_escape_string( $this->_con, $trimmed_data['user_id'] );
			
			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = sha1( $password );
			$query = "UPDATE client SET password = '$password' WHERE client_ID = $user_id";
			if(mysqli_query($this->_con, $query))return true;
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This handle sign out process
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		unset($_SESSION['oauth_token']);
		unset($_SESSION['oauth_token_secret']);
		header('Location: index.php');
	}
	
	/**
	 * This reset the current password and send new password to mail
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	public function forgetPassword( array $data )
	{
		if( !empty( $data ) ){
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );
			
			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			$password1 = sha1( $password );
			$query = "UPDATE client SET password = '$password1' WHERE email = $email";
			if(mysqli_query($this->_con, $query)){
				$to = $email;
				$subject = "New Password Request";
				$txt = "Your New Password ".$password;
				$headers = "From: admin@smarttutorials.net" . "\r\n" .
						"CC: admin@smarttutorials.net";
					
				mail($to,$subject,$txt,$headers);
				return true;
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This will generate random password
	 * @return string
	 */
	
	private function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	
	
	public function pr($data = ''){
		echo "<pre>"; print_r( $data ); echo "</pre>";
	}
}