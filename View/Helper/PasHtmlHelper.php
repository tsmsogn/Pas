<?php
App::uses('Pas', 'Pas.Lib');
App::uses('HtmlHelper', 'View/Helper');

class PasHtmlHelper extends HtmlHelper {

/**
 * Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}

/**
 * Creates an HTML link which is generated from given $url and current request query params.
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of options and HTML attributes.
 * @param string $confirmMessage JavaScript confirmation message. This
 *   argument is deprecated as of 2.6. Use `confirm` key in $options instead.
 * @return string An `<a />` element.
 */
	public function pasLink($title, $url = null, $options = array(), $confirmMessage = false) {
		$url = Pas::parse($this->request, $url);
		return $this->link($title, $url, $options, $confirmMessage);
	}

}
