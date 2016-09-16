<?php
App::uses('Pas', 'Pas.Lib');
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
		$url = Pas::parse($this->request, $url);
		return $this->postLink($title, $url, $options, $confirmMessage);
	}

}