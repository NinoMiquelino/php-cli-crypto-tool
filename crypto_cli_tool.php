<?php
/**
 * Ferramenta CLI em PHP para Geração e Validação de Chaves Criptográficas (RSA e ECDSA).
 * Este script demonstra o uso da extensão 'openssl' para criar pares de chaves
 * e para assinar e verificar dados.
 *
 * Requer: PHP com a extensão 'openssl' habilitada.
 * Uso: php crypto_cli_tool.php
 */

// Define o texto que será assinado e verificado
$messageToSign = "Esta é uma mensagem de teste para demonstração de assinatura digital.";

// Nomes dos arquivos temporários que serão gerados para as chaves
const RSA_PRIVATE_KEY_FILE = 'rsa_private.key';
const RSA_PUBLIC_KEY_FILE = 'rsa_public.key';
const ECDSA_PRIVATE_KEY_FILE = 'ecdsa_private.key';
const ECDSA_PUBLIC_KEY_FILE = 'ecdsa_public.key';

/**
 * Imprime uma linha de separação para melhor visualização na CLI.
 * @param string $title Título da seção.
 */
function printSection($title) {
    echo "\n" . str_repeat('=', 60) . "\n";
    echo "{$title}\n";
    echo str_repeat('=', 60) . "\n";
}

// -----------------------------------------------------
// 1. Geração de Chaves RSA
// -----------------------------------------------------

printSection("1. Geração de Par de Chaves RSA (2048 bits)");

$rsaConfig = [
    "digest_alg" => "sha256",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];

try {
    // 1.1 Gerar um novo par de chaves
    $rsaKeyPair = openssl_pkey_new($rsaConfig);
    if (!$rsaKeyPair) {
        throw new Exception("Falha ao gerar par de chaves RSA: " . openssl_error_string());
    }

    // 1.2 Extrair Chave Privada
    openssl_pkey_export($rsaKeyPair, $rsaPrivateKey, null, $rsaConfig);
    file_put_contents(RSA_PRIVATE_KEY_FILE, $rsaPrivateKey);
    echo "Chave Privada RSA salva em: " . RSA_PRIVATE_KEY_FILE . "\n";

    // 1.3 Extrair Chave Pública
    $rsaDetails = openssl_pkey_get_details($rsaKeyPair);
    $rsaPublicKey = $rsaDetails['key'];
    file_put_contents(RSA_PUBLIC_KEY_FILE, $rsaPublicKey);
    echo "Chave Pública RSA salva em: " . RSA_PUBLIC_KEY_FILE . "\n";

} catch (Exception $e) {
    die("ERRO RSA: " . $e->getMessage() . "\n");
}


// -----------------------------------------------------
// 2. Assinatura e Validação RSA
// -----------------------------------------------------

printSection("2. Demonstração de Assinatura RSA");

// Assinatura
$rsaSignature = '';
if (openssl_sign($messageToSign, $rsaSignature, $rsaPrivateKey, OPENSSL_ALGO_SHA256)) {
    echo "Mensagem assinada com sucesso (RSA).\n";
    // echo "Assinatura (Base64): " . base64_encode($rsaSignature) . "\n";
} else {
    die("ERRO: Falha na assinatura RSA: " . openssl_error_string() . "\n");
}

// Validação
$rsaVerifyResult = openssl_verify($messageToSign, $rsaSignature, $rsaPublicKey, OPENSSL_ALGO_SHA256);

if ($rsaVerifyResult === 1) {
    echo "\n✅ VALIDAÇÃO RSA: Assinatura VÁLIDA!\n";
} elseif ($rsaVerifyResult === 0) {
    echo "\n❌ VALIDAÇÃO RSA: Assinatura INVÁLIDA.\n";
} else {
    echo "\n⚠️ ERRO: Falha na verificação RSA: " . openssl_error_string() . "\n";
}


// -----------------------------------------------------
// 3. Geração de Chaves ECDSA
// -----------------------------------------------------

printSection("3. Geração de Par de Chaves ECDSA (Curva prime256v1)");

// Parâmetros ECDSA (Elliptic Curve Digital Signature Algorithm)
$ecdsaConfig = [
    "digest_alg" => "sha256",
    "private_key_type" => OPENSSL_KEYTYPE_EC,
    "curve_name" => "prime256v1", // Curva comum
];

try {
    // 3.1 Gerar um novo par de chaves ECDSA
    $ecdsaKeyPair = openssl_pkey_new($ecdsaConfig);
    if (!$ecdsaKeyPair) {
        throw new Exception("Falha ao gerar par de chaves ECDSA: " . openssl_error_string());
    }

    // 3.2 Extrair Chave Privada
    openssl_pkey_export($ecdsaKeyPair, $ecdsaPrivateKey, null, $ecdsaConfig);
    file_put_contents(ECDSA_PRIVATE_KEY_FILE, $ecdsaPrivateKey);
    echo "Chave Privada ECDSA salva em: " . ECDSA_PRIVATE_KEY_FILE . "\n";

    // 3.3 Extrair Chave Pública
    $ecdsaDetails = openssl_pkey_get_details($ecdsaKeyPair);
    $ecdsaPublicKey = $ecdsaDetails['key'];
    file_put_contents(ECDSA_PUBLIC_KEY_FILE, $ecdsaPublicKey);
    echo "Chave Pública ECDSA salva em: " . ECDSA_PUBLIC_KEY_FILE . "\n";

} catch (Exception $e) {
    die("ERRO ECDSA: " . $e->getMessage() . "\n");
}

// -----------------------------------------------------
// 4. Assinatura e Validação ECDSA
// -----------------------------------------------------

printSection("4. Demonstração de Assinatura ECDSA");

// Assinatura
$ecdsaSignature = '';
if (openssl_sign($messageToSign, $ecdsaSignature, $ecdsaPrivateKey, OPENSSL_ALGO_SHA256)) {
    echo "Mensagem assinada com sucesso (ECDSA).\n";
    // echo "Assinatura (Base64): " . base64_encode($ecdsaSignature) . "\n";
} else {
    die("ERRO: Falha na assinatura ECDSA: " . openssl_error_string() . "\n");
}

// Validação
$ecdsaVerifyResult = openssl_verify($messageToSign, $ecdsaSignature, $ecdsaPublicKey, OPENSSL_ALGO_SHA256);

if ($ecdsaVerifyResult === 1) {
    echo "\n✅ VALIDAÇÃO ECDSA: Assinatura VÁLIDA!\n";
} elseif ($ecdsaVerifyResult === 0) {
    echo "\n❌ VALIDAÇÃO ECDSA: Assinatura INVÁLIDA.\n";
} else {
    echo "\n⚠️ ERRO: Falha na verificação ECDSA: " . openssl_error_string() . "\n";
}

// -----------------------------------------------------
// 5. Limpeza (Opcional)
// -----------------------------------------------------

printSection("5. Limpeza de Arquivos");

@unlink(RSA_PRIVATE_KEY_FILE);
@unlink(RSA_PUBLIC_KEY_FILE);
@unlink(ECDSA_PRIVATE_KEY_FILE);
@unlink(ECDSA_PUBLIC_KEY_FILE);

echo "Arquivos de chave temporários removidos.\n";
echo str_repeat('=', 60) . "\n";
echo "Demonstração concluída com sucesso!\n";
echo str_repeat('=', 60) . "\n";

// Fim do Script
?>