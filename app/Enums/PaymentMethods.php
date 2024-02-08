<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case pix = "PIX";
    case bolbradesco = "Boleto";
    case credit_card = "Cartão de Crédito";
    case debit_card = "Cartão de Débito";

}