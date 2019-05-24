<?php
/**
 * @package    Cluster
 *
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (C) 2009 - 2018 Techjoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('formbehavior.chosen', 'select');
$app = Factory::getApplication();
$input = $app->input;

Factory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task == "cluster.cancel" || document.formvalidator.isValid(document.getElementById("cluster-form")))
		{
			jQuery("#permissions-sliders select").attr("disabled", "disabled");
			Joomla.submitform(task, document.getElementById("cluster-form"));
		}
	};
');
?>
<div class="">
	<form action="<?php echo Route::_('index.php?option=com_cluster&view=cluster&layout=edit&id=' . (int) $this->item->id, false);?>"
		method="post" enctype="multipart/form-data" name="adminForm" id="cluster-form" class="form-validate">
		<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->renderField('name'); ?>
				<?php echo $this->form->renderField('description'); ?>
				<?php echo $this->form->renderField('params'); ?>
				<?php echo $this->form->renderField('client'); ?>
				<?php echo $this->form->renderField('client_id'); ?>
				<?php echo $this->form->renderField('state'); ?>

				<?php echo $this->form->getInput('created_by'); ?>
				<?php echo $this->form->getInput('modified_on'); ?>
				<?php echo $this->form->getInput('modified_by'); ?>
				<?php echo $this->form->getInput('ordering'); ?>
				<?php echo $this->form->getInput('checked_out'); ?>
				<?php echo $this->form->getInput('checked_out_time'); ?>
			</div>
		</div>
		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
	</form>
</div>
