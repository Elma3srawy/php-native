<?php 

if(!function_exists('storage')){
    function storage(string $path){
        if (file_exists($path) && is_readable($path)) {
            header('Content-Description: file from server'); 
            header('Content-Type: attachment; filename=' . basename($path)); 
            header('Expires: 0'); 
            header('Cache-Control: must-revalidate'); 
            // header('Pragma: public'); 
            header('Content-Length: '.filesize($path)); 
            readfile($path);
            exit;
        } 
    }
}


if(!function_exists('upload_file')){
    function upload_file(string $filename, string $targetDir){
        $from = $_FILES[$filename]['tmp_name'];
        $dir = config('files.file_path').'\\' . $targetDir;
        $exe =  pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
        $path = pathinfo($_FILES[$filename]['name'], PATHINFO_FILENAME) . '_' . uniqid();
        $path ='/'. md5($path). '.'. $exe;
        
        $to = $dir . $path;

        if(!is_dir($dir)){
            mkdir($dir , recursive:true);
        }
        return move_uploaded_file($from, $to) ? $targetDir.$path : false;
    }
}



if(!function_exists('delete_file')){
    function delete_file(string $path){
        $real_path = base_path(). 'storage/'. $path;
        var_dump($real_path);
        if (file_exists($real_path) && !empty($path)) {
            return unlink($real_path);
        }
    }
}


if(!function_exists('storage_url')) {
    function storage_url(string $path=null):string{
        {
         return !empty($path)? url('storage/'.$path):'';
        }
    }
}