<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product; // Certifique-se que este 'use' está presente
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; // 'Attribute' é o correto para S7

class ProductController extends AbstractController
{
    /**
     * Esta rota agora lida com GET (mostrar formulário) e POST (processar formulário)
     */
    #[Route('/product', name: 'create_product', methods: ['GET', 'POST'])]
    public function createProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Variável para controlar a mensagem de sucesso
        $success = false;

        // Se o formulário foi enviado (método POST)
        if ($request->isMethod('POST')) {
            // 1. Obtenha os dados do formulário
            $name = $request->request->get('name');
            $price = $request->request->get('price');
            // ADICIONADO PARA EVITAR O ERRO:
            $description = $request->request->get('description'); 

            // 2. Crie e salve o produto
            $product = new Product();
            $product->setName($name);
            $product->setPrice($price);
            // ADICIONADO PARA EVITAR O ERRO:
            $product->setDescription($description);

            $entityManager->persist($product);
            $entityManager->flush();

            // 3. Marque como sucesso
            $success = true;
        }

        // 4. Renderize a view (o formulário)
        // Isso acontece em ambos os casos (GET ou POST)
        return $this->render('product/create.html.twig', [
            'success' => $success,
        ]);
    }
}

