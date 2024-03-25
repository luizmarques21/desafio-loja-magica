<?php

namespace Model;

class TipoUsuario {

	const ADMINISTRADOR = 'A';
	const COMUM = 'C';

	public static function getArrayCombo(): array {
		return [
			self::ADMINISTRADOR => ['id' => self::ADMINISTRADOR, 'value' => 'Administrador'],
			self::COMUM => ['id' => self::COMUM, 'value' => 'Comum']
		];
	}

}