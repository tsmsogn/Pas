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

		if (is_string($queryParameters)) {
			parse_str($queryParameters, $queryParameters);
		}

		$request = $this->request;

		$named = Set::merge($request->named, $named);
		$queryParameters = Set::merge($this->request->query, $queryParameters);

		if (!empty($queryParameters)) {
			$query = array('?' => $queryParameters);
		}

		$url = Set::merge($query, $named, $pass, $url);
		return parent::postLink($title, $url, $options, $confirmMessage);
	}

}