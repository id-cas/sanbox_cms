<?php
interface iConfig {
	public static function getInstance(): self;
	public function get($section, $param);
}