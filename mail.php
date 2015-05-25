<?php
if($_POST) { 
$name = substr(htmlspecialchars(trim($_POST['name'])), 0, 1000); 
$email = $_POST['email'];
$message = substr(htmlspecialchars(trim($_POST['message'])), 0, 1000000);
$formcontent="\n Имя: $name \n Почта: $email\n Сообщение: $message";
$recipient = "glebuar@gmail.com";
$mailheader = "Почта: $email \r\n";
$success = "\u0421\u043F\u0430\u0441\u0438\u0431\u043E\u002C\u0020\u0412\u0430\u0448\u0435\u0020\u0441\u043E\u043E\u0431\u0449\u0435\u043D\u0438\u0435\u0020\u043E\u0442\u043F\u0440\u0430\u0432\u043B\u0435\u043D\u043E\u0021";
$nonsuccess = "\u0421\u043E\u043E\u0431\u0449\u0435\u043D\u0438\u0435\u0020\u041D\u0415\u0020\u043E\u0442\u043F\u0440\u0430\u0432\u043B\u0435\u043D\u043E\u002E \\n\\n\u041F\u043E\u0436\u0430\u043B\u0443\u0439\u0441\u0442\u0430\u002C\u0020\u043F\u043E\u0434\u0442\u0432\u0435\u0440\u0434\u0438\u0442\u0435\u002C\u0020\u0447\u0442\u043E\u0020\u0412\u044B\u0020\u0447\u0435\u043B\u043E\u0432\u0435\u043A\u0021";

$recaptcha_secret = "6LctbQYTAAAAAB3_Vha3vHPYN8Ff41xDF_ruvSsJ";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
        $response = json_decode($response, true);
        if($response["success"] === true)
        {
            
			if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['message'])) exit(header("Location: /"));
			mail($recipient, $mailheader, $formcontent) or die("Error!"); 
			
			echo ("<script type='text/javascript'>
			window.alert('$success')
			window.location.href='index.html'
					</script>");
        }
        else
        {
          	echo ("<script type='text/javascript'>
			window.alert('$nonsuccess')
			window.location.href='index.html#tf-contact'
					</script>");
			
		}
}
?>