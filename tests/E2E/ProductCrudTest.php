<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class ProductCrudTest extends PantherTestCase
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

    private function loginAsAdmin(): void
    {
        $this->client->request('GET', '/login');
        $this->client->submitForm('Sign in', [
            'email' => 'admin@example.com',
            'password' => 'admin123!',
        ]);
    }

    /**
     * @test
     * @group e2e
     * @group products
     */
    public function adminCanCreateReadUpdateAndDeleteProduct(): void
    {
        $client = $this->client;

        // CREATE
        $crawler = $client->request('GET', '/admin/product/new');
        
        $form = $crawler->selectButton('Create product')->form([
            'product[name]' => 'Test Product',
            'product[price]' => '99.99',
            'product[description]' => 'Test Description',
            'product[category]' => '1', // Assuming category ID 1 exists
        ]);

        $client->submit($form);
        $this->assertSelectorTextContains('.alert-success', 'Product created successfully');

        // READ
        $client->request('GET', '/admin/products');
        $this->assertSelectorTextContains('.product-list', 'Test Product');

        // UPDATE
        $crawler = $client->clickLink('Edit Test Product');
        
        $form = $crawler->selectButton('Update product')->form([
            'product[name]' => 'Updated Product',
            'product[price]' => '149.99',
        ]);

        $client->submit($form);
        $this->assertSelectorTextContains('.alert-success', 'Product updated successfully');

        // DELETE
        $client->request('GET', '/admin/products');
        $client->clickLink('Delete Updated Product');
        $client->acceptDialog(); // Pour confirmer la suppression

        $this->assertSelectorTextContains('.alert-success', 'Product deleted successfully');
        $this->assertSelectorTextNotContains('.product-list', 'Updated Product');
    }
} 