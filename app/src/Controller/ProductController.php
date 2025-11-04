<?php

namespace App\Controller;

// Importações (use) necessárias
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
// A LINHA QUE PROVAVELMENTE ESTÁ FALTANDO É ESTA:
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// -----------------------------------------------------------------
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * Rota original (pode manter ou remover)
     */
    #[Route('/product', name: 'app_product')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Bem-vindo ao ProductController!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }

    /**
     * NOVA ROTA: Baseada na documentação "Persistindo Objetos"
     * Esta rota irá criar e salvar um novo produto.
     */
    #[Route('/product/create', name: 'app_product_create')]
    public function createProduct(EntityManagerInterface $entityManager): Response
    {
        // 1. Instancie sua entidade Product
        $product = new Product();
        
        // 2. Defina os dados (use os setters que o make:entity criou)
        $product->setName('Teclado Ergonômico');
        $product->setPrice(199.99); 
        $product->setDescription('Um ótimo teclado para longas horas de digitação.');

        // 3. "Persist"
        $entityManager->persist($product);

        // 4. "Flush"
        $entityManager->flush();

        // 5. Retorne uma resposta
        return new JsonResponse([
            'message' => 'Produto salvo com sucesso!',
            'productId' => $product->getId()
        ], Response::HTTP_CREATED); 
    }
}
