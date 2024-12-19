<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class ProfileTest extends PantherTestCase
{
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        // Créer les capacités Opera
        $capabilities = DesiredCapabilities::chrome();
        $operaOptions = [
            'binary' => 'C:\Users\DESKTOP\AppData\Local\Programs\Opera GX\opera.exe',
            'args' => [
                '--window-size=1920,1080',
                '--start-maximized',
                '--disable-gpu',
                '--no-sandbox',
                '--disable-dev-shm-usage',
                '--disable-extensions',
                '--disable-logging',
                '--log-level=3',
                '--silent'
            ]
        ];
        $capabilities->setCapability('operaOptions', $operaOptions);

        // Configurer le client Panther
        $this->client = static::createPantherClient([
            'browser' => static::CHROME, // On utilise CHROME comme base
            'chromedriver_binary' => 'C:\Users\DESKTOP\Downloads\Compressed\operadriver_win64\operadriver_win64\operadriver.exe',
            'capabilities' => $capabilities
        ]);

        // Configurer les timeouts
        $this->client->manage()->timeouts()->implicitlyWait(2000);
        $this->client->manage()->window()->maximize();
    }

    private function loginAsUser(): void
    {
        $this->client->request('GET', '/login');
        $this->client->submitForm('Sign in', [
            'email' => 'user@example.com',
            'password' => 'user123!',
        ]);
    }

    /**
     * @test
     * @group e2e
     * @group profile
     */
    public function userCanUpdateProfile(): void
    {
        $client = $this->client;

        // Accès au profil
        $crawler = $client->request('GET', '/profile');
        
        // Mise à jour du profil
        $form = $crawler->selectButton('Update Profile')->form([
            'profile[firstName]' => 'John',
            'profile[lastName]' => 'Doe',
            'profile[phone]' => '1234567890',
        ]);

        $client->submit($form);
        
        $this->assertSelectorTextContains('.alert-success', 'Profile updated successfully');
        $this->assertSelectorTextContains('.profile-name', 'John Doe');
    }

    /**
     * @test
     * @group e2e
     * @group profile
     */
    public function userCanChangePassword(): void
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/profile/change-password');
        
        $form = $crawler->selectButton('Change Password')->form([
            'change_password[currentPassword]' => 'user123!',
            'change_password[newPassword]' => 'newPass123!',
            'change_password[confirmPassword]' => 'newPass123!',
        ]);

        $client->submit($form);
        
        $this->assertSelectorTextContains('.alert-success', 'Password changed successfully');
    }
} 