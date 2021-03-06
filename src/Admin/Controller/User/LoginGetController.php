<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Lyrasoft\Warder\Admin\Controller\User;

use Lyrasoft\Warder\Helper\WarderHelper;
use Lyrasoft\Warder\Warder;
use Phoenix\Controller\Display\DisplayController;

/**
 * The GetController class.
 *
 * @since  1.0
 */
class LoginGetController extends DisplayController
{
    /**
     * Property name.
     *
     * @var  string
     */
    protected $name = 'user';

    /**
     * prepareExecute
     *
     * @return  void
     * @throws \Psr\Cache\InvalidArgumentException
     */
    protected function prepareExecute()
    {
        $return = $this->input->getBase64(
            $this->package->get('admin.login.return_key', 'return')
        );

        if (Warder::isLogin()) {
            if ($return) {
                $this->app->redirect(base64_decode($return));
            } else {
                $this->app->redirect($this->getHomeRedirect());
            }

            return;
        }

        if ($return) {
            $this->setUserState($this->getContext('return'), $return);
        }

        parent::prepareExecute();
    }

    /**
     * getHomeRedirect
     *
     * @return  string
     * @throws \Psr\Cache\InvalidArgumentException
     */
    protected function getHomeRedirect()
    {
        return $this->router->route(WarderHelper::getPackage()->get('admin.redirect.login', 'home'));
    }
}
