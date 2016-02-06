<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('PasHtmlHelper', 'Pas.View/Helper');

/**
 * PasHtmlHelper Test Case
 *
 */
class PasHtmlHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->PasHtml = new PasHtmlHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PasHtml);

		parent::tearDown();
	}

/**
 * testPaLink method
 *
 * @return void
 */
	public function testPaLink() {
		$result = $this->PasHtml->pasLink('Posts', array('controller' => 'posts', 'action' => 'edit', 1));
		$expected = array('a' => array('href' => '/posts/edit/1'), 'Posts', '/a');
		$this->assertTags($result, $expected);

		$request = $this->PasHtml->request;
		$request->named = array('page' => 1);
		$request->query = 'foo=bar';

		// Test for named and query
		$result = $this->PasHtml->pasLink('Posts', array('controller' => 'posts', 'action' => 'edit', 1));
		$expected = array('a' => array('href' => '/posts/edit/1/page:1?foo=bar'), 'Posts', '/a');
		$this->assertTags($result, $expected);

		// Test for overriding
		$result = $this->PasHtml->pasLink('Posts', array('controller' => 'posts', 'action' => 'edit', 'page' => 2, '?' => 'foo=baz', 1));
		$expected = array('a' => array('href' => '/posts/edit/1/page:2?foo=baz'), 'Posts', '/a');
		$this->assertTags($result, $expected);
	}

}
