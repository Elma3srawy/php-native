<?php 

if(!function_exists('db_create')){
    function db_create(string $table , array $data){
        $columns = ''; 
        $values = ''; 
        foreach ($data as $column => $value) {
            $columns .= $column.", ";
            $values .= "'".$value."', ";  
        }
        $columns = rtrim($columns ,' ,');
        $values  = rtrim($values ,' ,');
        $sql = "INSERT INTO " .$table. " (".$columns. ") VALUES (" .$values. ")";
        mysqli_query($GLOBALS['connect'], $sql);
        return  mysqli_insert_id($GLOBALS['connect']);
    }
}


if(!function_exists('db_update')){
    function db_update(string $table , array $data , $id){
        $sql = '';
        foreach ($data as $column => $value){
            $sql .= $column .' = \''.$value . '\', ';
        }
        $sql = rtrim($sql , ', ');
        $sql = "UPDATE " .$table. " SET ".$sql . " WHERE id = " . $id;
        return  mysqli_query($GLOBALS['connect'], $sql);
    }
}

if (!function_exists('db_delete')) {
    function db_delete(string $table, int $id)
    {
        $sql = "DELETE FROM " . $table . " WHERE id = " .$id ;
        return mysqli_query($GLOBALS['connect'], $sql);
    }
}

if (!function_exists('db_find')) {
    function db_find(string $table, int $id)
    {
        $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
        return mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'], $sql));
    }
}

if (!function_exists('db_all')) {
    function db_all(string $table)
    {
        $sql = "SELECT * FROM " . $table ;
        return mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'], $sql));
    }
}


if(!function_exists('db_get')) {
    function db_get(string $table, string $query_str):mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "select * from ".$table." ".$query_str);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query'=>$query,
            'num'=>$num,
        ];
    }
}



if(!function_exists('db_first')) {
    function db_first(string $table, string $query_str, string $select = '*'):mixed
    {
        $sql =  "select ".$select." from ".$table." ".$query_str;
        $query = mysqli_query($GLOBALS['connect'], $sql);
        $result = mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}



if (!function_exists('get_auth')) {
    function get_auth(string $table , string $query)
    {
        $sql = "SELECT * FROM " . $table . " WHERE " . $query;
        return mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'], $sql));
    }
}



if(!function_exists('render_paginate')) {
    function render_paginate(int $total_pages, $appends):string
    {

     
        $request_str = '';
        if(!empty($appends) && count($appends) > 0) {
            
            foreach($appends as $k=>$val) {
                $request_str .= $k.'='.$val.'&';
            }
        }
        $request_str .= 'page=';
        //var_dump($request_str);

        $html =  '<ul class="pagination justify-content-center" dir="ltr">';
        $p_disabled = empty(request('page')) || request('page') == 1?'disabled':'';

        $p_number = !empty(request('page')) && is_numeric(request('page'))
        && request('page') > 0
        && request('page') <= $total_pages?request('page')-1:1;

        $html .=  '<li class="page-item">
                    <a class="page-link '.$p_disabled.'" href="?'.$request_str.$p_number.'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>';
        for($i=1;$i <= $total_pages;$i++) {
            $active = (!empty(request('page')) && request('page') == $i) || ($i == 1 && empty(request('page')))?'active':'';
            $html  .= '<li class="page-item '.$active.'"> <a href="?'.$request_str.$i.'" class="page-link">'.$i.'</a> </li>';
        }
        $n_disabled = !empty(request('page')) && request('page') == $total_pages?'disabled':'';
        $n_number = !empty(request('page')) && is_numeric(request('page'))
        && request('page') > 0
        && request('page') < $total_pages?request('page')+1:1;
        $html .='<li class="page-item '.$n_disabled.'">
        <a class="page-link" href="?'.$request_str.$n_number.'" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>';
        $html .='</ul>';
        return $total_pages > 0?$html:'';

    }
}

if(!function_exists('db_paginate')) {
    function db_paginate(string $table, string $query_str, int $limit=15, string $orderby='asc', string $select='*', array $appends = null):array
    {
 
        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $current_page = $_GET['page']-1;
        } else {
            $current_page = 0;
        }
 
        $query_count = mysqli_query($GLOBALS['connect'], "select COUNT(".$table.".id) from ".$table." ".$query_str);
        $count = mysqli_fetch_row($query_count);
        $total_records = $count[0];

        $start = $current_page * $limit;
        $total_pages = ceil($total_records / $limit);

        if($current_page >= $total_pages) {
            $start = $total_pages+1;
        }
         
        
        $query = mysqli_query($GLOBALS['connect'], "select ".$select." from ".$table." ".$query_str." order by ".$table.".id ".$orderby." LIMIT {$start},{$limit}");
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query'=>$query,
            'num'=>$num,
            'render'=>render_paginate($total_pages, $appends),
            'current_page'=>$current_page,
            'limit'=>$limit
        ];
    }
    
}