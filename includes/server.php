<?php


if(!isset( $_SESSION )){
	
	
	// server should keep session data for AT LEAST 1 hour
	//ini_set('session.gc_maxlifetime', 31234567);

	// each client should remember their session id for EXACTLY 1 hour
	session_set_cookie_params(987654321);
	
	@session_start();
}



//echo  ini_get('session.gc_maxlifetime') ;

if ( isset ( $_SESSION[ 'user_id' ] ) ){
	
    $user_id = $_SESSION[ 'user_id' ];
	
}

if( isset ( $_COOKIE['safety']  )  ){
	
	 $user_id = $_COOKIE['safety']  / 2583110;
	
}


$myerrors =[];
$loginErrors = [];

//if the register button is clicked
if(isset($_POST['signup'])){
    $yourname = filter_var ( $_POST['yourname'] , FILTER_SANITIZE_STRING ) ;
    $username = filter_var ( $_POST['username'] , FILTER_SANITIZE_STRING );
    $email = filter_var ( $_POST['email'] , FILTER_SANITIZE_STRING ) ;
    $phone = filter_var ( $_POST['phone'] , FILTER_SANITIZE_STRING );
    $password_1 = filter_var ( $_POST['password_1'] , FILTER_SANITIZE_STRING )  ;
    $password_2 = filter_var ( $_POST['password_2'] , FILTER_SANITIZE_STRING ) ;
    
    //profile image 
    $avatarName = filter_var ( $_FILES['avatar']['name']  , FILTER_SANITIZE_STRING ) ; 
    $avatarSize = $_FILES['avatar']['size'];
    $avatarTmp = $_FILES['avatar']['tmp_name'];
    
    //ensure that form fields are filled properly
    if (empty($yourname)){
        array_push($myerrors, "Your name is required");
    }
    
    if (empty($email)){
        array_push($myerrors, "Email is required");
    }
    
    $stmt = $pdo->prepare('SELECT email  FROM s_users WHERE email = ?');
    $stmt->execute([$email]);
    $used_email = $stmt->fetch();
    if (isset($used_email['email'])){
        array_push($myerrors, "Email is used befor to sing up , please sing in");
    }
    
   if (empty($password_1)){
        array_push($myerrors, "Password is required");
    }
    if($password_1 !=$password_2){
        array_push($myerrors, "The tow passwords do not match");   
    }
    
    //lecExtension security
    $accepted_types = array("png" , "jpg" , "jpeg" , "");
    $avatarNameArray = explode("." , $avatarName );
    $avatarExtension = strtolower(end( $avatarNameArray ));
   
    if(!in_array($avatarExtension , $accepted_types)){
		array_push($myerrors , "file type( " . $avatarExtension . ") is not supported,see support files");
	}
  
    //if there are no errors,save user to db
      if (count($myerrors)==0){
        $password = password_hash ( $password_1 , PASSWORD_DEFAULT );
        
        //upload
       if(!is_dir('uploads')){
  	  mkdir('uploads');
   	 mkdir('uploads/avatars');
   	 chmod('uploads/avatars' , 0755);
  	}
  	  
        if($avatarName !== ""){
   	 $avatar = rand(0,10000) . '_' . $avatarName;
    	move_uploaded_file($avatarTmp ,   'uploads/avatars//' . $avatar);
        }else{
           //default profile photo
           $avatar= "user.jpeg" ;
        }  
        //encrypt password before storing in db(security)
        $sql = "INSERT INTO s_users (name,  username, avatar,email, phone, password) VALUES( :yourname, :username,:avatar, :email,:phone, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['yourname' => $yourname , 'username' => $username ,'avatar' =>$avatar, 'email' => $email ,'phone' => $phone, 'password' => $password]);
        
        $_SESSION[ 'user_id' ] = $pdo->lastInsertId();
        
  	     header('location: dashboard.php');
  	     exit;
   	 }
    
   }
    
    //log user in form login page
    if(isset($_POST['login'])){
        
    $email = filter_var ( $_POST['email']  , FILTER_SANITIZE_STRING ) ;
    $password = filter_var ( $_POST['password']  , FILTER_SANITIZE_STRING ) ;
    //ensure that form fields are filled properly
    if (empty($email)){
        array_push($loginErrors , "email is required");
    }
    if (empty($password)){
    	array_push($loginErrors, "Password is required");
    }
    
     if (count($loginErrors) == 0) {
     	
   	 $sql ="SELECT * FROM s_users WHERE email = :email";
    	$stmt = $pdo->prepare($sql);
    	$result = $stmt->execute(['email' => $email ]);
    	$info = $stmt->fetch();
    	$password_status = password_verify( $password, $info['password'] );
    	$count = $stmt->rowCount();
    
    	if( $count == 1  &&  $password_status == true ){
        //log user in
        $stmt = $pdo->prepare('SELECT id  FROM s_users WHERE email = ?');
        $stmt->execute([$email]);
        $id = $stmt->fetch();

        $_SESSION['user_id'] = $id[0];

        //swich acount 
        header('location: dashboard.php');
        exit;
  	
  	   }else{
     	   array_push($loginErrors, "Email or password is wrong ");
   	  }
 	 }
  
}
    
//---facebook login---

@$fb_user_data = $_SESSION['userData'];

if(isset($_GET['fb_login'])  && isset($fb_user_data['id'])   ){
	
	//check if it in DB
	$sql ="SELECT id FROM s_users WHERE fb_id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $fb_user_data['id'] ]);
	$id = $stmt->fetch();
	$count = $stmt->rowCount();
	
	//frist time
	if( $count == 0 ){
		$sql = "INSERT INTO s_users ( fb_id, fb_name,  fb_first_name, fb_last_name, fb_avatar, fb_email, fb_access_token ) VALUES(?,?,?,?,?,?,? )";
		$stmt = $pdo->prepare($sql);
		@$stmt->execute([ $fb_user_data['id'], $fb_user_data['name'] , $fb_user_data['first_name'] ,  $fb_user_data['last_name'] ,  $fb_user_data['picture']['url'] ,  $fb_user_data['email'] , $_SESSION['access_token']] );
       	 
		$_SESSION['user_id'] = $pdo->lastInsertId();
		
	//socond time
	}elseif( $count == 1 ){
		
		$_SESSION['user_id'] = $id[0];
		
	}
	
}

    
//user info
if(isset( $user_id )){
    
    $sql ="SELECT * FROM s_users WHERE id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $user_id ]);
    $user = $stmt->fetch();
    
    if(isset($user['name'])){
    	$user_name =$user['name'] ;
    }else{
    	$user_name =$user['fb_name'] ;
    }
    
    if(isset($user['avatar'])){
    	$user_avatar = $root .  "/uploads/avatars/"  . $user['avatar'] ;
    }elseif( isset( $user['fb_avatar'] )){
    	$user_avatar = $user['fb_avatar'] ;
    }else{
    	 $user_avatar = 'https://img.icons8.com/ultraviolet/80/000000/user.png' ;
    }
    
}

/*
//allowed pages for non-rigested visitors
$alllowed_pages = ["search.php","download.php", "fileLove.php", "server.php", "register.php", "getSectionContent.php", "about.php","privacy.php" ,"book.php", "books.php", "groupProfile.php",  "groupMembers.php", "profile.php"];
$page_name = basename($_SERVER['PHP_SELF']);


if(empty ($_SESSION[ 'user_id' ])  && empty($user_id) && !in_array( $page_name, $alllowed_pages ) ){

	header("location: " .  $root .  "/register.php");
	exit;

}
  
*/