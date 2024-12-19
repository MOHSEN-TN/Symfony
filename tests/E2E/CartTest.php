<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class CartTest extends PantherTestCase
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
     * @group cart
     */
    public function userCanAddToCartAndCheckout(): void
    {
        $client = $this->client;

        // Ajout au panier
        $client->request('GET', '/products');
        $client->clickLink('Add to Cart');
        
        $this->assertSelectorTextContains('.cart-count', '1');
        $this->assertSelectorTextContains('.alert-success', 'Product added to cart');

        // Voir le panier
        $client->request('GET', '/cart');
        $this->assertSelectorExists('.cart-item');
        $this->assertSelectorTextContains('.cart-total', '99.99');

        // Checkout
        $client->clickLink('Proceed to Checkout');
        
        $client->submitForm('Complete Order', [
            'order[shippingAddress][street]' => '123 Test St',
            'order[shippingAddress][city]' => 'Test City',
            'order[shippingAddress][zipCode]' => '12345',
            'order[paymentMethod]' => 'card',
        ]);

        $this->assertSelectorTextContains('.alert-success', 'Order completed successfully');
        $this->assertSelectorTextContains('.cart-count', '0');
    }
} 