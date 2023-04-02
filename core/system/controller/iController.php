<?php
interface iController {
	public static function getInstance(): self;
	public function getRoute(): array;
}