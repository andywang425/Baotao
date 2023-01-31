<?php
if (isset($GLOBALS['error_msgs'])) {
    foreach ($GLOBALS['error_msgs'] as $error_msg) {
        echo <<<EOF
        <div class="error_msg">
            <img src="img/error.svg" id="icon">
                <span id="msg">
                    $error_msg
                </span>
        </div>
        EOF;
    }
}
?>
