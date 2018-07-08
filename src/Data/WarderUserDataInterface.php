<?php
/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2018 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

namespace Lyrasoft\Warder\Data;

use Windwalker\Core\User\UserDataInterface;

/**
 * Interface WarderUserDataInterface
 *
 * @since  1.4.2
 */
interface WarderUserDataInterface extends UserDataInterface
{
    /**
     * authorise
     *
     * @param string $policy
     * @param mixed  ...$args
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function authorise($policy, ...$args);

    /**
     * can
     *
     * @param string $policy
     * @param mixed  ...$args
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function can($policy, ...$args);

    /**
     * cannot
     *
     * @param string $policy
     * @param mixed  ...$args
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function cannot($policy, ...$args);

    /**
     * is
     *
     * @param string $policy
     * @param mixed  ...$args
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function is($policy, ...$args);

    /**
     * not
     *
     * @param string $policy
     * @param mixed  ...$args
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function not($policy, ...$args);

    /**
     * isGroup
     *
     * @param string|array $groups
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function isGroup($groups);

    /**
     * isLogin
     *
     * @return  bool
     *
     * @since  1.4.2
     */
    public function isLogin();
}