<?php
ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)){
session_start();
}
