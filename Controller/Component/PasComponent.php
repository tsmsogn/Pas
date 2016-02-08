<?php
App::uses('Pas', 'Pas.Lib');
App::uses('Component', 'Controller');

class PasComponent extends Component {

/**
 * @param ComponentCollection $collection
 * @param array $settings
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings = Set::merge($this->settings, $settings);
		parent::__construct($collection, $this->settings);
	}

/**
 * @param Controller $controller
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}

/**
 * @param null $url
 */
	public function pasRedirect($url = null) {
		$url = Pas::parse($this->controller->request, $url);
		$this->controller->redirect($url);
	}

}