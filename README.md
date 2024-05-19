# Encurtador

- Projeto criado para gerar urls curtas;
- Painel administrador para gerenciar urls;
- Rota /home/{slug} utilizada para redirecionar;
- Libs:
  - [Vite.js](https://vitejs.dev/);
  - ~~[bootstrap-v5](https://getbootstrap.com/)~~;
  - [bootstrapIcons](https://icons.getbootstrap.com/);
  - [alpinejs](https://alpinejs.dev/);
  - [axios](https://github.com/axios/axios);
  - [tailwindcss](https://tailwindcss.com/);

### Rotas

- Home
  - GET /home/link
- Autenticação
  - GET /login
- Raiz
    - GET /
        - redireciona para a url de fallback configurada na variável APP_URL_FALLBACK 
- Rotas protegidas por autenticação:
    - Endereço
        - GET /endereco/index
        - GET /endereco/create
        - POST /endereco/store
        - GET /endereco/edit
        - POST /endereco/update
        - DELETE /endereco/destroy
    - Profile
        - GET /profile
        - PATCH /profile
        - DELETE /profile


# Dev

#### Instalação dos pacotes e configuração:
##### Baixar pacotes npm:
`npm install`

##### Construir e executar pacotes de build:
`npm run build`

##### Manter construção observando alterações:
`npm run dev`

##### Instalar pacotes para funcionamento do Laravel:
`composer install`

##### Subir serviço laravel:
`php artisan serve`
