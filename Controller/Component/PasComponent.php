<?php
App::uses('Pas', 'Pas.Lib');
App::uses('Component', 'Controller');

class PasComponent extends Component {

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings = Set::merge($this->settings, $settings);
		parent::__construct($collection, $this->settings);
	}

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @return void
 */
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}

/**
 * Redirects to URL which is generated from given $url and current request query params, after turning off $this->autoRender.
 * Script execution is halted after the redirect.
 *
 * @param string|array $url A string or array-based URL pointing to another location within the app,
 *     or an absolute URL
 * @param int|array|null $status HTTP status code (eg: 301). Defaults to 302 when null is passed.
 * @param bool $exit If true, exit() will be called after the redirect
 * @return \Cake\Network\Response|null
 */
	public function pasRedirect($url = null, $status = null, $exit = true) {
		$url = Pas::parse($this->controller->request, $url);
		$this->controller->redirect($url, $status, $exit);
	}

}