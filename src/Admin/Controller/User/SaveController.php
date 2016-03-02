<?php
/**
 * Part of phoenix project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\Warder\Admin\Controller\User;

use Phoenix\Controller\AbstractSaveController;
use Windwalker\Core\Authentication\User;
use Windwalker\Core\Language\Translator;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\Warder\Helper\WarderHelper;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractSaveController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'user';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'user';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'users';

	/**
	 * Property langPrefix.
	 *
	 * @var  string
	 */
	protected $langPrefix = 'warder.';

	/**
	 * preSave
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	protected function preSave(Data $data)
	{
		// Remove password from session
		unset($this->data['password']);
		unset($this->data['password2']);
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	protected function validate(Data $data)
	{
		parent::validate($data);

		$loginName = WarderHelper::getLoginName();

		if ($loginName != 'email')
		{
			$user = User::get(array($loginName => $data->$loginName));

			if ($user->notNull() && $user->id != $data->id)
			{
				throw new ValidFailException(Translator::translate($this->langPrefix . 'message.user.account.exists'));
			}
		}

		$user = User::get(array('email' => $data->email));

		if ($user->notNull() && $user->id != $data->id)
		{
			throw new ValidFailException(Translator::translate($this->langPrefix . 'message.user.email.exists'));
		}

		if ('' !== (string) $data->password)
		{
			if ($data->password != $data->password2)
			{
				throw new ValidFailException(Translator::translate($this->langPrefix . 'message.password.not.match'));
			}

			unset($data->password2);
		}
		else
		{
			unset($data->password);
		}
	}
}