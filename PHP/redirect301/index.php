<?php 
date_default_timezone_set('Europe/Minsk');
header("Content-Type: text/html; charset='utf-8'\r\n");
$results = array();
$messages = array();

ini_set("auto_detect_line_endings", true);
if($_POST['action'] == 'send'){

  $url = $_FILES['upload']['tmp_name'];
  $local_filename = $_FILES['upload']['name'] ? basename($_FILES['upload']['name']) : null;
  
  if($url) $_POST['url'] = false;
  
  if(!$url) {
    $url = filter_var($_POST['url'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
    $url_filename = $url ? basename($url) : null;
  }

  if(!$url || $url==''){
    $messages[] = 'Адрес невалидный';
  } else {
    // Создание временного файла в директории
    // временных файлов, используя sys_get_temp_dir()
    $temp_file = tempnam(sys_get_temp_dir(), 'redirects');

    if(!$temp_file) {
      $messages[] = 'Не удалось создать временный файл';
    } else {
      
      $put_result = file_put_contents($temp_file, fopen($url, 'r'));
      $contents = fread(fopen($temp_file, "r"), $put_result);
      $enc =mb_detect_encoding($contents, mb_list_encodings());
      if($_POST['mac_charset']){
        $contents = iconv('MacCyrillic', "UTF-8", $contents);
      } else
      if(!$enc || $enc != 'UTF-8') {
        $contents = iconv('WINDOWS-1251', "UTF-8", $contents);
      }
      $put_result = file_put_contents($temp_file, $contents);

      if(!$put_result) {
        $messages[] = 'Не удалось записать временный файл';
      } else {

        $rows = array();
        if (($handle = fopen($temp_file, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 10000, ';')) !== FALSE) {
                $rows[] = $row;
            }
            fclose($handle);
        }

        unlink($temp_file);

        foreach($rows as $row){
  
          $key = trim($row[0]);
          $value = trim($row[1]);
          $key = urldecode($key);
          $key = preg_replace('/\?\$$/', '', $key);
          $key = preg_replace('/\s/', '\ ', $key);
          $key = remove_hash($key);
          $key = remove_host($key);
          $key = ltrim($key, '/');
          if($_POST['withslash']) $key = '/'.$key;
          $value = urldecode($value);
          $value = preg_replace('/\s/', '\ ', $value);
          $value = remove_host($value);
          if($key!= '' && $value!= '' && $key !== $value) $results[$key] = $value;
        }
        $results = cleanArray($results);
      }
    }
  }
}

function remove_host($str){
  $parsed = parse_url($str);
  $new_str = $parsed['path'];
  if(isset($parsed['query'])) $new_str .= '?'.$parsed['query'];
  return $new_str;
}

function remove_hash($str){
  return str_replace(strrchr ( $str , '#' ), '', $str);
}

function cleanArray($array)
{
   $newArray = array();
   foreach ($array as $key => $val) {
      if (isset($array[$val]) && $array[$val] == $key) {
         if (!isset($newArray[$key]) && !isset($newArray[$val])) {
            $newArray[$key] = $val; 
         }      
         unset($array[$key], $array[$val]);
      }
   }    
   return array_merge($array, $newArray);
}
?>
<style>*{font-size:1em; box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;font-family: Arial, sans-serif;}body{padding: 10px; font-family: Arial, sans-serif;} input[type="text"]{border:1px solid rgb(204,4,150);padding:5px 10px;line-height: 1.4em;} input[type="submit"]{
  color:#fff;
  box-shadow: 0px 0px 10px #ccc;
  /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#cc0496+0,c1004d+100 */
background: rgb(204,4,150); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2NjMDQ5NiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjMTAwNGQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(204,4,150,1) 0%, rgba(193,0,77,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(204,4,150,1) 0%,rgba(193,0,77,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(204,4,150,1) 0%,rgba(193,0,77,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cc0496', endColorstr='#c1004d',GradientType=0 ); /* IE6-8 */

  border:1px solid rgb(204,4,150);padding:5px 10px;line-height: 1.4em; }
  input[type="submit"]:hover{
  /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#cc0496+0,c1004d+100 */
background: rgb(204,4,150); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjY2MwNDk2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2MxMDA0ZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(-45deg,  rgba(204,4,150,1) 0%, rgba(193,0,77,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-45deg,  rgba(204,4,150,1) 0%,rgba(193,0,77,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(135deg,  rgba(204,4,150,1) 0%,rgba(193,0,77,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cc0496', endColorstr='#c1004d',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
}
  
  .message{color:red;}textarea{font-size: .8em;border:1px solid #ccc;padding:5px 10px;width:100%;}h1{font-size: 2em}h2{font-size: 1em;}</style>
<h1>Создай свой 301-й редирект!</h1>
<h3>1. Выберите файл</h3>
<p class="message"><?php print implode("\n",$messages);?></p>
<form id="redirect_form" enctype="multipart/form-data" action="index.php" method="POST">
  <p>
    <input type="file" name="upload" placeholder="Выберите файл" value=""/> или <input type="text" name="url" placeholder="Введите URL-адрес файла CSV" size="50" value="<?=$_POST['url'];?>"/>
</p> 
 <p>
  <input type="hidden" value="send" name="action" />
  <label for="withslash"><input type="checkbox" value="1" <?=$_POST['withslash']?'checked':'';?> id="withslash" name="withslash" /> Со слешом вначале</label> 
  <label for="mac_charset"><input type="checkbox" value="1" <?=$_POST['mac_charset']?'checked':'';?> id="mac_charset" name="mac_charset" /> mac-кодировка</label>&nbsp;
  <input type="submit" value="Сделать немного магии"/>
  </p> 
</form>
<?php if(!empty($results)){ ?>
  <h3>2. Результат</h3>
  <?php print  '<p>Использован <b>'.($local_filename ?$local_filename : $url_filename).'</b></p>';?>
  <form action="" method="POST">
    <textarea rows="50" ><?php 
        foreach($results as $from => $to){
          print 'RewriteRule ^'.$from.'$ '.$to.' [R=301,L]'."\n";
        } ?>
    </textarea>
  </form>
<?php  } ?>
<h5>Support: zaletnev@bquadro.ru</h5>
<small>Csv должен быть c двумя колонками</small>
<p><img src="csv.png" alt=""/></p>
