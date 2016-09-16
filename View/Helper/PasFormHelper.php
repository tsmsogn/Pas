<?php
App::uses('Pas', 'Pas.Lib');
App::uses('FormHelper', 'View/Helper');

class PasFormHelper extends FormHelper {

/**
 * Creates an HTML link which is generated from given $url and current request query params.
 * But access the URL using the method you specify (defaults to POST).
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of HTML attributes.
 * @param bool|string $confirmMessage JavaScript confirmation message. This
 *   argument is deprecated as of 2.6. Use `confirm` key in $options instead.
 * @return string An `<a />` element.
 */
	public function pasPostLink($title, $url = null, $options = array(), $confirmMessage = false) {
		$url = Pas::parse($this->request, $url);
		return $this->postLink($title, $url, $options, $confirmMessage);
	}

}