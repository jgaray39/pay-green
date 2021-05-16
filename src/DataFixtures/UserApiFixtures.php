<?php

namespace App\DataFixtures;

use App\Entity\UserApi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserApiFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

    // create admin user
    $admin = new UserApi();
    $admin->setUsername('admin@admin.fr');
    $admin->setEnabled(true);
    $admin->setRoles(['ROLE_API_ADMIN']);
    $password = $this->encoder->encodePassword($admin, 'admin');
    $admin->setPassword($password);
    $manager->persist($admin);

    // create client user
    $user = new UserApi();
    $user->setUsername('user@user.fr');
    $user->setEnabled(true);
    $user->setRoles(['ROLE_API_USER']);
    $password = $this->encoder->encodePassword($user, 'user');
    $user->setPassword($password);
    $manager->persist($user);

    $manager->flush();

    }
}