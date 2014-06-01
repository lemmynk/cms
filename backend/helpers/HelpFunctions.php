<?php
/**
 * Created by miller 
 * Date: 5/8/14
 * Time: 7:38 PM
 */
namespace backend\helpers;

use Yii;
use yii\web\Controller;

class HelpFunctions extends Controller
{
    /** Array test purposes only */
    public static function echoArray( $array = array(), $array2 = null, $array3 = null )
    {
        echo "<pre>\n";
        print_r($array);
        echo "\n</pre>\n";
        if( $array2 !== null ){
            echo "<pre>\n";
            print_r($array2);
            echo "\n</pre>\n";
        }
        if( $array3 !== null ){
            echo "<pre>\n";
            print_r($array3);
            echo "\n</pre>\n";
        }
        // stop after all
        Yii::$app->end();
    }

    /** *************************************************************************************
     * Retrieve SEO parsed name
     *****************************************************************************************/
    public static function parseForSEO($name){
        //$name = unicode_urldecode(trim($name));

        $ZABRANJENI_KARAKTERI = array("_", "|", "@", "§", "~", "?", "!", "#", '"', "%", "&", "=", "*", "'", "°");
        $value = trim($name);
        $name = str_replace($ZABRANJENI_KARAKTERI, "", $value);

        //srpski karakteri
        //cirilica
        $name = str_replace("А","A",$name);
        $name = str_replace("Б","B",$name);
        $name = str_replace("В","V",$name);
        $name = str_replace("Г","G",$name);
        $name = str_replace("Д","D",$name);
        $name = str_replace("Ђ","Đ",$name);
        $name = str_replace("Е","E",$name);
        $name = str_replace("Ж","Ž",$name);
        $name = str_replace("З","Z",$name);
        $name = str_replace("И","I",$name);
        $name = str_replace("Ј","J",$name);
        $name = str_replace("К","K",$name);
        $name = str_replace("Л","L",$name);
        $name = str_replace("Љ","Lj",$name);
        $name = str_replace("М","M",$name);
        $name = str_replace("Н","N",$name);
        $name = str_replace("Њ","Nj",$name);
        $name = str_replace("О","O",$name);
        $name = str_replace("П","P",$name);
        $name = str_replace("Р","R",$name);
        $name = str_replace("С","S",$name);
        $name = str_replace("Т","T",$name);
        $name = str_replace("Ћ","Ć",$name);
        $name = str_replace("У","U",$name);
        $name = str_replace("Ф","F",$name);
        $name = str_replace("Х","H",$name);
        $name = str_replace("Ц","C",$name);
        $name = str_replace("Ч","Č",$name);
        $name = str_replace("Џ","Dž",$name);
        $name = str_replace("Ш","Š",$name);

        $name = str_replace("а","a",$name);
        $name = str_replace("б","b",$name);
        $name = str_replace("в","v",$name);
        $name = str_replace("г","g",$name);
        $name = str_replace("д","d",$name);
        $name = str_replace("ђ","đ",$name);
        $name = str_replace("е","e",$name);
        $name = str_replace("ж","ž",$name);
        $name = str_replace("з","z",$name);
        $name = str_replace("и","i",$name);
        $name = str_replace("ј","j",$name);
        $name = str_replace("к","k",$name);
        $name = str_replace("л","l",$name);
        $name = str_replace("љ","lj",$name);
        $name = str_replace("м","m",$name);
        $name = str_replace("н","n",$name);
        $name = str_replace("њ","nj",$name);
        $name = str_replace("о","o",$name);
        $name = str_replace("п","p",$name);
        $name = str_replace("р","r",$name);
        $name = str_replace("с","s",$name);
        $name = str_replace("т","t",$name);
        $name = str_replace("ћ","ć",$name);
        $name = str_replace("у","u",$name);
        $name = str_replace("ф","f",$name);
        $name = str_replace("х","h",$name);
        $name = str_replace("ц","c",$name);
        $name = str_replace("ч","č",$name);
        $name = str_replace("џ","dž",$name);
        $name = str_replace("ш","š",$name);

        //
        $name = str_replace("Ć","C",$name);
        $name = str_replace("Č","C",$name);
        $name = str_replace("Š","S",$name);
        $name = str_replace("Đ","DJ",$name);
        $name = str_replace("Ž","Z",$name);
        $name = str_replace("ć","c",$name);
        $name = str_replace("č","c",$name);
        $name = str_replace("š","s",$name);
        $name = str_replace("đ","dj",$name);
        $name = str_replace("ž","z",$name);

        $name = strtolower($name);
        $chrs = "1234567890-ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $len = strlen($name);
        $new_name = "";
        for($i=0; $i<$len; $i++){
            $c = substr($name, $i, 1);
            if (!is_int(strpos($chrs, $c))) $c = "-";
            $new_name .= $c;
        }
        $new_name = str_replace('--','-',$new_name);
        if ($new_name == "") $new_name = "--";

        return strtolower($new_name);
    }
}