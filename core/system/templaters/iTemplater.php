<?php
interface iTemplater {
	public function rn($template, $params = []);
	public function com($component, $method, $params = []);
}