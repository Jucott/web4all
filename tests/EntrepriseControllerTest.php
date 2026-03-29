<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/core/Autoloader.php';
Autoloader::register();

class EntrepriseControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $_POST = [];
        $_GET = [];
        $_REQUEST = [];
        $_SERVER['REQUEST_METHOD'] = 'GET';

        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        $_SESSION['csrf_token'] = 'test_token';
        $_SESSION['user'] = ['id' => 1];
    }

    /**
     * Helper : contrôleur mocké avec render intercepté
     */
    private function getSafeController(array $methods = [])
    {
        $methods[] = 'render';

        return $this->getMockBuilder(EntrepriseController::class)
            ->onlyMethods(array_unique($methods))
            ->getMock();
    }

    public function testCreateGet()
    {
        $controller = $this->getSafeController(['getEntrepriseModel']);

        $controller->method('getEntrepriseModel')
            ->willReturn($this->createMock(Entreprise::class));

        $controller->expects($this->once())
            ->method('render')
            ->with('entreprise/create');

        $controller->create();
    }

    public function testCreatePostValidData()
    {
        $entrepriseMock = $this->createMock(Entreprise::class);

        $entrepriseMock->expects($this->once())
            ->method('create');

        $controller = $this->getSafeController(['getEntrepriseModel', 'redirect']);

        $controller->method('getEntrepriseModel')
            ->willReturn($entrepriseMock);

        $controller->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'csrf_token' => 'test_token',
            'nom' => 'ValidName',
            'description' => 'Description valide',
            'telephone' => '0123456789',
            'email' => 'test@test.com'
        ];

        $controller->create();
    }

    public function testRecherchePostInvalidData()
    {
        $entrepriseMock = $this->createMock(Entreprise::class);

        $entrepriseMock->expects($this->once())
            ->method('search')
            ->willReturn([
                'results' => [],
                'total' => 0
            ]);

        $controller = $this->getSafeController(['getEntrepriseModel']);

        $controller->method('getEntrepriseModel')
            ->willReturn($entrepriseMock);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'entreprise/recherche',
                $this->callback(fn ($params) => array_key_exists('errors', $params))
            );

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'csrf_token' => 'test_token',
            'nom' => 'ValidName'
        ];

        $controller->recherche();
    }

    public function testModifyPostValidData()
    {
        $entrepriseMock = $this->createMock(Entreprise::class);

        $entrepriseMock->method('findById')->willReturn([
            'id_entreprise' => 1,
            'nom' => 'OldName',
            'description' => 'OldDesc',
            'telephone' => '0000000000',
            'email' => 'old@test.com',
            'valide' => true
        ]);

        $entrepriseMock->expects($this->once())
            ->method('update');

        $controller = $this->getSafeController(['getEntrepriseModel', 'redirect']);

        $controller->method('getEntrepriseModel')
            ->willReturn($entrepriseMock);

        $controller->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'csrf_token' => 'test_token',
            'nom' => 'ValidName',
            'description' => 'Description valide',
            'telephone' => '0123456789',
            'email' => 'test@test.com',
            'valide' => true
        ];

        $controller->modify(1);
    }

    public function testDelete()
    {
        $entrepriseMock = $this->createMock(Entreprise::class);

        $entrepriseMock->expects($this->once())
            ->method('update');

        $controller = $this->getSafeController(['getEntrepriseModel', 'redirect']);

        $controller->method('getEntrepriseModel')
            ->willReturn($entrepriseMock);

        $controller->expects($this->once())
            ->method('redirect')
            ->with('/entreprise/recherche');

        $controller->delete(1);
    }
}
