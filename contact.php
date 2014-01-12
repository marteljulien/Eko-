<?php
/* Set e-mail recipient */
$myemail  = "marteljulien@neuf.fr";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name'], "Entrer votre nom");
$email    = check_input($_POST['email']);
$deja_viendu  = check_input($_POST['deja_viendu']);
$commentaire_orga   = check_input($_POST['commentaire_orga']);
$note_nico = check_input($_POST['note_nico']);

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Name: $name
E-mail: $email
Vous pratiquez: $deja_viendu
Votre message : $commentaire_orga
Like the website? $note_nico


End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.htm');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>