<?php
App::uses('Pas', 'Pas.Lib');
App::uses('HtmlHelper', 'View/Helper');

class PasHtmlHelper extends HtmlHelper {

/**
 * @param View $View
 * @param array $settings
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}

/**
 * @param $title
 * @param null $url
 * @param array $options
 * @param bool $confirmMessage
 * @return string
 */
	public function pasLink($title, $url = null, $options = array(), $confirmMessage = false) {
		$url = Pas::parse($this->request, $url);
		return parent::link($title, $url, $options, $confirmMessage);
	}

}
