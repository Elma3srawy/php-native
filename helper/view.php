<?php 

if (!function_exists("view")){   
    function view(string $path , array $values=null){
        $count = str_word_count($path , characters:'.');
        if($count > 0){
            $path = str_replace('.' , '/' ,$path , $count);
        }
        $file =  config('view.path') .'/'. $path.'.' . config("view.extension");
        if (file_exists($file)){
            return view_engine($file , $values);
        }
    }
}


if (!function_exists("view_engine")){   
    function view_engine(string $file , array $values =null){

        if(!is_null($values) && is_array($values)){
            foreach ($values as $key => $value) {
                ${$key} = $value;
            }
        }

        $file_hash_name  = md5($file);
        $save_to_storage = base_path().'storage/views/'.$file_hash_name.'.php';
    

        $file_content = file_get_contents($file);


        // if(!file_exists($save_to_storage)){
            $search =['{{' , '}}' , '@php' , '@endphp'];
            $replace = ['<?php echo ' , ';?>' , '<?php' , '?>'];
            $file = str_replace($search ,$replace  , $file_content);
    
            // if Statement
            $file = preg_replace('/@if\((.*?)\)+/i','<?php if($1)): ?>',$file); 
            $file = preg_replace('/@elseif\((.*?)\)+/i','<?php elseif($1)): ?>',$file); 
            $file = preg_replace('/@else/i','<?php else: ?>',$file); 
            $file = preg_replace('/@endif/i','<?php endif; ?>',$file); 
            // Foreach
            $file = preg_replace('/@foreach\((.*?) as (.*?)\)+/i','<?php foreach($1 as $2): ?>',$file); 
            $file = preg_replace('/@endforeach/i','<?php endforeach; ?>',$file); 
            
                
            file_put_contents($save_to_storage, $file);
        // }

        include $save_to_storage;
    }
}