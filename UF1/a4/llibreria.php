<?php
    function validacio($comprovaciomail){
        if (!filter_var($comprovaciomail, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }else {
            return TRUE;
        }
    }
    function validaciopass($comprovaciopass){
        if (!preg_match("/^[a-zA-Z-' ]*$/", $comprovaciopass)) {
            return FALSE;
        }else {
            return TRUE;
        }
    }
?>