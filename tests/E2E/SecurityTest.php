<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class SecurityTest extends PantherTestCase
{
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        // Créer les capacités Opera
        $capabilities = DesiredCapabilities::chrome();
        $operaOptions = [
            'chromeBinary' => 'C:\Users\DESKTOP\Downloads\chromedriver-win32\chromedriver-win32\chromedriver.exe',

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

    /**
     * @test
     * @group e2e
     * @group auth
     */
    public function userCanRegisterSuccessfully(): void
    {
        $client = $this->client;

        // Visite de la page d'inscription
        $crawler = $client->request('GET', '/register');
        
        // Remplissage du formulaire
        $form = $crawler->selectButton('Register')->form([
            'registration_form[email]' => 'test@example.com',
            'registration_form[plainPassword]' => 'Test123!',
            'registration_form[agreeTerms]' => true,
        ]);

        $client->submit($form);

        // Vérifications
        $this->assertSelectorTextContains('.alert-success', 'Registration successful');
        $this->assertPageTitleContains('Login');
    }

    /**
     * @test
     * @group e2e
     * @group auth
     */
    public function userCanLoginAndLogout(): void
    {
        $client = $this->client;

        // Login
        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('Sign in')->form([
            'email' => 'test@example.com',
            'password' => 'Test123!',
        ]);

        $client->submit($form);

        // Vérification du login
        $this->assertSelectorTextContains('.user-info', 'test@example.com');
        
        // Logout
        $client->clickLink('Logout');
        
        // Vérification du logout
        $this->assertPageTitleContains('Login');
    }
} 