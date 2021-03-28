<?php
if (isset($_GET['registration'])){
    if (empty($_GET['login'])|| empty($_GET['pasw'])){
        $message="Введите Логин и Пароль";
    } else {
        $r=$db->dbs->prepare('select * from users where login=:j;');
        $r->execute([':j'=>$_GET['login']]);
            if ($r->rowCount()!=0){
                $message="Такой пользователь уже зарегестрирован";
            } else {
                $r=$db->dbs->prepare('insert into users set login=:j, pasw=:j1, `name`=:j2, lastname=:j3, phone=:j4;');
                $r->execute([
                    ':j'=>$_GET['login'],
                    ':j1'=>md5($_GET['pasw']),
                    ':j2'=>$_GET['name'],
                    ':j3'=>$_GET['email'],
                    ':j4'=>$_GET['phone']
                ]);
            }
    }

}

if (isset($_REQUEST['auth'])) {
$r=$db->dbs->prepare("SELECT * FROM users WHERE login=:j and pasw=:j1");
$r->execute([':j'=>$_REQUEST['login'], ':j1'=>md5($_REQUEST['pasw'])]);
if ($r->rowCount()!=0){
    foreach($r as $res){
		$_SESSION['id']=$res['id'];
        $_SESSION['login']=$res['login'];
        $_SESSION['name']=$res['name'];
        $_SESSION['status']=$res['status'];
        $message="Вы успешно авторизованы-".$res['login'];
    }
}else $message="error-".$r->rowCount();
}

if(isset($_REQUEST['action'])){
    if ($_REQUEST['action']=='logout'){
        unset($_SESSION['login']);
        unset($_SESSION['name']);
        session_destroy();
    }


if ($_REQUEST['action']=='insert'){
    $r=$db->dbs->prepare('INSERT INTO recucle SET idp=:i, iduser=:j');
        if ($r->execute([':i'=>$_REQUEST['id'], ':j'=>$_SESSION['id']])){
            $message="Добавленно в корзину";
        }else $message = "Не добавлено в корзину";
    }
    if ($_REQUEST['action']=='ins'){
        $r=$db->dbs->prepare("UPDATE recucle SET status=2 WHERE iduser=:i;");
        if ($r->execute([':i'=>$_SESSION['id']])){$message="Купленно";}else $message ="Not buy";
    }
    if ($_REQUEST['action']=='del'){
        $r=$db->dbs->prepare('DELETE from recucle WHERE status=1 AND iduser=:i;');
        if ($r->execute([':i'=>$_SESSION['id']])){$message="Корзина очищена";}else $message ="Not deleting";
    }
}

if (isset($_REQUEST['items']) && isset($_REQUEST['nazv'])){
    if (!empty($_REQUEST['nazv'])){
        $r=$db->dbs->prepare('INSERT INTO category SET nazv=:i');
        if ($r->execute([':i'=>$_REQUEST['nazv']])){
            $message="Выполненно";
        }else $message="Не выполненно";
    }
}
if (isset($_REQUEST['items']) && isset($_REQUEST['nam'])){
    if (!empty($_REQUEST['nam'])){
        //*********************************************************** */
            // Название <input type="file">
$input_name = 'img';
 
// Разрешенные расширения файлов.
$allow = array();
 
// Запрещенные расширения файлов.
$deny = array(
	'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
	'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
	'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
);
 
// Директория куда будут загружаться файлы.
$path = __DIR__ . '/uploads/';
 
if (isset($_FILES[$input_name])) {
	// Проверим директорию для загрузки.
	if (!is_dir($path)) {
		mkdir($path, 0777, true);
	}
 
	// Преобразуем массив $_FILES в удобный вид для перебора в foreach.
	$files = array();
	$diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
	if ($diff == 0) {
		$files = array($_FILES[$input_name]);
	} else {
		foreach($_FILES[$input_name] as $k => $l) {
			foreach($l as $i => $v) {
				$files[$i][$k] = $v;
			}
		}		
	}	
	
	foreach ($files as $file) {
		$error = $success = '';
 
		// Проверим на ошибки загрузки.
		if (!empty($file['error']) || empty($file['tmp_name'])) {
			switch (@$file['error']) {
				case 1:
				case 2: $error = 'Превышен размер загружаемого файла.'; break;
				case 3: $error = 'Файл был получен только частично.'; break;
				case 4: $error = 'Файл не был загружен.'; break;
				case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
				case 7: $error = 'Не удалось записать файл на диск.'; break;
				case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
				case 9: $error = 'Файл не был загружен - директория не существует.'; break;
				case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
				case 11: $error = 'Данный тип файла запрещен.'; break;
				case 12: $error = 'Ошибка при копировании файла.'; break;
				default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
			}
		} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
			$error = 'Не удалось загрузить файл.';
		} else {
			// Оставляем в имени файла только буквы, цифры и некоторые символы.
			$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
			$name = mb_eregi_replace($pattern, '-', $file['name']);
			$name = mb_ereg_replace('[-]+', '-', $name);
			
			// Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
			// Сделаем их транслит:
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 
			
				'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			);
 
			$name = strtr($name, $converter);
			$parts = pathinfo($name);
 
			if (empty($name) || empty($parts['extension'])) {
				$error = 'Недопустимое тип файла';
			} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
				$error = 'Недопустимый тип файла';
			} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
				$error = 'Недопустимый тип файла';
			} else {
				// Чтобы не затереть файл с таким же названием, добавим префикс.
				$i = 0;
				$prefix = '';
				while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
		  			$prefix = '(' . ++$i . ')';
				}
				$name = $parts['filename'] . $prefix . '.' . $parts['extension'];
 
				// Перемещаем файл в директорию.
				if (move_uploaded_file($file['tmp_name'], $path . $name)) {
					// Далее можно сохранить название файла в БД и т.п.
					$success = 'Файл «' . $name . '» успешно загружен.';
				} else {
					$error = 'Не удалось загрузить файл.';
				}
			}
		}
		
		// Выводим сообщение о результате загрузки.
		if (!empty($success)) {
			echo '<p>' . $success . '</p>';		
		} else {
			echo '<p>' . $error . '</p>';
		}
	}
}
        //*********************************************************** */
        $r=$db->dbs->prepare('INSERT INTO products SET nam=:i, idcat=:j, price=:k, img=:g');
        if ($r->execute([':i'=>$_REQUEST['nam'], ':j'=>$_REQUEST['idcat'], ':k'=>$_REQUEST['price'], ':g'=>"uploads/".$name])){
            $message="Complited";
        }else $message="Falied";
    }
}

