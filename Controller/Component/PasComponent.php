<?php
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
		if (!is_array($url)) {
			return $this->controller->redirect($url);
		}

		$request = $this->controller->request;
		$named = $request->named;
		$query = array();
		if (!empty($request->query)) {
			$query['?'] = $request->query;
		}

		$url = Set::merge($query, $named, $url);
		$this->controller->redirect($url);
	}

}