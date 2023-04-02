<?php
interface iMySqlConnection {
	public static function getInstance(): self;
	public function get(): mysqli;
}