<?php
 include_once "swift/swift_required.php";
 if(isset($_POST['sendBtn'])){
   $fromName = $_SESSION['username'] + " from Anspirit";
   $fromEmail = $_SESSION['username'] + "@anspirit.org";
   $toName = $_POST['toName'];
   $toEmail = $_POST['toEmail'];
   $mailHeader = $_POST['header'];
   $mailContent = $_POST['content'];

   $text = $mailContent;
   $html = $mailContent;
   // This is your From email address
   $from = array($fromEmail => $fromName);
   // Email recipients
   $to = array(
         $toEmail=>$toName
   );
   // Email subject
   $subject = $mailHeader;

   // Login credentials
   $username = 'azure_2eba721938d24ffa0fb3a2d9fde6cc43@azure.com';
   $password = 'Junction2015';

   // Setup Swift mailer parameters
   $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
   $transport->setUsername($username);
   $transport->setPassword($password);
   $swift = Swift_Mailer::newInstance($transport);

   // Create a message (subject)
   $message = new Swift_Message($subject);

   // attach the body of the email
   $message->setFrom($from);
   $message->setBody($html, 'text/html');
   $message->setTo($to);
   $message->addPart($text, 'text/plain');

   // send message
   if ($recipients = $swift->send($message, $failures))
   {
       // This will let us know how many users received this message
       echo 'Message has been sent';
   }
   // something went wrong =(
   else
   {
       echo "Something went wrong - ";
       print_r($failures);
   }
 }
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Anspirit email</title>
   </head>
   <body>
         <p>You are logged in as <?=$_SESSION['username']?></p>
         <p><a href="../admin/index.php?logout=1">Logout</a></p>

      <!-- Mail UI -->
      <form method="post">
         <table>
           <tr>
             <td>
               <h3>To name: </h3>
             </td>
             <td>
               <input type="text" name="toName">
             </td>
           </tr>
           <tr>
             <td>
               <h3>To email: </h3>
             </td>
             <td>
               <input type="email" name="toEmail">
             </td>
           </tr>
           <tr>
             <td>
               <h3>Header: </h3>
             </td>
             <td>
               <input type="text" name="header">
             </td>
           </tr>
           <tr>
             <td>
               <h3>Content: </h3>
             </td>
             <td>
               <textarea name="content" rows="20" cols="40"></textarea>
             </td>
           </tr>
           <tr>
             <td><input type="submit" value="Send" name="sendBtn"></td>
           </tr>
         </table>
      </form>
   </body>
 </html>
