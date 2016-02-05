<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('PasFormHelper', 'Pas.View/Helper');

/**
 * PasFormHelper Test Case
 *
 */
class PasFormHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->PasForm = new PasFormHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PasForm);

		parent::tearDown();
	}

/**
 * testPasPostLink method
 *
 * @return void
 */
	public function testPasPostLink() {
		$result = $this->PasForm->pasPostLink('Delete', array('controller' => 'posts', 'action' => 'delete', 1));
		$expected = array(
			'form' => array(
				'method' => 'post', 'action' => '/posts/delete/1',
				'name' => 'preg:/post_\w+/', 'id' => 'preg:/post_\w+/', 'style' => 'display:none;'
			),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/form'
		);
		$this->assertTags($result, $expected);

		$request = $this->PasForm->request;
		$request->named = array('page' => 1);
		$request->query = 'foo=bar';

		// Test for named and query
		$result = $this->PasForm->pasPostLink('Delete', array('controller' => 'posts', 'action' => 'delete', 1));
		$expected = array(
			'form' => array(
				'method' => 'post', 'action' => '/posts/delete/1/page:1?foo=bar',
				'name' => 'preg:/post_\w+/', 'id' => 'preg:/post_\w+/', 'style' => 'display:none;'
			),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/form'
		);
		$this->assertTags($result, $expected);

		// Test for overriding
		$result = $this->PasForm->pasPostLink('Delete', array('controller' => 'posts', 'action' => 'delete', 'page' => 2, '?' => 'foo=baz', 1));
		$expected = array(
			'form' => array(
				'method' => 'post', 'action' => '/posts/delete/1/page:2?foo=baz',
				'name' => 'preg:/post_\w+/', 'id' => 'preg:/post_\w+/', 'style' => 'display:none;'
			),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/form'
		);
		$this->assertTags($result, $expected);
	}

}
