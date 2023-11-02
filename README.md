
# Azapfy Back-end Test

Nesse teste foi desenvolvida uma API que faz controle de pagamento pelas
entregas realizadas.
Disponibilizou-se uma API onde foi possível consulta as notas fiscais para realizar o
cálculo de pagamento.



## Uso/Exemplos

Baixe o projeto e em seguida execute a instalação dos pacotes.

```bash
composer install
```

copie o .env.example para um novo arquivo .env e em seguida adicione a url da API de notas no atributo API_URL

```bash
API_URL="http://homologacao3.azapfy.com.br/api/ps/notas"
```

Execute o projeto

```bash
php artisan serve
```



## Documentação da API

#### Retorna as notas dos produtos agrupadas por remetente, além do valor total das notas, para cada remetente, o valor que o remetente irá receber pelo que já foi entregue, o valor que o remetente irá receber pelo que ainda não foi entregue e quanto o remetente deixou de receber devido ao atraso na entrega.


```http
  GET /api/v1/payment-for-deliveries
```

Neste repositório é possível encontrar ainda a documentação desta API em formato Postman Collection.

