<?php
interface iTemplater {
	public function setScope($scope):void;
	public function getScope(): array;
	public function rn($template, $params = []): string;
	public function com($component, $method, $params = []): array;
}