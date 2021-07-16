<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'firstname' => 'user',
                'lastname' => 'user',
                'password' => 'user',
                'isadmin' => false
            ],
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'firstname' => 'admin',
                'lastname' => 'admin',
                'password' => 'admin',
                'isadmin' => true
            ]
            ];
       
        foreach ($users as $user) {
            $object = new User();
            $object->setUsername($user['username']);
            $object->setEmail($user['email']);
            $object->setFirstname($user['firstname']);
            $object->setLastname($user['lastname']);
            $object->setPassword($this->encoder->hashPassword($object, $user['password']));
            if ($user['isadmin']) {
                $object->setRoles(['ROLE_ADMIN']);
            }
            $manager->persist($object);

            $this->addReference('user_'.$user['username'], $object);
        }

        $manager->flush();
    }
}
