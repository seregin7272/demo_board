<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.04.18
 * Time: 14:02
 */

namespace Tests\Unit\Entity\User;

use Tests\TestCase;
use App\Entity\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{

    use DatabaseTransactions;

    public function testChange(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);

        self::assertTrue($user->isAdmin());
    }

    public function testAlready(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_ADMIN]);

        $this->expectExceptionMessage('Role is already assigned.');

        $user->changeRole(User::ROLE_ADMIN);
    }


}
