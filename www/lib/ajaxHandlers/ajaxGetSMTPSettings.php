<?php

require_once("/home/rconfig/classes/usersession.class.php");
require_once("/home/rconfig/classes/ADLog.class.php");
$log = ADLog::getInstance();
if (!$session->logged_in) {
    echo 'Don\'t bother trying to hack me!!!!!<br /> This hack attempt has been logged';
    $log->Warn("Security Issue: Some tried to access this file directly from IP: " . $_SERVER['REMOTE_ADDR'] . " & Username: " . $session->username . " (File: " . $_SERVER['PHP_SELF'] . ")");
    // need to add authentication to this script
    header("Location: " . $config_basedir . "login.php");
} else {
// Get SMTP settings from DB for settings.php
    session_start();
    require_once("../../../classes/db2.class.php");
    require_once("../../../classes/ADLog.class.php");
    require_once("../../../config/config.inc.php");
    $db2 = new db2();
    $term = $_GET['term'];
    $db2->query("SELECT smtpServerAddr, smtpFromAddr, smtpRecipientAddr, smtpAuth, smtpAuthUser, smtpAuthPass, smtpLastTest, smtpLastTestTime  FROM settings  WHERE id = 1");
    $rows = $db2->resultset();
    echo json_encode($rows);
}