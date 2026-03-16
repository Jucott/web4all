<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/core/Autoloader.php';
Autoloader::register();
define('PHPUNIT_RUNNING', true);

class EntrepriseControllerTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        // Mock partiel pour render et redirect
        $this->controller = $this->getMockBuilder('EntrepriseController')
            ->onlyMethods(['render', 'redirect'])
            ->getMock();
    }

    public function testCreateGet()
    {
        $this->controller->expects($this->once())
            ->method('render')
            ->with('entreprise/create');

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->controller->create();
    }

    public function testCreatePostValidData()
    {
        $this->controller->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'nom' => 'Valid',
            'description' => 'Desc',
            'telephone' => '0123456789',
            'email' => 'test@test.com'
        ];
        $this->controller->create();
    }

    public function testRecherchePostInvalidData()
    {
        $this->controller->expects($this->once())
            ->method('render')
            ->with(
                'entreprise/recherche',
                $this->callback(fn($params) =>
                    array_key_exists('errors', $params) &&
                    ($params['errors'] === null || is_array($params['errors']))
                )
            );

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['nom' => '']; // invalide
        $this->controller->recherche();
    }

    public function testModifyPostValidData()
    {
        // Crée le mock du modèle Entreprise
        $entrepriseMock = $this->createMock(Entreprise::class);
        $entrepriseMock->method('findById')->willReturn([
            'id_entreprise' => 1,
            'nom' => 'OldName',
            'description' => 'OldDesc',
            'telephone' => '0000000000',
            'email' => 'old@test.com'
        ]);
        $entrepriseMock->method('update')->willReturn(true);

        // Crée le mock du contrôleur avec getEntrepriseModel, render et redirect mockés
        $controllerMock = $this->getMockBuilder(EntrepriseController::class)
            ->onlyMethods(['getEntrepriseModel', 'render', 'redirect'])
            ->getMock();

        // Retourne le mock du modèle quand getEntrepriseModel est appelé
        $controllerMock->method('getEntrepriseModel')->willReturn($entrepriseMock);

        // On s’attend à ce que redirect soit appelée une fois avec cette URL
        $controllerMock->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'nom' => 'Valid',
            'description' => 'Desc',
            'telephone' => '0123456789',
            'email' => 'test@test.com'
        ];

        // Appel de la méthode à tester
        $controllerMock->modify(1);
    }

    public function testDelete()
    {
        // Crée le mock du modèle Entreprise
        $entrepriseMock = $this->createMock(Entreprise::class);
        $entrepriseMock->method('delete')->willReturn(true);

        // Crée le mock du contrôleur avec getEntrepriseModel et redirect mockés
        $controllerMock = $this->getMockBuilder(EntrepriseController::class)
            ->onlyMethods(['getEntrepriseModel', 'redirect'])
            ->getMock();

        // Retourne le mock du modèle quand getEntrepriseModel est appelé
        $controllerMock->method('getEntrepriseModel')->willReturn($entrepriseMock);

        // On s’attend à ce que redirect soit appelée une fois avec cette URL
        $controllerMock->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        // Appel de la méthode à tester
        $controllerMock->delete(1);
    }
}