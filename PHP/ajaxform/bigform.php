<?php
define( '_JEXEC', 1 );
define('JPATH_BASE', $_SERVER['DOCUMENT_ROOT']);
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
JPluginHelper::importPlugin('system');
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;
$mainframe->triggerEvent('onAfterInitialise');
?>
<?
$formname = isset($_REQUEST['formname']) || isset($_REQUEST['formname']) ? filter_var($_REQUEST['formname'], FILTER_SANITIZE_STRING) : '';
$popup = isset($_REQUEST['popup']) || isset($_REQUEST['popup']) ? filter_var($_REQUEST['popup'], FILTER_SANITIZE_STRING) : 'N';
$formid = isset($_REQUEST['formid']) || isset($_REQUEST['formid']) ? filter_var($_REQUEST['formid'], FILTER_SANITIZE_STRING) : NULL;
if(!$formid) exit();

$arError = false;
if ($_REQUEST['submit'] == 'Y') {
    
    $_REQUEST['name'] = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    $_REQUEST['phone'] = filter_var($_REQUEST['phone'], FILTER_SANITIZE_STRING);
    $_REQUEST['mail'] = filter_var($_REQUEST['mail'], FILTER_SANITIZE_STRING);
    $_REQUEST['comment'] = filter_var($_REQUEST['comment'], FILTER_SANITIZE_STRING);
    
    if(trim($_REQUEST['name']) == '')
      $arError[] = 'Поле "Имя" обязательно для заполнения';
      
    if(trim($_REQUEST['phone']) == '')
      $arError[] = 'Поле "Телефон" обязательно для заполнения';

     if (!$arError) {
       
      //send mail
      date_default_timezone_set('Europe/Moscow');
      $config = JFactory::getConfig();
      $body = "";
      $body .= "Дата: ".date('d.m.Y - H:i')."\n\n";
      $body .= "Имя: ".$_REQUEST['name']."\n";
      $body .= "Телефон: ".$_REQUEST['phone']."\n";
      $body .= "Почта: ".$_REQUEST['mail']."\n";
      $body .= "Комментарий: ".$_REQUEST['comment']."\n\n";
      $body .= "-----\n";
      $body .= "Не отвечайте на письмо. Оно отправлено автоматически с сайта ".$config->get('sitename')."\n";
       
      $mailer =& JFactory::getMailer();
      $mailer->IsHTML(false);
      $mailer->setSubject($config->get('sitename').'. '.$formname);
      $mailer->setBody($body);
      $mailer->setSender(array('noreply@azimut-glass.ru', $config->get('sitename'))); 
      $mailer->addRecipient(array('info@azimut-glass.ru', 'client.form@bquadro.ru'));
      $mailer->Send();

       ?>
       <script>
            sendEvent('request-end', 'request');
            setTimeout('$.fancybox.close()', 5000);
        </script>
       <?php if($popup != 'Y'){?>
          <script>
             $.fancybox({
                "content" : '<div class="form-success"><h3>Заявка принята!</h3><p class="">Наши специалисты позвонят Вам в ближайшее время.</p></div>', padding:0
             });                             
         </script>  
       <?php } else { ?>
          <div class="form-success"><h3>Заявка принята!</h3><p class="">Наши специалисты позвонят Вам в ближайшее время.</p></div>
          <?php exit; ?>
       <?php } ?>
        <?
        $_REQUEST = array();
      }
}
?>
<form action="/ajax/bigform.php" enctype="multipart/form-data" method="post" id="<?=$formid;?>" class="bigform">
  <div class="form-top"></div>
  <div class="form-bot"></div>
  <div class="content">
      <h3><?=$formname ?></h3>
      <? if($arError){ ?><p class="error_form"><?=  implode("<br>", $arError)?></p><? } ?>
			<div class="form-item"><label for="<?php echo $formid; ?>-form-name">Имя</label><input class="form-text form-name" id="<?php echo $formid; ?>-form-name" name="name" maxlength="100" type="text" value="<?= $_REQUEST["name"] ?>" /></div>
			<div class="form-item"><label for="<?php echo $formid; ?>-form-phone">Телефон</label><input class="form-text form-phone masked" id="<?php echo $formid; ?>-form-phone" maxlength="20" name="phone" type="text" value="<?= $_REQUEST["phone"] ?>" /></div>
			<div class="form-item"><label for="<?php echo $formid; ?>-form-mail">E-mail</label><input class="form-text form-mail" id="<?php echo $formid; ?>-form-mail" name="mail" maxlength="100" type="text" value="<?= $_REQUEST["mail"] ?>" /></div>
			<div class="form-item"><label for="<?php echo $formid; ?>-form-comment">Комментарий</label><textarea class="form-textarea form-comment" id="<?php echo $formid; ?>-form-comment" maxlength="1000" name="comment" rows="5" ><?= $_REQUEST["comment"] ?></textarea></div>
			  <div class="actions clearfix">
			  <a class="btn submit right" onclick="javascript:$('#<?=$formid;?>').submit();return false;"><span>Отправить заявку</span></a>
			  </div>
  </div>
  <input name="submit" type="hidden" value="Y" />
  <input name="popup" type="hidden" value="<?=$popup;?>" />
  <input name="formname" type="hidden" value="<?=$formname;?>" />
  <input name="formid" type="hidden" value="<?=$formid;?>" />
</form>
<script>
	$("#<?=$formid;?>").submit(function() {
  	  sendEvent('request-start', 'request');
	});
  makePlaceHolder($("#<?=$formid;?>"));
</script>
<?
exit;