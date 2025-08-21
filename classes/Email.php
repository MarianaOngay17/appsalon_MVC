<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        $mail = new PHPMailer();

        //configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '37601bc7e85f70';
        $mail->Password = '9181083d10c0b9';
        $mail->SMTPSecure = 'tls';

        //configurar contenido de mail
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';
            
        //habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> 
                        Has creado tu cuenta en App Salon, solo debes 
                        confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
           
        //enviar el email
        if($mail->send()){
            $mensaje = "Mensaje enviado correctamente";
        }else{
            $mensaje = "El mensaje no se pudo enviar...";
        }
    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();

        //configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '37601bc7e85f70';
        $mail->Password = '9181083d10c0b9';
        $mail->SMTPSecure = 'tls';

        //configurar contenido de mail
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu password';
            
        //habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> 
                        Has solicitado reestablecer tu password, sigue
                        el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=". $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
           
        //enviar el email
        if($mail->send()){
            $mensaje = "Mensaje enviado correctamente";
        }else{
            $mensaje = "El mensaje no se pudo enviar...";
        }
    }
}