<?php 
	
	class sendmail extends spController{
	
		
		function index(){
			
			if(!isset($_POST['email'])){
				print "<!Doctype html>
					<html>
						<head>
							<title></title>
						</head>
						<body>
							<form action=\"index.php?c=sendmail\" method=\"post\">
							To:<input type=\"text\" name=\"email\" />
								<input type=\"submit\" value=\"Send Mail\" />
							</form>
						</body>
					</html>
				";
				exit(0);
			}else{
			
				import('extensions/nie-message/nie-mail.php');
				$mail=new nieMail;
				$result=$mail->write(array(
					'subject'=>'This is Subject',
					'body'=>'<h2>This is Content!</h2>',
					'to'=>array($_POST['email'])
				))->send();
				
				if($result){
					echo 'Message sented!';
				}
			}
		}
	
	
	}

?>