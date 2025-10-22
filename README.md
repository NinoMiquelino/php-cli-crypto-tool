## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 🔐 Ferramenta CLI PHP para Geração e Validação de Chaves Criptográficas (RSA/ECDSA)
![Made with PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)

## 🧭 Descrição
Este projeto é uma **ferramenta de linha de comando (CLI)** desenvolvida em **PHP** que demonstra o fluxo completo de **criptografia de chave pública e assinatura digital** utilizando a extensão nativa **OpenSSL**.  

O objetivo principal é fornecer um **exemplo prático e didático** de como gerar pares de chaves criptográficas assíncronas (tanto **RSA** quanto **ECDSA — Curva prime256v1**) e como utilizá-las de forma segura para **assinar** e **validar a integridade de dados**.

---

## ⚙️ Funcionalidades e Escopo
- 🗝️ **Geração de Chaves:** Criação de pares de chaves pública e privada para **RSA (2048 bits)** e **ECDSA (prime256v1)**, salvas em formato **PEM**.  
- ✍️ **Assinatura Digital:** Demonstra a assinatura de uma mensagem de teste usando a **chave privada** gerada, garantindo **autenticidade**.  
- ✅ **Validação:** Verifica a **autenticidade e integridade** da assinatura utilizando a **chave pública** correspondente (assegurando que a mensagem não foi adulterada).  
- 💻 **CLI (Command Line Interface):** Implementação 100% em **PHP**, ideal para execução e testes rápidos em ambientes de servidor ou terminal.

---

## 🚀 Como Executar
O script é **autônomo** — não requer dependências externas.  
Certifique-se apenas de que a **extensão `openssl` do PHP** está habilitada.

```bash
php crypto_cli_tool.php
```

Durante a execução, o script exibirá o passo a passo completo:
Geração das chaves (RSA e ECDSA)
Assinatura de uma mensagem
Validação da assinatura digital

---

## 🧩 Tecnologias e Conceitos
Tipo
Detalhes
- 💬 Linguagem
PHP (Execução via CLI)
- 🔒 Criptografia
Extensão OpenSSL (Componente nativo do PHP)
- ⚙️ Algoritmos
RSA e ECDSA (Elliptic Curve Digital Signature Algorithm)
- 🧮 Hashing
SHA-256 (Padrão para assinatura digital)
- 💻 Interface
CLI (Linha de Comando)
- 🧠 Objetivo Educacional
Este projeto foi criado com foco didático, permitindo compreender de forma clara:
A diferença entre RSA e ECDSA
O fluxo de geração de chaves, assinatura e verificação
Como utilizar funções nativas do PHP com openssl_* de forma segura e prática

- 📘 Desenvolvido como exemplo prático de uso do OpenSSL no PHP para operações de criptografia e assinatura digital via linha de comando.

## 🧾 Licença
Distribuído sob a licença **MIT**.  
Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.
Sinta-se livre para estudar, modificar e utilizar em seus próprios projetos.

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/php-cli-crypto-tool/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/php-cli-crypto-tool/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
