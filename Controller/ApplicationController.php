<?php

use Infra\DependencyContainer;
use Infra\Globals;

class ApplicationController {

	protected $oView;
	protected $oGlobals;
	protected $oSessao;

	public function __construct(Globals $oGlobals) {
		$this->oView = DependencyContainer::getView();
		$this->oGlobals = $oGlobals;
		$this->oSessao = DependencyContainer::getSessao();
	}

}