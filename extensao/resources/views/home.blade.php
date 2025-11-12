<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traços de Esperança</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        :root {
            --cor-primaria: #005F73;
            --cor-secundaria: #E29578;
            --cor-terciaria: #94D2BD;
            --cor-branco: #F5F5F5;
            --cor-preto: #0B0C10;
            --cor-erro-falha: #D62828;
            --cor-sucesso: #2D6A4F;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--cor-branco);
            color: var(--cor-preto);
            overflow-x: hidden;
        }

        header {
            position: fixed;
            width: 100%;
            height: 130px;
            z-index: 1030;
        }

        #logo {
            width: 15vh;
            margin: 20px 0px 20px 30px;
        }

        #logo_banner {
            width: 50vh;
            max-width: 50%;
            height: auto;
            max-width: 400px;
        }

        @media (max-width: 768px) {
            .bg-banner {
                height: 40vh;
                padding-top: 80px;
            }

            #logo_banner {
                max-width: 80%;
            }
        }

        .bg-banner {
            background-image: url('/imgs/banner.png');
            height: 70vh;
            background-size: contain;
            background-position: center center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 130px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: var(--cor-branco);
        }

        .card-title {
            color: var(--cor-preto);
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-label {
            color: var(--cor-preto);
            min-width: 80px;
            text-align: right;
        }

        .form-control {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            flex-grow: 1;
            height: 45px;
        }

        .custom-btn-agendar {
            background-color: #2D6A4F !important;
            border-color: #2D6A4F !important;
            color: var(--cor-branco) !important;
            font-weight: bold;
            font-size: 1.25rem;
            border-radius: 0.25rem;
        }

        .custom-btn-agendar h4 {
            color: var(--cor-branco) !important;
            margin-bottom: 0;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-link.active {
            color: #000;
            font-weight: bold;
        }


        .nav-link:focus {
            color: #000;
        }

        .titulos {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('imgs/logo_menor.png') }}" alt="logo Traços de esperança" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex w-100 justify-content-around fs-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#quemSomos">Quem somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#possoDoar">O que posso doar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#comoDoar">Como</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#parceiros">Parceiros</a>
                        </li>
                        <li class="nav-item">
                                <div class="d-flex gap-3">
                                    <a href="{{ route('login.usuario') }}" class="btn btn-outline-primary fs-4">Área do Usuário</a>
                                    <a href="{{ route('login.instituicao') }}" class="btn btn-outline-secondary fs-4">Área da Instituição</a>
                                </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div>
            <div class="d-flex bg-banner">
                <img src="{{ asset('imgs/logo.png') }}" alt="Traços de esperança" id="logo_banner">
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <div class="row mt-5 container">
                    <div class="col-md-6 col-sm-12">
                        <h2>DOE MATERIAL ESCOLAR.<br>CONSTRUA UM FUTURO.</h2>
                        <p class="fs-4">Acreditamos que um lápis e um caderno são as ferramentas mais poderosas para
                            transformar uma vida. Sua doação leva oportunidade para quem mais precisa.</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <form method="POST">
                                    <h4 class="card-title text-center mb-4">AGENDE SUA COLETA</h4>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="nome" class="form-label me-3 text-uppercase fw-bold">NOME</label>
                                        <input type="text" id="nome" name="nome" class="form-control" required>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="telefone"
                                            class="form-label me-3 text-uppercase fw-bold">TELEFONE</label>
                                        <input type="text" id="telefone" name="telefone" class="form-control" required>
                                    </div>

                                    <div class="d-flex align-items-center mb-4">
                                        <label for="email" class="form-label me-3 text-uppercase fw-bold">EMAIL</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-success custom-btn-agendar py-2">
                                            <h4 class="m-0">AGENDAR</h4>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <section class="page-section" id="quemSomos">
                        <div class="col-12 text-center titulos">
                            <h1>QUEM SOMOS?</h1>
                            <hr class="w-25 mx-auto">
                        </div>

                        <div class="col-md-10 offset-md-1 mt-4">
                            <h3 class="fw-bold text-center">Nossa missão</h3>
                            <p class="text-justify fs-5">Na <strong>Traços de Esperança</strong>, acreditamos que a
                                educação
                                é a ferramenta mais poderosa para desenhar um futuro melhor. Nossa missão é simples, mas
                                vital: <strong>garantir que nenhuma criança deixe de sonhar por falta de um lápis ou um
                                    caderno.</strong> Somos uma iniciativa dedicada a conectar quem tem materiais
                                escolares
                                novos ou em bom estado com estudantes e escolas em situação de vulnerabilidade.</p>

                            <h3 class="fw-bold text-center mt-5">Nossos valores</h3>
                            <div class="row justify-content-center text-center mt-4 g-4">
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-terciaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">🌟 Esperança</h4>
                                            <p class="card-text fs-5">Oferecemos mais que material; oferecemos a
                                                esperança
                                                de um futuro mais brilhante.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-secundaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">🔑 Acesso</h4>
                                            <p class="card-text fs-5">Trabalhamos para democratizar o acesso à educação
                                                básica, removendo barreiras materiais.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-terciaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">🤝 Comunidade</h4>
                                            <p class="card-text fs-5">Acreditamos no poder da solidariedade e da união
                                                para
                                                transformar vidas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="possoDoar" class="page-section">
                        <div class="col-12 text-center titulos">
                            <h1>O QUE POSSO DOAR?</h1>
                            <hr class="w-25 mx-auto">
                        </div>

                        <div class="row justify-content-center text-center mt-4 g-4">
                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/livros.png') }}" class="img-fluid" alt="Livros"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Livros</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/hqs.png') }}" class="img-fluid" alt="HQ's"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">HQ's</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/mochila.png') }}" class="img-fluid" alt="Mochilas"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Mochilas</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/caneta.png') }}" class="img-fluid" alt="Canetas"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Canetas</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/revistas.png') }}" class="img-fluid" alt="Revistas"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Revistas</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/cadernos.png') }}" class="img-fluid" alt="Cadernos"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Cadernos</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/lapis.png') }}" class="img-fluid" alt="Lapis"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Lapis</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/estojo.png') }}" class="img-fluid" alt="Estojo"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Estojo</figcaption>
                                </figure>
                            </div>

                            <div class="col-6 col-md-4">
                                <figure class="figure text-center">
                                    <div class="rounded-circle d-flex align-items-center shadow-lg justify-content-center overflow-hidden"
                                        style="width: 150px; height: 150px; background-color: #fcfcfcff;">
                                        <img src="{{ asset('imgs/borracha.png') }}" class="img-fluid" alt="Borracha"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </div>
                                    <figcaption class="figure-caption text-muted mt-2">Borracha</figcaption>
                                </figure>
                            </div>
                        </div>

                    </section>




                    <section id="comoDoar" class="page-section">
                        <div class="col-md-10 offset-md-1 mt-4">
                            <div class="col-12 text-center titulos">
                                <h1>COMO DOAR?</h1>
                                <hr class="w-25 mx-auto">
                            </div>

                            <div class="row justify-content-center text-center mt-4 g-4">

                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-primaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Agende a Coleta</h4>
                                            <p class="card-text fs-5">Você entra em contato conosco pelo site ou
                                                WhatsApp.
                                                Agendamos o melhor dia e horário e retiramos os materiais escolares
                                                gratuitamente
                                                no seu endereço.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-terciaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold"> Fazemos a Triagem</h4>
                                            <p class="card-text fs-5">Recebemos o material e nossa equipe faz a triagem.
                                                Separamos tudo por tipo (cadernos, lápis, mochilas, etc.) e verificamos
                                                o estado
                                                de conservação para garantir que tudo chegue pronto para uso.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 p-3 shadow-sm custom-value-card"
                                        style="background-color: var(--cor-primaria);">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">O Destino Final</h4>
                                            <p class="card-text fs-5">Montamos kits escolares completos e enviamos para
                                                nossas
                                                instituições parceiras, ONGs e diretamente para alunos
                                                e escolas em situação de vulnerabilidade social.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="page-section" id="parceiros">
                        <div class="col-12 text-center titulos">
                            <h1>NOSSOS PARCEIROS</h1>
                            <hr class="w-25 mx-auto">
                        </div>

                        <div class="div">
                        </div>
                    </section>


                </div>

            </div>



        </div>
        </div>
    </main>

    <footer class="text-center mt-5 p-4 bg-light">
        <p class="m-0">© {{ date('Y') }} Traços de Esperança - Todos os direitos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">





        </script>
    <script>
        const navLinks = document.querySelectorAll('.nav-link');

        const pageSections = document.querySelectorAll('.page-section');

        const removeActiveClasses = () => {
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
        };

        const observerOptions = {
            root: null,

            rootMargin: '-130px 0px 0px 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {

                if (entry.isIntersecting) {
                    removeActiveClasses();

                    const sectionId = entry.target.id;

                    const activeLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            });
        }, observerOptions);

        pageSections.forEach(section => {
            observer.observe(section);
        });

        navLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {

                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });

                        removeActiveClasses();
                        this.classList.add('active');
                    }
                }
            });
        });
    </script>
</body>

</html>