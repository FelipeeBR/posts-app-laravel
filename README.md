# 🚀 API REST em Laravel com TDD - PHPUnit
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
- #### Post (PostTest)
  - ```test_can_create_post()``` - cria uma postagem
  - ```test_cannot_create_post_without_title()``` - valida se a postagem tem titulo
  - ```test_can_update_post()``` - atualiza uma postagem
  - ```test_can_view_post()``` - visualiza um postagem existente
  - ```test_can_views_all_posts``` - visualiza todas as postagens
  - ```test_can_delete_post()``` - deleta uma postagem
  - #### Tags (TagTest)
    - ```test_can_create_tag()``` - cria uma tag
    - ```test_can_update_tag()``` - atualiza uma tag
    - ```test_can_delete_tag()``` - deleta uma tag
    - ```test_cannot_create_tag_with_existing_slug()``` - valida se slug existe
    - ```test_can_view_tag()``` - visualiza uma tag
    - ```test_can_view_all_tags()``` - visualiza todas as tags

## 📦 Tecnologias Utilizadas
- Laravel 12
- Sanctum (autenticação)
- PHPUnit (testes)
