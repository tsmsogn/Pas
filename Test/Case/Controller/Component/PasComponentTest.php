<?php
App::uses('Controller', 'Controller');
App::uses('PasComponent', 'Pas.Controller/Component');

class TestPasComponent extends PasComponent {

}

class TestPasController extends Controller {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'TestPas');

/**
 * Overwrite redirect
 *
 * @param string $url The URL to redirect to
 * @param string $status Not used
 * @param bool|string $exit Not used
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}

}

/**
 * PasComponent Test Case
 *
 */
class PasComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Controller = new TestPasController(new CakeRequest(), new CakeResponse());
		$this->Controller->Components->init($this->Controller);
		$this->Pas = $this->Controller->TestPas;
		$this->Pas->startup($this->Controller);

		$this->Controller->request->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array()
		);
		$this->Controller->request->query = array();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pas);
		unset($this->Controller);

		parent::tearDown();
	}

/**
 * testPasRedirect
 *
 * @return void
 */
	public function testPasRedirect() {
		$this->Controller->action = 'index';

		$this->Pas->pasRedirect(array('action' => 'index'));
		$expected = array(
			'action' => 'index',
		);
		$this->assertEqual($expected, $this->Controller->redirectUrl);

		// Test for named and query
		$this->Controller->request->params['named'] = array('page' => 1);
		$this->Controller->request->query = array('foo' => 'bar');

		$this->Pas->pasRedirect(array('action' => 'index'));
		$expected = array(
			'action' => 'index',
			'page' => 1,
			'?' => array(
				'foo' => 'bar'
			)
		);
		$this->assertEqual($expected, $this->Controller->redirectUrl);

		// Test for overriding
		$expected = array(
			'action' => 'index',
			'page' => 2,
			'?' => array(
				'foo' => 'baz'
			)
		);
		$this->Pas->pasRedirect(array('action' => 'index', 'page' => 2, '?' => array('foo' => 'baz')));
		$this->assertEqual($expected, $this->Controller->redirectUrl);
	}

}
