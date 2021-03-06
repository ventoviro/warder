<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Lyrasoft\Warder\Form\User;

use Lyrasoft\Warder\Helper\WarderHelper;
use Windwalker\Core\Form\AbstractFieldDefinition;
use Windwalker\Form\Form;

/**
 * The ForgetDefinition class.
 *
 * @since  1.0
 */
class ForgetRequestDefinition extends AbstractFieldDefinition
{
    /**
     * Define the form fields.
     *
     * @param Form $form The Windwalker form object.
     *
     * @return  void
     */
    public function doDefine(Form $form)
    {
        $langPrefix = WarderHelper::getPackage()->get('frontend.language.prefix', 'warder.');

        $this->email('email')
            ->label(__($langPrefix . 'user.field.email'))
            ->required();
    }
}
