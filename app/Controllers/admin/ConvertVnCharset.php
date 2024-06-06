<?php 
namespace App\Controllers\admin;
class ConvertVnCharset{
    public function convertVnCharset($name){
        $convert = mb_strtolower($name,'UTF-8');
        $convert=preg_replace('/\à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/','a',$convert);
        $convert=preg_replace('/\è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/','e',$convert);
        $convert=preg_replace('/\ì|í|ị|ỉ|ĩ/','i',$convert);
        $convert=preg_replace('/\ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/','o',$convert);
        $convert=preg_replace('/\ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/','u',$convert);
        $convert=preg_replace('/\ỳ|ý|ỵ|ỷ|ỹ/','y',$convert);
        $convert=preg_replace('/\đ/','d',$convert);
        $convert=preg_replace('/\.|;|,/','-',$convert);
        $convert=preg_replace('/\ /','-',$convert);
        return $convert;
        
    }
}
?>