<?php
interface IPlugin{
	static function getname();
	static function init();
	static function getmenu();
}