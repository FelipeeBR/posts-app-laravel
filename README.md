# 🚀 API REST em Laravel
Este projeto é uma API REST desenvolvida em Laravel, com foco em boas práticas e aprendizado de TDD (Test Driven Development).
Foi implementada autenticação baseada em tokens utilizando Laravel Sanctum

## ⚙️ Funcionalidades
- ✅ CRUD de usuários
- ✅ Autenticação via token (Sanctum)
- ✅ Testes automatizados com PHPUnit seguindo TDD

## 🧪 Testes Implementados
- #### 👤 Users (UserTest)
  - ```test_can_create_user()``` – cria um usuário válido
  - ```test_cannot_create_user_with_existing_email()``` – impede e-mail duplicado
  - ```test_cannot_create_user_with_invalid_name()``` – valida nome inválido
  - ```test_cannot_create_user_with_invalid_email()``` – valida e-mail inválido
  - ```test_cannot_create_user_with_invalid_password()``` – valida senha inválida
  - ```test_can_update_user()``` – atualiza um usuário existente
- #### Auth (AuthTest)
  - ```test_auth()``` – autenticação com credenciais válidas

## 📦 Tecnologias Utilizadas
- Laravel 12
- Sanctum (autenticação)
- PHPUnit (testes)
