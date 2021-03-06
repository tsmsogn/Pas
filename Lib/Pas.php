<?php
/**
 * Class Pas
 */
class Pas {

/**
 * Parsed URL which is generate from given $url and current request query params
 *
 * @param CakeRequest $request CakeRequest
 * @param string|array|null $url URL to be parsed
 * @return array Parsed elements which is generate from given $url and current request query params
 */
	public static function parse(CakeRequest $request, $url) {
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

		$named = Hash::merge($request->named, $named);
		$queryParameters = Hash::merge($request->query, $queryParameters);

		if (!empty($queryParameters)) {
			$query = array('?' => $queryParameters);
		}

		return Hash::merge($query, $named, $pass, $url);
	}

} 