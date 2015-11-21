Установка SpellChecker Yandex для CKEDITOR

Требования к PHP: модуль php_curl

1. Скачать https://github.com/badsyntax/jquery-spellchecker-demo/archive/master.zip

2. Создать каталог /sites/all/libraries/jquery-spellchecker и скопировать туда содержимое из п.1

3. Скачать http://speller.yandex.net/speller/patches/ck-jquery-spellchecker.zip

4. Скопировать Yandex.php в директорию /sites/all/libraries/jquery-spellchecker/webservices/php/SpellChecker/Driver/

5. Проверить путь в файле plugin.js:

    webservice: {
      path: '/sites/all/libraries/jquery-spellchecker/webservices/php/SpellChecker.php',
      driver: 'yandex'
    }

6. Скачать файл plugin.js и скопировать его в /sites/all/modules/ckeditor/plugns/jqueryspellchecker/

7. Включить плагин и добавить кнопку плагина в список кнопок в настройках профиля ckeditor через панель администратора Drupal7

Также добавить в поле конфига ckeditor: config.extraPlugins = 'jqueryspellchecker';

8. Отключить Skayt и другие плагины проверки орфографии

9. Подключить js файл /sites/all/libraries/jquery-spellchecker/js/jquery.spellchecker.min.js

10. Подключить css файл /sites/all/libraries/jquery-spellchecker/css/jquery.spellchecker.min.css

11. Скопировать стиль из jquery.spellchecker.min.css и стиль кнопки 

.cke_button__spellchecker_icon {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAACXklEQVQ4y22RzU4rRxCFv+oeM+32jOSFDRIrlA3SABJiiaNIyYK7uq9h3UR5kzwBvEF2+VkgiGSzzgNYVnIH4QULhBhAMOMZ8FBZXNsySRYldZ86p3SqjkwmE1qtFlEUAVAUBQBxHBMEAa+vrzw9PVFVFWEYEkURjUaDqqp4fHyE29tbVBVAAVXVd/8FVlXVf/AsyzDee0REVbVS1UpEFODw8JBVbG1t7R1PVas8zwmstSRJAtAG2N/fnwLUdb3E9vb2pgC7u7tLDGA6nRKICNZagBLAGLPoIyJTvuxQAVRVxfPzc3lzc8NsNsNaixER5qUioosBeZ6vrhACvL290Ww2ieMY7z1BEGDquibLsiU5yzIAyrJc2G1vbm4CYK3FWsv6+jobGxs0m024u7ubu1Snqq7RaKiq0u12V1MoVZXJZPLnagr39/dwdXWFqpZpmi7f82jLlXLABxEpe72eHh8fD1S1vL6+xry8vCwv670HaMdxvLQPtEXkmzAMf+n1emGr1Rr0+/2fgXZRFF+OmKZpGccx3W4XEfnROffdPJVSRL4Ow/DXg4MDF0XR8Ozs7C/gZDwel6pKYIzBWksYhojIB+/9T8aYQkQ+AhJF0W87OzvOOTc4PT39G/hhPB6rtRZjDMEinqIoUFWOjo6GDw8P315eXv4OsLW11XTODQeDwWfg+1WxiGDmEZDnOcAf5+fnl865YafT8Z1Ox3vvhxcXF5+BT/8WA0iapixc1HXN9va2AU6SJPkKYDQapUD//8TvBqgqdV0zm81IksQAJ3NOfzQavQVBgLX2nRjgHzGrYAquuDikAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDEyLTEwLTI1VDEyOjQ4OjExKzAyOjAwAaJEMgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxMi0xMC0yNVQxMjo0ODoxMSswMjowMHD//I4AAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC) !important;
}


Доки

https://tech.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-ckeditor4-docpage/

http://jquery-spellchecker.badsyntax.co/ckeditor.html


