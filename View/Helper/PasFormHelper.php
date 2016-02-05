<?php
App::uses('FormHelper', 'View/Helper');

class PasFormHelper extends FormHelper {

/**
 * @param $title
 * @param null $url
 * @param array $options
 * @param bool $confirmMessage
 * @return string
 */
	public function pasPostLink($title, $url = null, $options = array(), $confirmMessage = false) {
		if (!is_array($url)) {
			return parent::postLink($title, $url, $options, $confirmMessage);
		}

		$request = $this->request;
		$named = $request->named;
		$query = array();
		if (!empty($request->query)) {
			$query['?'] = $request->query;
		}

		$url = Set::merge($query, $named, $url);
		return parent::postLink($title, $url, $options, $confirmMessage);
	}

}