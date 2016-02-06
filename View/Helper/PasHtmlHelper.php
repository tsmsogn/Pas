<?php
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
		if (!is_array($url)) {
			return parent::link($title, $url, $options, $confirmMessage);
		}

		$request = $this->request;
		$named = $request->named;
		$query = array();
		if (!empty($request->query)) {
			$query['?'] = $request->query;
		}

		$url = Set::merge($query, $named, $url);
		return parent::link($title, $url, $options, $confirmMessage);
	}

}
