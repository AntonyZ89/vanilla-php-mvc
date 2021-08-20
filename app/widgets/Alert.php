<?php

namespace app\widgets;

class Alert
{
    public static function run()
    {
        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $type => $value) {

                $rows = array_map(static function ($row) {
                    return "<li>$row</li>";
                }, $value);

                $rows = implode("\n", $rows);

                echo (
                    "<div class='alert alert-$type' role='alert'>
                        <ul class='m-0'>
                            $rows
                        </ul>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"
                );
            }
        }
    }
}
