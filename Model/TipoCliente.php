<?php

namespace Model;

class TipoCliente {

	const PESSOA = 'P';
	const LOJA = 'L';

	public static function getArrayCombo(): array {
		return [
			self::PESSOA => ['id' => self::PESSOA, 'value' => 'Pessoa'],
			self::LOJA => ['id' => self::LOJA, 'value' => 'Loja']
		];
	}

	public static function getValueById(string $sId): string {
		$aaCombo = self::getArrayCombo();
		return $aaCombo[$sId]['value'] ?? '';
	}

}