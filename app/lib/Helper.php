<?php
/**
 * Created by PhpStorm.
 * User: ha
 * Date: 4/15/18
 * Time: 9:15 PM
 */

namespace mvc\app\lib;


trait Helper
{

    public function redirect($path)
    {
        session_write_close();
        header('Location: ' . $path);
        exit;
    }

    public static function arrayMvc()
    {
        $sec = ltrim($_SERVER['PHP_SELF'], '/');
        return explode('/',$sec);
    }

    public static function notFound()
    {
        require_once VIEWS_PATH . 'notFound' . DS . 'notfound.view.php';
        exit();
    }

    public static function printExpDiv ($e)
    {
        echo "<div dir='ltr' style='margin: 20px auto;text-align: center'>" .
                $e->getMessage() . ' [' .
            "<strong style='color: #27ae60'>" . $e->getFile() . '</strong>' . '] line '  .
                "<strong style='color: #e74c3c'>". $e->getLine() . '</strong>' .
             '</div>';
        exit();
    }

    public static function printExp ()
    {
        echo "Sorry :-( there're somting wrong";
        exit();
    }
}
