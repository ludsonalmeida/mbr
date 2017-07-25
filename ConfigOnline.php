<?php
setlocale(LC_TIME, 'Portuguese');
define('DB_HOST',"localhost");
define('DB_SA',"mbr_sistema");
define('DB_USER',"devmbr");
define('DB_PASSWORD',"Devmbrlud321!");
define('HOME','http://www.catiadamasceno.com.br/mbr/');
define('HOMEP','http://www.catiadamasceno.com.br/mbr/public/');


define('EMAIL_USR','');
define('EMAIL_PASS','teste');
define('EMAIL_PORT',587);
define('EMAIL_HOST','smtp.gmail.com');

define('MBR_ACCEPT','accept');
define('MBR_INFOR','infor');
define('MBR_ALERT','alert');
define('MBR_ERROR','error');

function MBRError($ErrMsg, $ErrNo, $ErrDie = null) {
$CssClass = ($ErrNo == E_USER_NOTICE ? MBR_INFOR : ($ErrNo == E_USER_WARNING ? MBR_ALERT : ($ErrNo == E_USER_ERROR ? MBR_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? MBR_INFOR : ($ErrNo == E_USER_WARNING ? MBR_ALERT : ($ErrNo == E_USER_ERROR ? MBR_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
