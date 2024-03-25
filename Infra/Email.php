<?php

namespace Infra;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

	private $oPHPMailer;

	public function __construct() {
		$aConfig = JSONConfig::getInstance()->loadConfig('SMTP');
		$this->oPHPMailer = new PHPMailer(true);
		$this->oPHPMailer->isSMTP();
		
		$this->oPHPMailer->Host = $aConfig['host'];
		$this->oPHPMailer->SMTPAuth = true;
		$this->oPHPMailer->Username = $aConfig['user'];
		$this->oPHPMailer->Password = $aConfig['password'];
		$this->oPHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$this->oPHPMailer->Port = 587;
		
		$this->oPHPMailer->setFrom($aConfig['emailFrom'], $aConfig['nameFrom']);
	}

	public function setDestinatario(string $sNome, string $sEmail): void {
		$this->oPHPMailer->addAddress($sEmail, $sNome);
	}

	public function setAssunto(string $sAssunto): void {
		$this->oPHPMailer->Subject = $sAssunto;
	}

	public function setMensagem(string $sMensagem): void {
		$this->oPHPMailer->Body = $sMensagem;
	}

	public function enviar(): void {
		if (!$this->oPHPMailer->send()) {
			throw new Exception($this->oPHPMailer->ErrorInfo);
		}
	}

}