<?php

function getFile($ftp_server,$ftp_username,$ftp_userpass,$nameOfFile) {

// connect and log in to FTP server
$ftp_connection = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);

// Turns on Passive mode on FTP Connection
ftp_pasv($ftp_connection, true);

$local_file = "/home/cream/test.cdr";
$server_file = $nameOfFile;

// initiate download ()
$dwld = ftp_nb_get($ftp_connection, $local_file, $server_file, FTP_ASCII);

while ($dwld == FTP_MOREDATA)
  {
  // do whatever you want
  // continue downloading
  $dwld = ftp_nb_continue($ftp_connection);
  }

if ($dwld != FTP_FINISHED)
  {
  echo "Error downloading $server_file";
  }
  exit(1);

// close connection
ftp_close($ftp_connection);

}

$ftp_server = "localhost";
$ftp_username = "cream";
$ftp_userpass ="L@uren22";

getFile($ftp_server,$ftp_username,$ftp_userpass,"/home/cream/ftp/testfile.cdr");
?>
