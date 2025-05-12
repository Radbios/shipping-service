<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# Shipping Service - Sistema de E-commerce com Microsserviços

Este microsserviço é responsável por **calcular o valor do frete** com base no endereço de destino informado pelo usuário. Ele faz parte do sistema de e-commerce distribuído em arquitetura de microsserviços e se comunica com o API Gateway para integrar-se ao restante da aplicação.

## Função

Este serviço realiza o cálculo de opções de frete utilizando a API pública da plataforma [Melhor Envio](https://www.melhorenvio.com.br/), com base em:

* CEP de origem fixo (sede da loja)
* CEP de destino fornecido na requisição
* Informações padrão do pacote (dimensões e peso)

## 🛠️ Tecnologias Utilizadas

* **PHP 8.2+**
* **Laravel 11**
* **Laravel HTTP Client** para requisições externas
* **Melhor Envio API** para simulação de frete

## Autenticação

As requisições ao serviço de frete exigem um **token de acesso** (`SHIPPING_TOKEN`) e um **User-Agent válido** (`EMAIL`), configurados no arquivo `.env`.

---

## Integração com o Gateway

O serviço é acessado através do API Gateway pela seguinte rota:

```
POST /api/service/shipping/shipping
```

### Corpo da Requisição

```json
{
  "postal_code": "CEP_de_destino"
}
```

### Exemplo de Requisição via Gateway

```bash
curl -X POST http://localhost:8000/api/service/shipping/shipping \
     -H "Authorization: Bearer <token>" \
     -H "Content-Type: application/json" \
     -d '{"postal_code": "01001000"}'
```

---

## Estrutura Principal

| Arquivo                  | Descrição                                                                           |
| ------------------------ | ----------------------------------------------------------------------------------- |
| `ShippingController.php` | Controlador principal. Repassa os dados à API externa e retorna as opções de frete. |
| `ShippingRequest.php`    | Classe de validação que garante a presença do `postal_code`.                        |
| `ShippingResource.php`   | Recurso padrão do Laravel para formatação de resposta (não customizado).            |

---

## Requisitos

* PHP 8.2+
* Laravel 11
* Token de acesso válido do [Melhor Envio](https://www.melhorenvio.com.br/)
* Email configurado como User-Agent no `.env`

---

## Exemplo de Retorno

```json
[
  {
    "company": "Correios",
    "name": "PAC",
    "price": 22.90,
    "delivery_time": "7 dias úteis"
  },
  ...
]
```

---

## Dependência Externa

Este microsserviço depende diretamente da **API do Melhor Envio**, sendo ideal para ambientes de teste e simulação de valores reais de entrega.

---


