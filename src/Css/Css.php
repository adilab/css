<?php

/**
 *
 * AdiPHP : Rapid Development Tools (http://adilab.net)
 * Copyright (c) Adrian Zurkiewicz
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @version     0.1
 * @copyright   Adrian Zurkiewicz
 * @link        http://adilab.net
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Adi\Css;

/**
 * Css handler.
 *
 * @author adrian
 */
class Css {

	private $css = array();

	/**
	 * Constructor
	 *
	 * <code>
	 * $css = new Css('display: inline-block;margin-right: 10px;min-width: 150px;');
	 * $css->set('width: 20px');
	 * $css->set('color', '#ff0000')->set('background-color: #ccc');
	 * echo $css;
	 * </code>
	 * 
	 * @param string $css CSS string
	 */
	function __construct($css = NULL) {

		$css = trim(strtolower($css));

		if ($css) {
			$this->set($css);
		}
	}

	/**
	 * Removes CSS property.
	 *
	 * <code>
	 * $css->remove('width');
	 * </code> 
	 *
	 * @param string $property
	 * @return Css
	 */
	public function remove($property) {

		$property = trim(strtolower($property));

		unset($this->css[$property]);
		
		return $this;
	}

	/**
	 * Sets CSS value.
	 *
	 * <code>
	 * $css->set('width: 20px');
	 * $css->set('color', '#ff0000');
	 * </code>
	 *
	 * @param mixed $css CSS property or CSS expression string
	 * @param string $value
	 * @return Css
	 * 
	 */
	public function set($css, $value = NULL) {

		$css = trim(strtolower($css));


		if (func_num_args() == 1) {

			$elements = explode(';', $css);

			foreach ($elements as $element) {

				if (!$element = trim($element)) {
					continue;
				}

				$element = explode(':', $element);

				if (!$element[0] = trim(@$element[0])) {
					continue;
				}

				$element[1] = trim(@$element[1]);

				$this->set($element[0], $element[1]);
			}

			return;
		}

		$css = strtolower($css);
		$this->css[$css] = $value;
		return $this;
	}

	/**
	 * Returns CSS value
	 *
	 * @param string $property
	 * @return string 
	 */
	public function get($property) {

		$property = trim(strtolower($property));

		return @$this->css[$property];
	}

	/**
	 * Creates CSS string
	 *
	 * @return string
	 * 
	 */
	public function render() {

		$result = NULL;

		foreach ($this->css as $name => $value) {

			if (!$value = trim($value)) {
				continue;
			}

			$result .= "{$name}:{$value};";
		}

		return $result ? $result : '';
	}

	/**
	 * Casts to string.
	 *
	 * @return string
	 * 
	 */
	public function __toString() {

		return $this->render();
	}

}
