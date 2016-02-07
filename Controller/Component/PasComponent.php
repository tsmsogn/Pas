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
		$pass = $named = $query = $queryParameters = array();

		if (!is_array($url)) {
			$url = Router::parse($url);
		}

		if (isset($url['pass'])) {
			$pass = $url['pass'];
			unset($url['pass']);
		}
		if (isset($url['named'])) {
			$named = $url['named'];
			unset($url['named']);
		}
		if (isset($url['?'])) {
			$queryParameters = $url['?'];
			unset($url['?']);
		}

		if (!is_array($queryParameters)) {
			parse_str($queryParameters, $queryParameters);
		}

		$request = $this->controller->request;

		$named = Set::merge($request->named, $named);
		$queryParameters = Set::merge($this->controller->request->query, $queryParameters);

		if (!empty($queryParameters)) {
			$query = array('?' => $queryParameters);
		}

		$url = Set::merge($query, $named, $pass, $url);
		$this->controller->redirect($url);
	}

}