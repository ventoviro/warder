<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Lyrasoft\Warder\Admin\Form\User;

use Lyrasoft\Unidev\Field\SingleImageDragField;
use Lyrasoft\Warder\Helper\AvatarUploadHelper;
use Lyrasoft\Warder\Helper\WarderHelper;
use Lyrasoft\Warder\Validator\UserExistsValidator;
use Phoenix\Field\CalendarField;
use Phoenix\Form\PhoenixFieldTrait;
use Windwalker\Core\Form\AbstractFieldDefinition;
use Windwalker\Core\Language\Translator;
use Windwalker\Form\Field;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The UserEditDefinition class.
 *
 * @since  1.0
 */
class EditDefinition extends AbstractFieldDefinition
{
	use PhoenixFieldTrait;

	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 * @throws \InvalidArgumentException
	 */
	public function doDefine(Form $form)
	{
		$warder = WarderHelper::getPackage();

		$loginName = WarderHelper::getLoginName();
		$langPrefix = $warder->get('admin.language.prefix', 'warder.');

		// Basic fieldset
		$form->fieldset('basic', function(Form $form) use ($loginName, $langPrefix)
		{
			// Name
			$this->text('name')
				->label(Translator::translate($langPrefix . 'user.field.name'))
				->addFilter('trim')
				->required(true);

			if ($loginName !== 'email')
			{
				// Name
				$this->text($loginName)
					->label(Translator::translate($langPrefix . 'user.field.' . $loginName))
					->addValidator(new UserExistsValidator($loginName))
					->addFilter('trim')
					->autocomplete('false')
					->required(true);
			}

			// Email
			$this->email('email')
				->label(Translator::translate($langPrefix . 'user.field.email'))
				->addValidator(new UserExistsValidator('email'))
				->addFilter('trim')
				->autocomplete('false')
				->required();

			// Password
			$this->password('password')
				->autocomplete('false')
				->label(Translator::translate($langPrefix . 'user.field.password'));

			// Password
			$this->password('password2')
				->autocomplete('false')
				->label(Translator::translate($langPrefix . 'user.field.password.confirm'));
		});

		// Created fieldset
		$form->fieldset('created', function(Form $form) use ($langPrefix)
		{
			if (class_exists(SingleImageDragField::class))
			{
				// Avatar
				$this->add('avatar', new SingleImageDragField)
					->label(Translator::translate($langPrefix . 'user.field.avatar'))
					->set('default_image', AvatarUploadHelper::getDefaultImage());
			}

			// Blocked
			$this->radio('blocked')
				->label(Translator::translate($langPrefix . 'user.field.enabled'))
				->class('btn-group')
				->defaultValue(0)
				->option(Translator::translate($langPrefix . 'user.field.blocked.block'), 1)
				->option(Translator::translate($langPrefix . 'user.field.blocked.unblock'), 0);

			// ID
			$this->text('id')
				->label(Translator::translate($langPrefix . 'user.field.id'))
				->readonly();

			// Registered
			$this->calendar('registered')
				->label(Translator::translate($langPrefix . 'user.field.registered'))
				->disabled();

			// Last Login
			$this->calendar('last_login')
				->label(Translator::translate($langPrefix . 'user.field.last.login'))
				->disabled();
		});
	}
}
