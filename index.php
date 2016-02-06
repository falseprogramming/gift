<?php

require('libaries/FPDF/fpdf.php');
require('settings/config.php');
require('settings/function.php');
require('application/admin/Login.php');
require('settings/Database_connection.php');
require('application/Database/Gift_DB.php');
require('application/PDF/Gift_PDF.php');
require('application/PDF/Gift_PDF_Exec.php');
require('application/Init.php');
include('templates/header.php');
new Init();
include('templates/footer.php');